<!DOCTYPE html>
<html>
<head>
    <?php $this->renderPartial('//satellite/head')?>

    <?php
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.scrollUp.js');
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/main.js');
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.montage.min.js');
    $cs->registerCssFile(Yii::app()->baseUrl.'/css/vk-comments.css');
    ?>

</head>
<body>
<?php $this->renderPartial('//satellite/yandexMetrika')?>
<div id="flash">
    <div class="inner"></div>
</div>

<div id="wrap">
    <?php $this->renderPartial('//satellite/muwu-menu')?>
    <?php /* <noindex>
        <a onclick="yaCounter22206275.reachGoal('bamboo'); return true;" id="top-banner" target="_blank" href="http://blackbamboo.ru">
            <span class="banner-text"></span>
        </a>
    </noindex>
*/ ?>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand visible-xs" href="<?= Yii::app()->createUrl('/cart/index') ;?>">Корзина(<?php echo Cart::countHtml() ?>)</a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/img/icon-home.png"/>', 'url' => Yii::app()->homeUrl, 'linkOptions'=>array('style'=> 'background-color: #ffa222 !important')),
                        array('label' => 'Все о песке', 'url' => array('/site/page', 'view' => 'kineticsand')),
                        array('label' => 'Каталог', 'url' =>  array('products/index')),
                        array('label' => 'Доставка', 'url' => array('/site/page', 'view' => 'shipping')),
                        array('label' => 'Оплата', 'url' => array('/site/page', 'view' => 'payment')),
                        array('label' => 'Отзывы', 'url' => array('/review/index')),
                        array('label' => 'Контакты', 'url' => array('/site/contact')),
                        array('label' => 'Новости', 'url' => array('/news/index')),
                        array('label' => 'Корзина('.Cart::countHtml().')', 'url' => array('/cart/index')),
                    ),
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class' => 'nav navbar-nav navbar-right'
                    )
                )); ?>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <?php echo $content; ?>
</div>

<div id="footer">
    <div class="container">
        <div class="pull-left" style="color:#44b2e5"><?php echo date('Y')?> &copy; <a href="/">KineticSand.ru</a> Все права защищены</div>
    </div>
</div>
<!-- Start SiteHeart code -->
<script>
    (function(){
        var widget_id = 729135;
        _shcp =[{widget_id : widget_id}];
        var lang =(navigator.language || navigator.systemLanguage
        || navigator.userLanguage ||"en")
            .substr(0,2).toLowerCase();
        var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
        var hcc = document.createElement("script");
        hcc.type ="text/javascript";
        hcc.async =true;
        hcc.src =("https:"== document.location.protocol ?"https":"http")
        +"://"+ url;
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
    })();
</script>
<!-- End SiteHeart code -->

</body>
</html>