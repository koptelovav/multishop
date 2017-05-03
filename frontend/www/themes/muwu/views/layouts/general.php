<!DOCTYPE html>
<html>
<head>
    <?php
    $this->renderPartial('//satellite/head');
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/bootstrap-slider.js');
    $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/main.js');
    $cs->registerCssFile(Yii::app()->request->baseUrl . 'css/fontello/css/fontello.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/menu.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/product.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/slider.css');
    ?>
    <link
        href="http://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic&amp;subset=latin,cyrillic"
        rel="stylesheet" type="text/css">
</head>
<body>
<?php $this->renderPartial('//satellite/yandexMetrika')?>
<div id="flash">
    <div class="inner"></div>
</div>

<div class="container-fluid">
    <header id="header">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="general-nav">
            <div class="nav-container">
                <div class="navbar-header">
                    <a class="navbar-toggle icon-menu"></a>
                    <a href="<?= Yii::app()->homeUrl ?>" class="header-logo"></a>
                    <a class="navbar-brand icon-basket" href="<?= Yii::app()->createUrl('/cart/index'); ?>">
                    <span class="cart-quantity">
                        <?= Cart::countHtml() ?>
                    </span>
                    </a>
                </div>
                <div id="slidemenu">
                        <div id="navbar-height-col">
                            <?php $this->widget('zii.widgets.CMenu', array(
                                'items' => array(
                                    array('label' => 'Каталог', 'url' => Yii::app()->homeUrl, 'itemOptions'=>array('class'=>'visible-mobile')),
                                    array('label' => 'Корзина', 'url' => array('/cart/index'), 'itemOptions'=>array('class'=>'visible-mobile')),

                                    array('label' => 'Контакты', 'url' => array('/site/contact')),
                                    array('label' => 'Доставка', 'url' => array('/site/page', 'view' => 'shipping'),),
                                    array('label' => 'Оплата', 'url' => array('/site/page', 'view' => 'payment')),
                                    array('label' => 'Новости', 'url' => array('/news/index')),
                                    array('label' => '<span class="cart-quantity>' . Cart::countHtml() . '</span>', 'url' => array('/cart/index')),
                                ),
                                'encodeLabel' => false,
                                'htmlOptions' => array(
                                    'class' => 'nav navbar-nav',
                                ),
                            )); ?>
                    </div>
                </div>
            </div>
        </nav>

        <div class="header-bottom">
            <a href="<?= Yii::app()->homeUrl ?>" class="header-logo"></a>

            <div class="cart-box">
                <a class="icon-basket" href="<?= Yii::app()->createUrl('/cart/index') ?>" title="Корзина">
                    <b>Корзина</b>
                    <span class="cart-quantity"><?= Cart::countHtml() ?></span>
                </a>
            </div>

            <div class="phone-box">
                <p class="phones icon-phone">
                    <a href="tel:8(812)309-06-80">8 (812) 309-06-80</a>;
                    <a href="tel:8(499)703-05-09">8 (499) 703-05-09</a>
                </p>
                <p class="phones-description">
                    Понедельник - пятница с 10:00 до 18:00
                </p>
            </div>

            <div class="clearfix"></div>

            <nav class="top-menu navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-toggle icon-menu" data-toggle="collapse" data-target=".navbar-ex2-collapse"></a>
                </div>

                <div class="collapse navbar-collapse navbar-ex2-collapse">
                    <?php $this->widget('frontend.widgets.CategoryMenuWidget', array(
                        'categoryTitleField' => 'short_title',
                        'options' => array(
                            'class' => 'nav navbar-nav dropdown'
                        )
                    )); ?>
                </div>
            </nav>
        </div>
</div>

</header>

<div id="main">
    <?php if(!empty($this->breadcrumbs)): ?>
        <div class="breadcrumb clearfix">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'separator' => '<i class="icon-right-open"></i>',
                'tagName'=>'ul',
                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
                'inactiveLinkTemplate'=>'<li>{label}</li>',
                'homeLink'=>'<li><a href="'.Yii::app()->homeUrl.'">Каталог</a></li>',
                'htmlOptions'=>array(
                    'class'=>'list-unstyled'
                )
            )); ?>
        </div>
    <?php endif; ?>

    <?= $content; ?>
</div>
<div class="footer-container">
    <footer id="footer" class="clearfix">
        <section class="footer-block">
            <h4>Полезное</h4>
            <ul>
                <li><?php echo CHtml::link('О магазине', array('/site/page', 'view' => 'about')) ?></li>
                <li><a href="#">Скидки</a></li>
                <li><a href="#">Новые товары</a></li>
                <li><a href="#">Популярные товары</a></li>
                <li><a href="#">О магазине</a></li>
                <li><a href="#">Карта сайте</a></li>
                <li><?php echo CHtml::link('Обратная связь', array('/site/contact')) ?></li>
            </ul>
        </section>

        <div class="bottom-footer">
            &copy; <?php echo date('Y') ?> <a href="http://muwu.ru">MuWu.ru</a> Все права защищены
            <div class="payment-types pull-right"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/payment.png') ?></div>
        </div>

        <section class="footer-block">
            <h4>Информация</h4>
            <ul>
                <li><a href="#">Сервис</a></li>
                <li><a href="#">Безопасность</a></li>
                <li><a href="#">Гарантии</a></li>

                <li><?php echo CHtml::link('Обратная связь', array('/site/contact')) ?></li>
            </ul>
        </section>
        <section class="footer-block">
            <h4>Оплата и доставка</h4>
            <ul>
                <li><?php echo CHtml::link('Оплата', array('/site/page', 'view' => 'payment')) ?></li>
                <li><?php echo CHtml::link('Доставка', array('/site/page', 'view' => 'shipping')) ?></li>
                <li><a href="#">Безопасная покупка</a></li>
                <li><a href="#">Оплата и возврат</a></li>
                <li><a href="#">Доставка и возврат</a></li>
            </ul>
        </section>
        <section class="footer-block">
            <h4>Контакты</h4>
            <div id="contact-block">
                <ul itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <li class="icon-location">
                            <span itemprop="postalCode">197082</span>,
                            <span itemprop="addressLocality">г. Санкт-Петербург</span>
                            <span itemprop="streetAddress">улица Туристская 23к2, оф. 20-Н</span><br/>
                    </li>
                    <li class="icon-phone"><a href="tel:<?= Yii::app()->shop->phone ?>" itemprop="telephone" ><?= Yii::app()->shop->phone ?></a></li>
                    <li class="icon-mail"><a href="mailto:<?php echo Yii::app()->shop->email ?>"><?php echo Yii::app()->shop->email ?></a></li>
                    <li id="social-block">
                        <ul>
                            <li><a class="icon-vkontakte" href="#"></a></li>
                            <li><a class="icon-youtube" href="#"></a></li>
                            <li><a class="icon-instagram" href="#"></a></li>
                            <li><a class="icon-rss" href="#"></a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </section>
    </footer>
</div>

<?php $this->renderPartial('//satellite/jivosite'); ?>

</body>
</html>