<?php
Yii::import('frontend.controllers.BillingController');

/**
 * Payment via service "Robokassa"
 * Class RobokassaController
 */
class YandexKassaController extends BillingController{
    /**
     * Receiving a response and set event handlers
     */
    public function actionResult(){
        Yii::app()->paymentYandexKassa->onSuccess = array($this, 'paymentSuccess');
        Yii::app()->paymentYandexKassa->onFail = array($this, 'paymentFail');
        Yii::app()->paymentYandexKassa->result();
    }
}