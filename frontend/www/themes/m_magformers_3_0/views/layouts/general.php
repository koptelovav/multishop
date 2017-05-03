<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>
    <meta http-equiv="Cache-Control" content="public">
    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Cache-Control" content="max-age=34700">
    <meta http-equiv="Expires" content="<?= gmdate('D, d M Y H:i:s T', strtotime("+1 week"))?>">
    <link href="<?= Yii::app()->shop->get('icon') ?>" rel="icon">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= $this->pageTitle; ?></title>

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
    $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/slick/slick.min.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/bootstrap-slider.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.readmore-readless.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/cart.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap.min.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/shared.js');
    $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/main.js');


    if(is_file(Yii::getPathOfAlias('frontend.www.themes.'.Yii::app()->theme->name.'.js').'/main.js'))
        $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/main.js');

    /* Client CSS*/
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap-glyphicons.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/shared.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/cart.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap.min.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl . '/js/slick/slick.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl . '/js/slick/slick-theme.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/non-responsive.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl . 'css/fontello/css/fontello.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/main.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/menu.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/product.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/sidebar.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/slider.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/filter.css');

    if (empty($this->bannerUrl)) {
        $this->bannerUrl = Yii::app()->media->baseUrl . '/images/products/mymagformers_2_0/category_background/default.jpg';
    }

    ?>

</head>
<body>
<?php $this->renderPartial('//satellite/yandexMetrika') ?>

<div class="wrapper">
<div id="flash">
    <div class="inner"></div>
    <div class="flash--action">
        <a href="#" class="btn btn--blue flash--close">
            <div class="btn--inside">
                продожить покупки
            </div>
        </a>

        <a href="<?= Yii::app()->createUrl('cart/index') ?>" class="btn">
            <div class="btn--inside">
                оформить заказ
            </div>
        </a>
    </div>
    <a href="#" class="flash--close flash--close-button">х</a>
</div>

<header id="header">
    <div class="header-fixed--content fixed"  style="background-image: url(<?= $this->bannerUrl ?>)">
    <div class="container">
        <span class="header-menu">
            <span class="header-menu--line"></span>
        </span>

        <div class="header--logo-wrap">
            <a href="<?= Yii::app()->homeUrl ?>" class="header--logo"></a>
        </div>

        <div class="cart-box">
            <a class="icon-basket" href="<?= Yii::app()->createUrl('/cart/index') ?>" title="Корзина">
                <span class="cart-quantity"><?= Cart::countHtml() ?></span>
            </a>
        </div>

        <div class="header--menu">
            <div class="header--menu--top">
                <div class="header--menu--close"></div>

                <div class="phone-box">
                    <div><a href="tel:8(499)703-05-09">8 (499) 703-05-09</a></div>
                    <div><a href="tel:8(812)309-06-80">8 (812) 309-06-80</a></div>
                </div>

                <div class="cart-box">
                    <a class="icon-basket" href="<?= Yii::app()->createUrl('/cart/index') ?>" title="Корзина">
                        <span class="cart-quantity"><?= Cart::countHtml() ?></span>
                    </a>
                </div>
            </div>

            <div class="header--menu--content">
                <div class="header--menu--group-title">Меню</div>
                <div class="header--menu--content-item">
                    <nav class="header-navbar navbar" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                        <?php $this->widget('zii.widgets.CMenu', [
                            'items' => [
                                ['label' => 'Главная', 'url' => Yii::app()->homeUrl, 'linkOptions' => ['itemprop'=>'url']],
                                ['label' => 'Каталог', 'url' => '#header-menu--catalog', 'linkOptions'=>['class'=>'scroll-link','itemprop'=>'url']],
                                ['label' => 'О конструкторе', 'url' => ['/site/page', 'view' => 'about'], 'linkOptions' => ['itemprop'=>'url']],
                                ['label' => 'Доставка и Оплата', 'url' => ['/site/page', 'view' => 'shipping'], 'linkOptions' => ['itemprop'=>'url']],
                                ['label' => 'Контакты', 'url' => ['/site/contact'], 'linkOptions' => ['itemprop'=>'url']],
                                ['label' => 'Новости', 'url' => ['/news/index'], 'linkOptions' => ['itemprop'=>'url']],
                                ['label' => 'Корзина', 'url' => ['/cart/index'], 'linkOptions' => ['itemprop'=>'url']],
                            ],
                            'activateParents' => true,
                            'linkLabelWrapper' => 'span',
                            'htmlOptions' => [
                                'class' => 'nav navbar-nav dropdown'
                            ]
                        ]); ?>

                        <span class="top-menu--active-line"></span>
                    </nav>
                </div>
                <div id="header-menu--catalog" class="header--menu--group-title">Каталог (15 категорий)</div>
                <div class="item">
                    <?php $this->renderPartial('//dropDownMenu/category') ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>

<div id="main">
    <?php if (!empty($this->breadcrumbs)): ?>
        <div class="breadcrumb clearfix" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <div class="container">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'separator' => '<i class="icon-right-open"></i>',
                    'tagName' => 'ul',
                    'activeLinkTemplate' => '<li><a href="{url}" itemprop="url"><span itemprop="title">{label}</span></a></li>',
                    'inactiveLinkTemplate' => '<li itemprop="title">{label}</li>',
                    'homeLink' => '<li><a href="' . Yii::app()->createUrl('category/view',['cid'=>32]) . '"  itemprop="url"><span itemprop="title">Каталог</span></a></li>',
                    'htmlOptions' => array(
                        'class' => 'list-unstyled'
                    )
                )); ?>
            </div>
        </div>
    <?php endif; ?>

    <?= $content; ?>
</div>

<footer class="footer">
    <div class="footer--questions">
        <div class="container">
            <div class="footer--questions--inside">
                <div class="footer--questions--question">
                    Остались вопросы?
                </div>
                <div class="callback">
                    <a href="<?php echo Yii::app()->createUrl('callback/create') ?>"
                       class="callback-button footer--questions--link">заказать обратный звонок</a>
                </div>
                <div class="online-consultant">
                    <a href="#" class="footer--questions--link" onclick="jivo_api.open();return false;">онлайн-консультант</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer--copyright">
        <div class="container">
            <p>Авторизованный ресселер Magformers&reg; на территории России. Весь материал, размещенный на сайте,
                является собственностью компании и защищен авторскими правами.</p>
            <p>&copy; MyMagformers.ru, 2013-<?= date('Y') ?></p>
        </div>
    </div>
</footer>
</div>



<?php $this->renderPartial('//satellite/jivosite'); ?>
</body>
</html>