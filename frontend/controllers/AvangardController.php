<?php
Yii::import('frontend.controllers.BillingController');

/**
 * Payment via bank "Avangard"
 * Class AvangardController
 */
class AvangardController extends BillingController{
    public function actionResult(){
        header("HTTP/1.1 202 Accepted");
        Yii::app()->paymentAvangard->onSuccess = array($this, 'paymentSuccess');
        Yii::app()->paymentAvangard->onFail = array($this, 'paymentFail');
        Yii::app()->paymentAvangard->result();
    }
}