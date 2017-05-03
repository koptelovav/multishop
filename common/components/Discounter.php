<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 29.07.13
 * Time: 11:59
 * To change this template use File | Settings | File Templates.
 */

class Discounter extends CApplicationComponent{

    protected $coupons = array(
        'vkontakte-MKL4m4564lk6',
        'vkontakte-MD26fGH1b4y2',
        'vkontakte-MMgfcf1c1CVC',
        'vkontakte-Mkldf123fdm4',
        'AMAZINGDROIDS'
    );

    public function activateCoupon($coupon){
        if(in_array($coupon, $this->coupons)){
            Yii::app()->session['coupon'] = $coupon;
            return true;
        }

        return false;
    }
    public function isActive(){
        return isset(Yii::app()->session['coupon']);
    }

    public function getActiveCoupon(){
        return isset(Yii::app()->session['coupon']) ? Yii::app()->session['coupon'] : false;
    }
}