<?php
$cs = Yii::app()->clientScript;

/* Core JS */
$cs->registerCoreScript('jquery');

/* Custom JS-variable*/
$cs->registerScript('init',"
         var paymentUrl = '".Yii::app()->createUrl('orders/getPayment')."';
         var EMSRestURL = '".Yii::app()->createUrl('EMS/rest')."';
         var CalculateShippingUrl = '".Yii::app()->createUrl('orders/shipping')."';
    ", CClientScript::POS_HEAD);

/* Client JS */
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/cart.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap.min.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/shared.js');

/* Client CSS*/
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap.min.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
