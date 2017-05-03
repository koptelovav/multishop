<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="language" content="ru"/>
<meta http-equiv="Cache-Control" content="public">
<meta http-equiv="Cache-Control" content="no-store">
<meta http-equiv="Cache-Control" content="max-age=34700">
<meta http-equiv="Expires" content="<?= gmdate('D, d M Y H:i:s T', strtotime("+1 week"))?>">
<link href="<?= Yii::app()->shop->get('icon') ?>" rel="icon">
<meta property="og:type" content="website">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $this->pageTitle; ?></title>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/main.css"/>
<?php
$cs = Yii::app()->clientScript;

/* Core JS */
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.min.js', CCLientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.mobile-1.4.5.min.js');
/* Custom JS-variable*/
$cs->registerScript('init',"
         var paymentUrl = '".Yii::app()->createUrl('orders/getPayment')."';
         var EMSRestURL = '".Yii::app()->createUrl('EMS/rest')."';
         var CalculateShippingUrl = '".Yii::app()->createUrl('orders/shipping')."';
         var productCountUrl = '".Yii::app()->createUrl('cart/getProductCount')."';
         var addProductUrl = '".Yii::app()->createUrl('cart/add')."';
         var SendOrderDataUrl = '".Yii::app()->createUrl('cart/index')."';
         var ValidateOrderDataUrl = '".Yii::app()->createUrl('cart/validate')."';
    ", CClientScript::POS_HEAD);

/* Client JS */
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.readmore-readless.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/cart.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap.min.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/shared.js');


if(is_file(Yii::getPathOfAlias('frontend.www.themes.'.Yii::app()->theme->name.'.js').'/main.js'))
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/main.js');

/* Client CSS*/
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap-glyphicons.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/font.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/shared.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/cart.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap.min.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox.css');
