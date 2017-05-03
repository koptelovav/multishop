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
<div id="flash" data-fade-out="2000">
    <div class="inner"></div>
</div>

<div id="page">
    <header>
        <div class="header-wrap container">
            <div class="header-info hidden-xs">
                <a class="logo" href="<?= Yii::app()->homeUrl ?>">
                    <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/logo/logo_xs.png" alt="">
                </a>

                <div class="phones">
                        <div class="phone hidden-xs">
                           Санкт-Петербург: <span>8 (812) 309-06-80</span>;&nbsp;&nbsp;&nbsp;Москва: <span>8 (499) 703-05-09</span>
                        </div>
                        <div class="callback">
                            Понедельник-пятница <span>с 10:00 до 20:00</span>
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
                                    array('label' => 'Каталог', 'url' =>  array('products/index'), 'linkOptions'=>array('itemprop'=>'url')),
                                    array('label' => 'Доставка', 'url' => array('/site/page', 'view' => 'shipping')),
                                    array('label' => 'Оплата', 'url' => array('/site/page', 'view' => 'payment'), 'linkOptions'=>array('itemprop'=>'url')),
                                    array('label' => 'Отзывы', 'url' => array('/review/index'), 'linkOptions'=>array('itemprop'=>'url')),
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

            <div class="header-content">
                <div>Оригинальный кинетический песок</div>
                <div>Швеция. Высокое качество. Сертификаты и гарантия</div>
                <div>Купить оригинальный шведский кинетический песок с доставкой по всей России можно в нашем интернет-магазине</div>
            </div>
        </div>


    </header>

    <div id="content" class="container">
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

        <?php echo $content; ?>
    </div>


    <div id="footer" itemscope itemtype="http://schema.org/WPFooter">
        <div class="footer-container">
            <footer id="footer" class="clearfix">
                <section class="footer-block">
                    <h4>Полезное</h4>
                    <ul>
                        <li><?php echo CHtml::link('Все о песке', array('/site/page', 'view' => 'kineticsand')) ?></li>
                        <li><a href="#">Акции</a></li>
<!--                        <li><a href="#">Новые товары</a></li>-->
<!--                        <li><a href="#">Популярные товары</a></li>-->
<!--                        <li><a href="#">Карта сайта</a></li>-->
                        <li><?php echo CHtml::link('Отзывы', array('/review/index')) ?></li>

                    </ul>
                </section>

                <div class="bottom-footer">
                    &copy; 2013-<?= date('Y')?>гг. - <a href="http://kineticsand.ru">Kineticsand.ru</a>
                    <div class="payment-types pull-right"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/payment.png') ?></div>
                </div>

                <section class="footer-block">
                    <h4>Информация</h4>
                    <ul>
                        <li><?php echo CHtml::link('Оплата', array('/site/page', 'view' => 'payment')) ?></li>
                        <li><?php echo CHtml::link('Доставка', array('/site/page', 'view' => 'shipping')) ?></li>
                        <li><?php echo CHtml::link('Безопасность', array('/site/page', 'view' => 'payment')) ?></li>
                        <li><?php echo CHtml::link('Гарантии', array('/site/page', 'view' => 'payment')) ?></li>
                        <li><?php echo CHtml::link('Обратная связь', array('/site/contact')) ?></li>
                    </ul>
                </section>
                <section class="footer-block">
                    <h4>Оплата и доставка</h4>
                    <ul>
                        <li><?php echo CHtml::link('Оплата', array('/site/page', 'view' => 'payment')) ?></li>
                        <li><?php echo CHtml::link('Доставка', array('/site/page', 'view' => 'shipping')) ?></li>
<!--                        <li><a href="#">Безопасная покупка</a></li>-->
<!--                        <li><a href="#">Оплата и возврат</a></li>-->
<!--                        <li><a href="#">Доставка и возврат</a></li>-->
                    </ul>
                </section>
                <section class="footer-block">
                    <h4>Контакты</h4>
                    <div id="contact-block">
                        <ul>
                            <li class="icon-phone"><a href="tel:<?= Yii::app()->shop->phone ?>"><?= Yii::app()->shop->phone ?></a></li>
                            <li class="icon-phone"><a href="tel:84997030509">8 (499) 703-05-09</a></li>
                            <li class="icon-mail"><a href="mailto:<?php echo Yii::app()->shop->email ?>"><?php echo Yii::app()->shop->email ?></a></li>
                            <li id="social-block">
                                <ul>
                                    <li><a class="icon-vkontakte" target="_blank" href="//vk.com/kineticsand"></a></li>
                                    <li><a class="icon-youtube" target="_blank" href="//youtube.com/channel/UCYxBVYveM1BZQjOxz9car6w"></a></li>
                                    <li><a class="icon-instagram" target="_blank" href="//instagram.com/kineticsand.ru"></a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </section>
                <section class="footer-block">
                    <h4>Мы ВКонтакте</h4>
                    <ul>
                    <script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>

                    <!-- VK Widget -->
                    <div id="vk_groups"></div>
                    <script type="text/javascript">
                        VK.Widgets.Group("vk_groups", {redesign: 1, mode: 3, width: "170", height: "400", color1: 'FFFFFF', color2: '000000', color3: '644098'}, 57874883);
                    </script>
                    </ul>
                </section>
            </footer>
        </div>
    </div>
</div>

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