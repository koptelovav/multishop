<!DOCTYPE html>
<html>
<head>
    <?php $this->renderPartial('//satellite/head')?>

    <?php
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.scrollUp.js');
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/owl.carousel/owl.carousel.min.js');
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.montage.min.js');
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/main.js');
    $cs->registerCssFile(Yii::app()->baseUrl.'/css/vk-comments.css');
    $cs->registerCssFile(Yii::app()->baseUrl.'/js/owl.carousel/assets/owl.carousel.css');
    ?>

</head>
<body>
<?php $this->renderPartial('//satellite/yandexMetrika')?>
<div id="flash">
    <div class="inner"></div>
</div>

<div id="wrap">
    <div itemscope itemtype="http://schema.org/SiteNavigationElement">
    <nav id="general-nav" class="navbar navbar-default" role="navigation">
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
                        array('label' => 'Главная', 'url' => Yii::app()->homeUrl, 'linkOptions'=>array('itemprop'=>'url')),
                        array('label' => 'Все о песке', 'url' => array('/site/page', 'view' => 'kineticsand'), 'linkOptions'=>array('itemprop'=>'url')),
                        array('label' => 'Каталог', 'url' =>  array('products/index'), 'linkOptions'=>array('itemprop'=>'url')),
                        array('label' => 'Доставка', 'url' => array('/site/page', 'view' => 'shipping')),
                        array('label' => 'Оплата', 'url' => array('/site/page', 'view' => 'payment'), 'linkOptions'=>array('itemprop'=>'url')),
                        array('label' => 'Отзывы', 'url' => array('/review/index'), 'linkOptions'=>array('itemprop'=>'url')),
                        array('label' => 'Контакты', 'url' => array('/site/contact'), 'linkOptions'=>array('itemprop'=>'url')),
                        array('label' => 'Новости', 'url' => array('/news/index'), 'linkOptions'=>array('itemprop'=>'url')),
                        array('label' => 'Корзина('.Cart::countHtml().')', 'url' => array('/cart/index'), 'linkOptions'=>array('itemprop'=>'url')),
                    ),
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class' => 'nav navbar-nav navbar-right',
                    ),
                )); ?>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    </div>

    <?php echo $content; ?>
</div>

<div id="footer" itemscope itemtype="http://schema.org/WPFooter">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <?php $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Все о песке', 'url' => array('/site/page', 'view' => 'kineticsand')),
                        array('label' => 'Новости', 'url' => array('/news/index')),
                        array('label' => 'Контакты', 'url' => array('/site/contact')),
                        array('label' => 'Корзина('.Cart::countHtml().')', 'url' => array('/cart/index')),
                    ),
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class' => 'nav'
                    )
                )); ?>
            </div>

            <div class="col-lg-4">
                <p>Санкт-Петербург, Туристская 23к2, <br>инетернет-магазин Му!Ву!
                <p>Телефон: <?php echo Yii::app()->shop->phone ?></p>
                <p>Почта: <a href="mailto:<?php echo Yii::app()->shop->email ?>"><?php echo  Yii::app()->shop->email ?></a></p>
            </div>
            <div class="col-lg-4">
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
                <div id="vk_groups"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 0, width: "350", height: "160", color1: '644098', color2: 'FFFFFF', color3: 'EC0081'}, 57874883);
                </script>
            </div>
        </div>
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