<?php
class CardIdentity extends CUserIdentity
{
    private $_id;
    public function authenticate()
    {
        $record=CardUser::model()->findByAttributes(array('email'=>$this->username));

        if($record===null){
            $username = str_replace('-','',$this->username);

            if(strlen($username) == 11 && $username[0] == 8)
                $username = substr_replace($username, '+7', 0, 1);

            else if(strlen($username) == 10 && $username[0] == 9)
                $username = substr_replace($username, '+7', 0, 0);

            $phone = '';
            foreach(str_split($username) as $number=>$char){
                if(in_array($number, array(2,5,8)) !== false )
                    $phone .= '-';
                $phone .= $char;
            }

            $record=CardUser::model()->findByAttributes(array('phone'=>$phone));
        }
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->card_id;
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}