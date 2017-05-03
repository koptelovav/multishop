<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ReferralLoginForm extends LoginForm
{
	private $_identity;

	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new ReferralIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	public function login()
	{
        if($this->_identity===null)
        {
            $this->_identity= new ReferralIdentity($this->username,$this->password);;
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===ReferralIdentity::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
	}
}
