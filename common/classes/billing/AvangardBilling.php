<?php

class AvangardBilling extends BaseBillingComponent
{
    public $shopSign;
    public $avangardSign;
    public $shopId;
    public $shopPassword;

    const CHECK_STATUS_OK = 0;
    const CHECK_STATUS_EMPTY_SHOP = 1;
    const CHECK_STATUS_EMPTY_PASS = 2;
    const CHECK_STATUS_WRONG_AUTH = 3;
    const CHECK_STATUS_INTERNAL_ERROR = 4;
    const CHECK_STATUS_EMPTY_TICKET = 5;
    const CHECK_STATUS_WRONG_IP = 6;

    const ORDER_STATUS_NOT_FOUND = 0;
    const ORDER_STATUS_PROCCESS = 1;
    const ORDER_STATUS_BRAK = 2;
    const ORDER_STATUS_OK = 3;

    const REG_STATUS_EMPTY_ORDER_NUMBER = 101;
    const REG_STATUS_EMPTY_ORDER_DESCRIPTION = 104;
    const REG_STATUS_EMPTY_ORDER_BACK_URL = 105;
    const REG_STATUS_EMPTY_ORDER_AMOUNT = 106;
    const REG_STATUS_EMPTY_LANG = 107;
    const REG_STATUS_EMPTY_PASSWORD = 108;

    const RESPONSE_STATUS_EMPTY_TICKET = 201;

    const CANCEL_STATUS_EMPTY_TICKET = 301;
    const CANCEL_STATUS_NOT_CORRECT = 302;

    const STATUS_NOT_FOUND = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_DISCARDED = 2;
    const STATUS_SETTLED = 3;
    const STATUS_PARTIAL_RETURN = 5;
    const STATUS_RETURN = 6;

    public function pay($amount, $orderId, $orderDesc, $sUserEmail, $params)
    {
       $url = $this->getPaymentUrl($amount, $orderId, $orderDesc, $sUserEmail);
       Yii::app()->controller->redirect($url);
    }

    public function getPaymentUrl($amount, $orderId, $orderDesc, $sUserEmail){
        $url = 'https://www.avangard.ru/iacq/pay?ticket=';
        $ticket = $this->registerOrder($amount, $orderId, $orderDesc, $sUserEmail);

        return $url.$ticket;
    }

    public function registerOrder($amount, $orderId, $orderDesc, $sUserEmail){
        $requestUrl = 'https://www.avangard.ru/iacq/h2h/reg';
        $amount = $amount*100; //перевод в копейки
        $backUrl = Yii::app()->request->getBaseUrl(true);
        $backUrlOk = Yii::app()->createAbsoluteUrl('billing/success');
        $backUrlFail = Yii::app()->createAbsoluteUrl('billing/fail');
        $xml = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<new_order>
<shop_id>$this->shopId</shop_id>
<shop_passwd>$this->shopPassword</shop_passwd>
<amount>$amount</amount>
<order_number>$orderId</order_number>
<order_description>$orderDesc</order_description>
<language>RU</language>
<back_url>$backUrl</back_url>
<back_url_ok>$backUrlOk</back_url_ok>
<back_url_fail>$backUrlFail</back_url_fail>
<client_email>$sUserEmail</client_email>
</new_order>
XML;
        $response = $this->xmlRequest($requestUrl,$xml);
        $this->saveOrderData($orderId, $response);
        return $response->ticket;
    }

    public function getOrderInfo($orderId)
    {
        /* @var $orderData SimpleXmlElement*/
        $requestUrl = 'https://www.avangard.ru/iacq/h2h/get_order_info';
        $orderData = $this->getOrderData($orderId);
        $ticket = $orderData->ticket;
        $xml = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<get_order_info>
<ticket>$ticket</ticket>
<shop_id>$this->shopId</shop_id>
<shop_passwd>$this->shopPassword</shop_passwd>
</get_order_info>
XML;
        return $this->xmlRequest($requestUrl,$xml);
    }

    public function result()
    {
        $event = new CEvent($this);
        $valid = true;

        if(isset($_REQUEST['xml'])){
            $xml = new SimpleXMLElement($_REQUEST['xml']);
            $orderExists = $this->isOrderExists((int)$xml->order_number);
            if($orderExists)
                $this->saveOrderData((int)$xml->order_number, $xml);
            else
                $valid = false;
        }else
            $valid = false;


        if($valid){
            if($this->hasEventHandler('onSuccess')){
                $this->params = array('order'=>$this->_order);
                $this->onSuccess($event);
            }
        }else{
            if($this->hasEventHandler('onFail')){
                $this->onFail($event);
            }
        }
    }

    private function getRequestSign($amount, $orderId)
    {
        return strtoupper(md5(strtoupper(md5($this->avangardSign) . md5($this->shopId . $orderId . ($amount * 100)))));
    }

    private function xmlRequest($url,$xml){

        header("Content-type: text/html; charset=UTF-8");

        $headers = array
        (
            'Content-type: application/x-www-form-urlencoded;charset=UTF-8',
            'Expect:'
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "xml=".$xml);

        $result = curl_exec($curl);
        curl_close($curl);

        $XMLResponse = new SimpleXMLElement($result);

        if($XMLResponse->response_code == self::CHECK_STATUS_OK){
            return $XMLResponse;
        }else{
            echo $XMLResponse->response_code;
            echo $xml;
            die;
        }
    }

    private function saveOrderData($orderId, SimpleXMLElement $response){
        $orderPayment = OrderPayment::model()->findByAttributes(array('order_id'=>$orderId));

        if(!$orderPayment)
            $orderPayment = new OrderPayment;

        $orderPayment->order_id = $orderId;
        $orderPayment->date = date('Y-m-d H:i:s');
        $orderPayment->billing_data = $response->saveXML();
        return $orderPayment->save();
    }

    private function getOrderData($orderId){
        /* @var $order OrderPayment */
        $order = OrderPayment::model()->findByAttributes(array('order_id'=>$orderId));
        if($order){
            return new SimpleXMLElement($order->billing_data);
        }else
            return false;
    }
}