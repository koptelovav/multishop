<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 01.08.13
 * Time: 13:35
 * To change this template use File | Settings | File Templates.
 */

class CouponController extends FrontEndController{
    public function actionActivate(){
        if(Yii::app()->request->isPostRequest){
            if($coupon = Yii::app()->request->getPost('coupon')){
                echo Yii::app()->discounter->activateCoupon($coupon);
            }
        }else{
            throw new CHttpException(403);
        }
    }
}