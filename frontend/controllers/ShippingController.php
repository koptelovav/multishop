<?php

/**
 * Base billing controller
 * Class BillingController
 */
class ShippingController extends FrontEndController{

    public function actionCalculateCdek()
    {
        $result = Yii::app()->edost->calculate($_POST['city'],'',1000,2, array(37,38));

        $this->renderPartial('_calculateCdek',array(
            'data'=>$result
        ), false, false);
    }
}

