<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CartForm extends CFormModel
{
    //основная информация
    public $canOrder = false;
    public $order = null;

    public $email;
    public $name;
    public $phone;

    //адрес
    public $city;
    public $area;
    public $street;
    public $house;
    public $apartment;
    public $zip;

    //временой интервал для обзвона
    public $callInterval = array();
    public $callIntervalValue = array('11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00');

    public $comment;

    //доставка и оплата
    public $shipping;
    public $shippingVariantCodes = array();
    public $shippingVariants = array();
    public $allowShippingVariants = array();
    public $shippingType;
    public $currentShipping;
    public $payment;
    public $paymentVariants = array();
    public $recalculateShipping = false;
    public $pvz;
    public $pvzList = array();

    public $subscribe;

    public $products = array();
    public $cartProducts = array();
    public $gifts = array();

    public $totalProduct;
    public $total;

    public $promoCode = null;
    public $discount;
    public $send_no_call = 2;

    const SEND_NO_CALL = 1;
    const SEND_BEFORE_CALL = 2;

    protected $promoCodesArray = array(
//        '23022015' => 5,
        '1224031413' => 5,
        '961853' => 5, //на магнитах
        '01012016' => 5, //на магнитах
        '349632' => 5, //на магнитах
        '1334031412' => 10,
        '7865716' => 7,
        '4878921694' => 10, //Надежда Татур
        '245819' => 10, //Ирина Солодилова
        '564735' => 10, //Ирина Иванова
        '173169' => 10, //Люда Панина
        '615721' => 10, //Мария Меркулова
        '327579' => 10, //Аня Володина
        '758060' => 10, //Анастасия Миннибаева
        '990184' => 10, //Виктория Селиванова
        '421318' => 10, //Ирина Бякова
        '635228' => 10, //Татьяна Павлушина
//        '65128' => 10 //акция,
        '8902631' => '10', //Айгуль
        'RASOVA' => '10',
        'IVANOVAO' => '10',
        'ASMELOV' => '10',
        '7455439' => '10',
        'ASYA_2283' => '10',
        'KINETICPROMO' => '5',
        'SALE10' => '10',
        'sale10' => '10'
    );

	public function rules()
	{
		return array(
            array('shippingType', 'required', 'message'=> 'Неоходимо выбрать тип доставки. Пункт №1'),
            array('payment', 'required', 'message'=> 'Неоходимо выбрать тип оплаты'),
            array('zip', 'zipValidator'),
            array('email', 'email', 'message'=> 'Неверный e-mail, либо строка e-mail содержит пробелы'),
            array('shipping', 'shippingValidator'),
			array('city, area ,email, name, phone', 'required'),
            array('shipping, zip', 'numerical'),
            array('send_no_call, pvz, pvzList, recalculateShipping, allowShippingVariants,shippingVariantCodes,discount, promoCode, callInterval, gifts, canOrder,comment,shippingVariants, paymentVariants, products, currentShipping, cartProducts, total, totalProduct, order, street, house, apartment', 'safe'),
            array('subscribe','boolean')
		);
	}

    public function attributeLabels()
    {
        return array(
            'name' => 'Ф.И.О. получателя',
            'phone' => 'Телефон получателя',
            'email' => 'E-mail',
            'street' => 'Улица',
            'house' => 'Дом',
            'apartment' => 'Квартира',
            'city' => 'Город',
            'area' => 'Регион',
            'areaId' => 'Регион',
            'zip' => 'Индекс',
            'comment' => 'Комментарий',
            'shipping' => 'Доставка',
            'payment' => 'Оплата',
            'sand_no_call' => 'отправка без звонка',
            'callInterval' => 'Удобное время для звонка менеджера (Время московское)'
        );
    }

    public function getAllProductId()
    {
        $clientData = Yii::app()->session['client_data'];
        $ids = array();
        if(is_array($clientData['products']))
        foreach ($clientData['products'] as $item) {
            $ids[] = $item['id'];
        }
        return $ids;
    }

    public function zipValidator($attribute,$params){
        if(!$this->zip && ($this->shippingType == Shipping::CALCULATE_SHIPPING))
            $this->addError('zip','Необходимо заполнить поле индекс и нажать на синию кнопку "рассчитать". Пункт №1.1');
    }

    public function shippingValidator($attribute,$params){
        if($this->zip && $this->shippingType == Shipping::CALCULATE_SHIPPING && $this->shipping == Shipping::CALCULATE_SHIPPING)
            $this->addError('shipping','Необходимо выбрать тип доставки. Пункт №1.1');
    }

    public function getShipping(){
        $result = array();
        foreach(Shipping::model()->findAll() as $item){
            if(isset($this->shippingVariants[$item->edost_code])){
                $item->price = $this->shippingVariants[$item->edost_code]['price'];
                $item->times = !empty($this->shippingVariants[$item->edost_code]['day']) ? $this->shippingVariants[$item->edost_code]['day'] : '-';
            }else{
                $item->price = 0;
                $item->times = '-';
            }

            $result[] = $item;
        }

        return $result;
    }

    public function getShippingModel()
    {
        return Shipping::model()->findByPk($this->shipping);
    }

    public function getPickupShipping(){
        $result = array();
        foreach(Shipping::model()->findAll() as $item){
            if(isset($this->shippingVariants[$item->edost_code])){
                $item->price = $this->shippingVariants[$item->edost_code]['price'];
                $item->times = !empty($this->shippingVariants[$item->edost_code]['day']) ? $this->shippingVariants[$item->edost_code]['day'] : '-';
            }else{
                $item->price = 0;
                $item->times = '-';
            }

            $result[] = $item;
        }

        return $result;
    }

    public function getPayment(){
        $shipping = Shipping::model()->findByPk($this->shipping);
        if($shipping)
            return $shipping->payments;
        return array();
    }

    public function getPaymentVariants(){
        $edostCodes = array_keys($this->shippingVariants);
        $edostCodesString = implode(',',$edostCodes);

            $command = Yii::app()->db->createCommand()
                ->select('p.id')
                ->from('payment p')
                ->leftJoin('shipping_payment sp','p.id = sp.payment_id')
                ->leftJoin('shipping s','sp.shipping_id = s.id')
                ->where('s.edost_code IN ('.$edostCodesString.')')
                ->group('p.id');

        if($this->shipping)
            $command->where('s.edost_code IN ('.$edostCodesString.') AND s.id = '.$this->shipping);

        $result = $command->queryColumn();

        return $result;
    }

    public function getTotal(){
        $total = $this->getTotalProducts($this->discount);
        $total += $this->getTotalShipping();
        return $total;
    }

    public function getTotalProducts($discount = false){
        $total = 0;
        if(!empty($this->products))
            foreach($this->products as $item){
                $currentTotal = $item['price']*$item['count'];
                if($discount && !$item['discount'])
                    $currentTotal = $currentTotal - $currentTotal*$discount/100;
                $total+= $currentTotal;
            }
        return $total;
    }

    public function getTotalShipping(){
        $total = 0;
        if($this->currentShipping)
            $total = $this->currentShipping['price'];
        return $total;
    }

    public function getWeight(){
        $weight = 1000;
        if(!empty($this->products))
            foreach($this->products as $item)
                $weight+=$item['count']*$item['weight'];

        return $weight;
    }

    public function getCallInterval(){
        return $this->callIntervalValue[$this->callInterval[0]] . ' - ' . $this->callIntervalValue[$this->callInterval[1]];
    }

    public function getProductsCount(){
        $total = 0;
        if(!empty($this->products))
            foreach($this->products as $item)
                $total+=$item['count'];
        return $total;
    }

    public function reset(){
        $this->pvz = '';
        $this->area = '';
        $this->city = '';
        $this->shipping='';
        $this->payment='';
        $this->currentShipping = array();
        $this->pvzList = array();
    }

    public function setDefaultParams(){
        $this->unsetAttributes();
        $this->canOrder = false;
        $this->promoCode = null;
        $this->order = null;
        $this->shippingVariants = array();
        $this->paymentVariants = array();
        $this->products = array();
        $this->gifts = array();
        $this->cartProducts = array();
        $this->pvzList = array();
        $this->pvz = '';
    }

    public function checkPromoCode($code){
        return isset($this->promoCodesArray[$code]) ? $this->promoCodesArray[$code] : false;
    }
}
