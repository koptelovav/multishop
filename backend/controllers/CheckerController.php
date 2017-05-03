<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 19.11.2014
 * Time: 20:22
 */

class CheckerController extends BackEndController{
    public function actionSetData($name, $val, $checked){
        Yii::app()->checker->set($name, $val, $checked);

        var_export( Yii::app()->checker->getByType('orders'));
    }
} 