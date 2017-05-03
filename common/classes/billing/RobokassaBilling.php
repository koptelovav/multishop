<?php

class RobokassaBilling extends BaseBillingComponent
{
	public $sMerchantLogin;
	public $sMerchantPass1;
	public $sMerchantPass2;
	public $sCulture = 'ru';

	public $resultMethod = 'post';
	public $sIncCurrLabel = 'Qiwi29OceanR';


	public function pay($nOutSum, $nInvId, $sInvDesc, $sUserEmail, $params)
	{
        $url = $this->getPaymentUrl($nOutSum, $nInvId, $sInvDesc, $sUserEmail, $params);
		Yii::app()->controller->redirect($url);
	}

    public function getPaymentUrl($nOutSum, $nInvId, $sInvDesc, $sUserEmail,$params){
        $sign = $this->getPaySign($nOutSum, $nInvId, $sUserEmail);

        $url  = $this->isTest
            ? 'http://test.robokassa.ru/Index.aspx?'
            : 'https://merchant.roboxchange.com/Index.aspx?';

        $url .= "MrchLogin={$this->sMerchantLogin}&";
        $url .= "OutSum={$nOutSum}&";
        $url .= "InvId={$nInvId}&";
        $url .= "Desc={$sInvDesc}&";
        $url .= "SignatureValue={$sign}&";
        $url .= $params.'&';
        $url .= "IncCurrLabel={$this->sIncCurrLabel}&";
        $url .= "Email={$sUserEmail}&";
        $url .= "Culture={$this->sCulture}";

        return $url;
    }

	private function getPaySign($nOutSum, $nInvId)
	{
		$keys = array(
			$this->sMerchantLogin,
			$nOutSum,
			$nInvId,
			$this->sMerchantPass1,
		);
		return md5(implode(':', $keys));
	}

	public function result()
	{
		$var = $_GET + $_POST;
		extract($var);
		$event = new CEvent($this);

		$valid = true;

        $orderExists = $this->isOrderExists($InvId);

		if(!isset($OutSum, $InvId, $SignatureValue)){
			$this->params = array('reason'=>'Dont set need value');
			$valid = false;
		}

        else if(!$this->checkResultSignature($OutSum, $InvId, $SignatureValue))
		{
			$this->params = array('reason'=>'Signature fail');
			$valid = false;
		}

        else if(!$orderExists)
		{
			$this->params = array('reason'=>'Order not exists');
			$valid = false;
		}

        else if($this->_order->{$this->priceField} != $OutSum)
		{
			$this->params = array('reason'=>'Order price error');
			$valid = false;
		}

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

		echo "OK{$InvId}\n";
	}

	private function checkResultSignature($OutSum,$InvId,$SignatureValue)
	{
		$keys = array(
			$OutSum,
			$InvId,
			$this->sMerchantPass2,
		);

		$sign = strtoupper(md5(implode(':', $keys)));

		if($SignatureValue == $sign)
			return true;

		return false;
	}
}
