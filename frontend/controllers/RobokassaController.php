<?php
Yii::import('frontend.controllers.BillingController');

/**
 * Payment via service "Robokassa"
 * Class RobokassaController
 */
class RobokassaController extends BillingController{
    /**
     * Receiving a response and set event handlers
     */
    public function actionResult(){
        Yii::app()->paymentRobokassa->onSuccess = array($this, 'paymentSuccess');
        Yii::app()->paymentRobokassa->onFail = array($this, 'paymentFail');
        Yii::app()->paymentRobokassa->result();
    }
}