<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 29.07.13
 * Time: 11:59
 * To change this template use File | Settings | File Templates.
 */

class CheckerComponent extends CApplicationComponent{
    protected $sessionKey = 'checker';
    public $types = array(
        'orders' => 'orders-grid_c0[]'
    );

    public function init(){
        if(!isset(Yii::app()->session[$this->sessionKey]))
            Yii::app()->session[$this->sessionKey] = array();
    }

    public function set($name, $val, $checked){
        if(!isset(Yii::app()->session[$this->sessionKey]))
            Yii::app()->session[$this->sessionKey] = array();

        $tempArray  = Yii::app()->session[$this->sessionKey];

        if(!isset($tempArray[$name]))
            $tempArray[$name] = array();

        if($checked)
            $tempArray[$name][] = $val;
        else
            unset($tempArray[$name][array_search($val, $tempArray[$name])]);

        Yii::app()->session[$this->sessionKey] = $tempArray;
    }

    public function getByType($type){
        if(!isset(Yii::app()->session[$this->sessionKey]))
            return array();

        return  Yii::app()->session[$this->sessionKey][$this->types[$type]];
    }

    public function getByName($name){
        if(!isset(Yii::app()->session[$this->sessionKey]))
            return array();

        return  Yii::app()->session[$this->sessionKey][$name];
    }

    public function checkedByType($type, $val){
        $tempArray = $this->getByType($type);
        if(!is_array($tempArray))
            return false;
        return array_search($val, $tempArray) !== false;
    }
}