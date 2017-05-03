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
    $cs->registerCssFile(Yii::app()->request->baseUrl . 'css/fontello/css/fontello.css');
    ?>

</head>
<body>
<?php $this->renderPartial('//satellite/yandexMetrika')?>
<div id="flash">
    <div class="inner"></div>
</div>

<div id="page">
    <header>
            <div class="header-wrap">
                <div class="header-info hidden-xs">
                    <a class="logo" href="<?= Yii::app()->homeUrl ?>">
                        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/logo/logo_sm.png" alt="">
                    </a>

                    <div class="phones">
                            <div class="phone hidden-xs">
                               Телефон: <span>8 (812) 309-68-83</span>;&nbsp;&nbsp;&nbsp;Понедельник-пятница <span>с 10:00 до 20:00</span>
                            </div>
                            <div class="callback">
                                Оналайн-консультант: <span>Ежедневно с 09:00 до 00:00</span>
                            </div>
                    </div>
                </div>

                <div itemscope itemtype="http://schema.org/SiteNavigationElement">
                    <nav id="navigation" class="navbar navbar-default" role="navigation">
                            <div class="row navbar-header">
                                <div class="col-xs-3 icon-box menu-box">
                                    <button data-toggle="collapse" data-target=".navbar-ex1-collapse" class="icon-menu navbar-toggle visible-xs""></button>
                                </div>
                                <div class="col-xs-6 header-logo visible-xs">
                                    <a class="logo" href="<?= Yii::app()->homeUrl ?>">
                                        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/logo/logo_xs.png" alt="">
                                    </a>
                                </div>
                                <div class="col-xs-3 icon-box shopping-cart">
                                    <a class="icon-basket visible-xs" href="<?= Yii::app()->createUrl('/cart/index') ;?>"> <?php echo Cart::countHtml() ?></a>
                                </div>
                            </div>

                            <div class="collapse navbar-collapse navbar-ex1-collapse">
                                <?php $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array('label' => 'Главная', 'url' => Yii::app()->homeUrl, 'linkOptions'=>array('itemprop'=>'url')),
                                        array('label' => 'Каталог', 'url' => Yii::app()->homeUrl.'#catalog', 'linkOptions'=>array('itemprop'=>'url')),
                                        array('label' => 'Оплата и Доставка', 'url' => array('/site/page', 'view' => 'payment_shipping')),
//                                        array('label' => '', 'url' => array('/site/page', 'view' => 'payment'), 'linkOptions'=>array('itemprop'=>'url')),
//                                        array('label' => 'Отзывы', 'url' => array('/review/index'), 'linkOptions'=>array('itemprop'=>'url')),
                                        array('label' => 'Контакты', 'url' => array('/site/contact'), 'linkOptions'=>array('itemprop'=>'url')),
                                        array('label' => 'Новости', 'url' => array('/news/index'), 'linkOptions'=>array('itemprop'=>'url')),
                                        array('label' => 'Корзина [ '.Cart::countHtml().' ]', 'url' => array('/cart/index'), 'linkOptions'=>array('itemprop'=>'url','class'=>'icon-basket hidden-xs')),
                                    ),
                                    'encodeLabel' => false,
                                    'htmlOptions' => array(
                                        'class' => 'nav navbar-nav',
                                    ),
                                )); ?>
                            </div><!-- /.navbar-collapse -->
                    </nav>
                </div>

                <div class="clearfix"></div>
            </div>
    </header>

    <?php if(!empty($this->breadcrumbs)): ?>
        <div class="breadcrumb clearfix">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'separator' => '<i class="icon-right-open"></i>',
                'tagName'=>'ul',
                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
                'inactiveLinkTemplate'=>'<li>{label}</li>',
                'homeLink'=>'<li><a href="'.Yii::app()->createUrl('products/index').'">Каталог</a></li>',
                'htmlOptions'=>array(
                    'class'=>'list-unstyled'
                )
            )); ?>
        </div>
    <?php endif; ?>

    <div id="content" class="container">
        <?php echo $content; ?>
    </div>


    <div id="footer" itemscope itemtype="http://schema.org/WPFooter">
        <div class="footer-container">
            <footer id="footer" class="clearfix">
                <div class="bottom-footer">
                    &copy; <?= date('Y')?>гг. - <a href="http://myhatchimals.ru">Myhatchimals.ru</a>
                    <div class="payment-types pull-right"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/payment.png') ?></div>
                </div>
            </footer>
        </div>
    </div></div>

<?php $this->renderPartial('//satellite/jivosite'); ?>

<?php /*
<script type="text/javascript">
    var _cp = {trackerId: 29614};
    (function(d){
        var cp=d.createElement('script');cp.type='text/javascript';cp.async = true;
        cp.src='//tracker.cartprotector.com/cartprotector.js';
        var s=d.getElementsByTagName('script')[0]; s.parentNode.insertBefore(cp, s);
    })(document);
</script>
*/ ?>
</body>
</html>