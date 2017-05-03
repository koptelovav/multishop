<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
$cs->registerScript('init',"
         var paymentUrl = '".Yii::app()->createUrl('orders/getPayment')."';
         var EMSRestURL = '".Yii::app()->createUrl('EMS/rest')."';
         var CalculateShippingUrl = '".Yii::app()->createUrl('orders/shipping')."';
    ", CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/cart.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap.min.js');
