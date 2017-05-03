<?php

class YandexKassaBilling extends BaseBillingComponent
{
	public $scId;
	public $shopId;
    public $ShopPassword;

    const PAYMENT_TYPE_BANK_CARD = 'AC';

	public function pay($sum, $orderNumber, $sInvDesc, $cps_email, $paymentType)
	{
        $url = $this->getPaymentUrl($sum, $orderNumber, $cps_email, $paymentType);
        Yii::app()->controller->redirect($url);
	}

    public function getPaymentUrl($sum, $orderNumber, $cps_email, $paymentType){
        $paymentType = $paymentType ? $paymentType : self::PAYMENT_TYPE_BANK_CARD;

        $url  = $this->isTest
            ? 'https://demomoney.yandex.ru/eshop.xml?'
            : 'https://money.yandex.ru/eshop.xml?';

        $url .= "scId={$this->scId}&";
        $url .= "shopId={$this->shopId}&";
        $url .= "customerNumber=c{$orderNumber}&";
        $url .= "orderNumber={$orderNumber}&";
        $url .= "Sum={$sum}&";
        $url .= "paymentType={$paymentType}&";
        $url .= "cps_email={$cps_email}";
        return $url;
    }

	public function result()
	{
        Yii::log($_POST['action'], 'error');
        if(isset($_POST['action']))
            $this->{$_POST['action']}();
	}

    private function checkMD5($request){
        $hash = md5($request['action'].';'.$request['orderSumAmount'].';'.$request['orderSumCurrencyPaycash'].';'.
            $request['orderSumBankPaycash'].';'.$this->shopId.';'.$request['invoiceId'].';'.$request['customerNumber'].';'.$this->ShopPassword);
        Yii::log(strtolower($hash) .'!='. strtolower($request['md5']), 'error');
        return strtolower($hash) != strtolower($request['md5']);
    }

    private function checkOrder(){
        if ($this->checkMD5($_POST)){
            $code = 1;
        }
        else {
            $code = 0;
        }

        Yii::log(CVarDumper::dumpAsString($_POST), 'error');

        print '<?xml version="1.0" encoding="UTF-8"?>';
        print '<checkOrderResponse performedDatetime="'. $_POST['requestDatetime'] .'" code="'.$code.'"'. ' invoiceId="'. $_POST['invoiceId'] .'" shopId="'. $this->shopId .'"/>';
    }

    private function paymentAviso(){
        $event = new CEvent($this);

        $this->_order = Orders::model()->findByPk((int)$_POST['orderNumber']);
        if ($this->checkMD5($_POST)){
            $code = 1;
            $this->onFail($event);
        }
        else {
            $code = 0;
            if($this->hasEventHandler('onSuccess')){
                $this->params = array('order'=>$this->_order);
                $this->onSuccess($event);
            }
        }

        print '<?xml version="1.0" encoding="UTF-8"?>';
        print '<paymentAvisoResponse performedDatetime="'. $_POST['requestDatetime'] .'" code="'.$code.'" invoiceId="'. $_POST['invoiceId'] .'" shopId="'. $this->shopId .'"/>';
    }
}
