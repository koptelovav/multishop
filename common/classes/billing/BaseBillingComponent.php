<?php

abstract class BaseBillingComponent extends CApplicationComponent
{
    public $orderModel;
    public $priceField;
    public $isTest = false;
    public $params;

    protected $_order;

    abstract public function result();

    protected function isOrderExists($id)
    {
        $this->_order = CActiveRecord::model($this->orderModel)->findByPk((int)$id);

        if ($this->_order)
            return true;

        return false;
    }

    public function onSuccess($event)
    {
        $this->raiseEvent('onSuccess', $event);
    }

    public function onFail($event)
    {
        $this->raiseEvent('onFail', $event);
    }
}