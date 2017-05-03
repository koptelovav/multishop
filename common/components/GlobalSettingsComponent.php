<?php

class GlobalSettingsComponent extends CApplicationComponent{

    private $params = array();

    public function init(){
        $result = Yii::app()->db->createCommand()->
            select('name, value')->
            from('global_settings')->
            queryAll();

        foreach($result as $row)
            $this->params[$row['name']] = $row['value'];
    }


    public function __get($name){
        if(!is_null($this->params))
            if(isset($this->params[$name]))
                return $this->params[$name];
        return false;
    }
}