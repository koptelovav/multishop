<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 19.11.13
 * Time: 17:24
 * To change this template use File | Settings | File Templates.
 */

class ReferralListener {
    const VAR_REFERRAL_ID = 'u';
    const VAR_BANNER_ID = 't';

    public static function checkVisit(){
        $referralId = Yii::app()->request->getParam(self::VAR_REFERRAL_ID);

        if($referralId){
            if($referral = Referral::model()->findByPk($referralId)){
                $referral->incrementVisit();

                if(!isset(Yii::app()->request->cookies[self::VAR_REFERRAL_ID])){
                    Yii::app()->request->cookies[self::VAR_REFERRAL_ID] = new CHttpCookie(self::VAR_REFERRAL_ID, $referralId);
                    $referral->incrementVisit(true);
                }
            }
        }
    }

    public static function checkBuy($orderId){
        $referralId = Yii::app()->request->cookies[self::VAR_REFERRAL_ID];

        if($referralId){
            if($referral = Referral::model()->findByPk($referralId)){
                $referralOrder = new ReferralOrder;
                $referralOrder->order_id = $orderId;
                $referralOrder->referral_id = Yii::app()->request->cookies[self::VAR_REFERRAL_ID];
                if($referralOrder->save()){
                    $referral->incrementBuy();
                }
            }
        }
    }

    public static function getUrl($referralId){
        $url = 'http://'.Yii::app()->shop->domain."/?";
        $url .= http_build_query(array(
            self::VAR_REFERRAL_ID => $referralId,
        ));
        return $url;
    }
}