<?php
class ReferralIdentity extends CUserIdentity
{
    private $_id;
    public function authenticate()
    {
        $record=Referral::model()->findByAttributes(array('email'=>$this->username));

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->autologin == $record->getAutoLoginHash()){
            $this->_id=$record->id;
            $this->errorCode=self::ERROR_NONE;
        }
        else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}