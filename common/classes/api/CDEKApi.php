<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 25.11.13
 * Time: 12:40
 * To change this template use File | Settings | File Templates.
 */

class CDEKApi extends CApplicationComponent {
    public $testAccount = '7605a887fe0b61cf59553c2ccc8595eb';
    public $testSecurePassword = 'a4249f50d4690187a8a96d8eb9f8590e';

    public $account = 'fe0cd94129e146980d547a3f74d55ce9';
    public $securePassword = '6ebb11db4a48bebd5f4bd9fa74da68bb';

    protected $host = 'gw.edostavka.ru';

    public $isTest = 0;

    protected function getAccount(){
        return $this->isTest ? $this->testAccount : $this->account;
    }

    protected function getSecure($date){
        return md5($date.'&'.($this->isTest ? $this->testSecurePassword : $this->securePassword));
    }

    protected function apiRequest($url, $xml){
        $params = array(
           'xml_request' => $xml,
        );

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => http_build_query($params),
            ),
        ));

        return file_get_contents($url, false, $context);
    }

    public function registerOrder($order){
        $customer = $order->customer;
        $customerAddress = $customer->address;
        $date =  date('Y-m-d',strtotime($order->date));
        $account = $this->getAccount();
        $secure = $this->getSecure($date);
        $number = 1;
        $orderNumber = $order->status == OrderStatus::RESEND ? $order->id.'-1': $order->id;
        $orderDate = date('Y-m-d',strtotime($order->update_payment_status));
        $zip = $customerAddress->zip;
        $recipientName = $customer->name;
        $recipientEmail = $customer->email;
        $phone = $customer->phone;

        $street = $customerAddress->street;
        $house = $customerAddress->house;
        $apartment = $customerAddress->apartment;

        $pvz = $customerAddress->pvz;

        $weight = $order->getWeight() > 30 ? 29.5 : $order->getWeight();
        $cost = $order->total;
        $cashOnDelivery = 0;

        if($cod = $order->getAdditionalFieldByName('cash_on_delivery'))
            $cashOnDelivery = $cod->value ? $cod->value : 0;

        if($order->shipping_id == Shipping::CDEK_STORE_SHIPPING || $order->shipping_id == Shipping::CDEK_SPB || $order->shipping_id == Shipping::MSC_STORE_SHIPPING)
            $TariffTypeCode = 136;
        else
            $TariffTypeCode = 137;

        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8" ?>
<DeliveryRequest ForeignDelivery="0" Currency="RUB" Number="$number" Date="$date" Account="$account" Secure="$secure" OrderCount="1">
<Order Number="$orderNumber"
DateInvoice="$orderDate"
SendCityPostCode="197341"
RecCityPostCode="$zip"
RecipientName="$recipientName"
RecipientEmail="$recipientEmail"
Phone="$phone"
TariffTypeCode="$TariffTypeCode"
SellerName="Kinetic Sand">
<Address Street="$street" House="$house" Flat="$apartment" PvzCode="$pvz"/>
<Package Number="1" BarCode="1" Weight="$weight">
<Item WareKey="25000358171" Cost="$cost" Payment="$cashOnDelivery" Weight="$weight" WeightBrutto="$weight" Amount="1" CommentEx="KineticSand" Comment="Кинетический песок"/>
</Package>
</Order>
</DeliveryRequest>
EOF;
        return $this->apiRequest('http://'.($this->host).':11443/new_orders.php', $xml);
    }

    public function orderPrint($order){
        $orderNumber = $order->id;
        $orderDate =  date('Y-m-d',strtotime($order->update_payment_status));
        $date =  date('Y-m-d',strtotime($order->date));
        $account = $this->getAccount();
        $secure = $this->getSecure($orderDate);

         $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8" ?>
<OrdersPrint Date="$orderDate" Account="$account" Secure="$secure"  OrderCount="1" CopyCount="4">
<Order Number="$orderNumber" Date="$date" />
</OrdersPrint>
EOF;

        $response = $this->apiRequest('http://'.($this->host).':11443/orders_print.php', $xml);
        if($response[0]== '%')
            return $response;
        else
            return false;
    }

    public function getPVZList($zip){
        $result = array();

        $ctx = stream_context_create(array('http'=>
            array(
                'timeout' => 5,  //1200 Seconds is 20 Minutes
            )
        ));

            $response = @file_get_contents('http://'.($this->host).':11443/pvzlist.php?citypostcode='.$zip, false, $ctx);
        if($response){
            $pvzList = new SimpleXMLElement($response);
            foreach($pvzList->Pvz as $pvz){
                $result[(string)$pvz['Code']] = array(
                    'code'=>(string)$pvz['Code'],
                    'name'=>(string)$pvz['Name'],
                    'address'=>(string)$pvz['Address']
                );
            }
        }else{
            $result = array(
                1=> array(
                    'code' => 1,
                    'name' => 'Список пунктов в данный момент не доступен.',
                    'address' => 'После оформления заказа с Вами свяжется менеджер и уточнит детали. Извиняемся за неудобства.'
                )
            );
        }


        return $result;
    }

}
