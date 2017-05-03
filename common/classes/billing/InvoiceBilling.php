<?php

class InvoiceBilling extends BaseBillingComponent
{
	public $sMerchantLogin;
	public $sMerchantPass1;
	public $sMerchantPass2;
	public $sCulture = 'ru';

	public $resultMethod = 'post';
	public $sIncCurrLabel = 'QiwiR';


	public function pay($nOutSum, $orderId, $sInvDesc, $sUserEmail, $params)
	{
        $url = Yii::app()->createUrl('billing/invoice',array(
            'id'=>$orderId
        ));
		Yii::app()->controller->redirect($url);
	}

    public function result(){}
}
