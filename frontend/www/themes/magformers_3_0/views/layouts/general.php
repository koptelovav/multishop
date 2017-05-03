<!DOCTYPE html>
<html>
<head>
    <?php
    $this->renderPartial('//satellite/head');
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/bootstrap-slider.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/sticky-kit.js');
    $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/main.js');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/non-responsive.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl . 'css/fontello/css/fontello.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/menu.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/product.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/sidebar.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/slider.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/filter.css');

    if(empty($this->bannerUrl)){
        $this->bannerUrl = Yii::app()->media->baseUrl.'/images/products/mymagformers_2_0/category_background/default.jpg';
        $this->headerClass = FrontEndController::HEADER_SLIM;
    }
    ?>
</head>
<body>
<?php $this->renderPartial('//satellite/yandexMetrika') ?>
<div id="flash">
    <div class="inner"></div>
    <div class="flash--action">
        <a href="#" class="btn btn--blue flash--close">
            <div class="btn--inside">
                продожить покупки
            </div>
        </a>

        <a href="<?= Yii::app()->createUrl('cart/index')?>" class="btn">
            <div class="btn--inside">
                оформить заказ
            </div>
        </a>
    </div>
    <a href="#" class="flash--close flash--close-button">х</a>
</div>


<header id="header" style="background-image: url(<?= $this->bannerUrl ?>)" class="<?= $this->headerClass ?>">
    <div class="header--top">
        <div class="container">
            <a href="<?= Yii::app()->homeUrl ?>" class="header--logo"></a>

            <div class="cart-box">
                <a class="icon-basket" href="<?= Yii::app()->createUrl('/cart/index') ?>" title="Корзина">
                    <span class="cart-quantity"><?= Cart::countHtml() ?></span>
                </a>
            </div>

            <div class="phone-box hidden-xs">
                <p class="phones icon-phone">
                    <a href="tel:8(499)703-05-09">8 (499) 703-05-09</a>;
                    <a href="tel:8(812)309-06-80">8 (812) 309-06-80</a>
                </p>
            </div>
        </div>
    </div>

    <div class="top-menu--wrap">
        <div class="container">
            <nav class="top-menu navbar" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                    <?php $this->widget('zii.widgets.CMenu', [
                        'items' => [
                            ['label' => 'Каталог', 'url' => ['/category/view', 'cid' => 32], 'linkOptions' => ['data-section' => 0, 'itemprop'=>'url']],
                            ['label' => 'О конструкторе', 'url' => ['/site/page', 'view' => 'about'], 'linkOptions' => ['data-section' => 1, 'itemprop'=>'url']],
                            ['label' => 'Доставка и Оплата', 'url' => ['/site/page', 'view' => 'shipping'], 'linkOptions' => ['data-section' => 2, 'itemprop'=>'url']],
                            ['label' => 'Контакты', 'url' => ['/site/contact'], 'linkOptions' => ['data-section' => 3, 'itemprop'=>'url']],
                            ['label' => 'Новости', 'url' => ['/news/index'], 'linkOptions' => ['data-section' => 4, 'itemprop'=>'url']],
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
    </div>

    <div class="top-menu--dropdown">
        <div class="container">
            <div class="dropdown--section category-menu--section" data-section="0">
                <?php $this->renderPartial('//dropDownMenu/category') ?>
                <div class="top-menu--dropdown--background"></div>
            </div>
            <div class="dropdown--section about-menu--section" data-section="1">
                <?php $this->renderPartial('//dropDownMenu/about') ?>
                <div class="top-menu--dropdown--background"></div>
            </div>
            <div class="dropdown--section shipping-payment-menu--section" data-section="2">
                <?php $this->renderPartial('//dropDownMenu/shipping_payment') ?>
                <div class="top-menu--dropdown--background"></div>
            </div>
            <div class="dropdown--section contact-menu--section" data-section="3">
                <?php $this->renderPartial('//dropDownMenu/contact') ?>
                <div class="top-menu--dropdown--background"></div>
            </div>
            <div class="dropdown--section news-menu--section" data-section="4">
                <?php $this->renderPartial('//dropDownMenu/news') ?>
                <div class="top-menu--dropdown--background"></div>
            </div>

            <div class="top-menu--dropdown--close">свернуть</div>
        </div>
    </div>

    <div class="top-menu--overlay"></div>

    <div class="header--content">
        <div class="container">
            <div><?= $this->firstTitle ?></div>
            <div><?= $this->secondTitle ?></div>
            <div><?= $this->thirdTitle ?></div>
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
    <nav class="footer-menu navbar" role="navigation">
        <div class="container">
            <div class="collapse navbar-collapse navbar-ex2-collapse">
                <?php $this->widget('zii.widgets.CMenu', [
                    'items' => [
                        ['label' => 'Каталог', 'url' => ['/category/view', 'cid' => 32], 'linkOptions' => ['data-section' => 0]],
                        ['label' => 'О конструкторе', 'url' => ['/site/page', 'view' => 'about'], 'linkOptions' => ['data-section' => 1]],
                        ['label' => 'Доставка и Оплата', 'url' => ['/site/page', 'view' => 'shipping'], 'linkOptions' => ['data-section' => 2]],
                        ['label' => 'Контакты', 'url' => ['/site/contact'], 'linkOptions' => ['data-section' => 3]],
                        ['label' => 'Новости', 'url' => ['/news/index'], 'linkOptions' => ['data-section' => 4]],
                    ],
                    'activateParents' => true,
                    'linkLabelWrapper' => 'span',
                ]); ?>
            </div>
        </div>
    </nav>
    <div class="footer--questions">
        <div class="container">
            <div class="footer--questions--inside">
                <div class="footer--questions--question">
                    Остались вопросы?
                </div>
                <div class="callback">
                    <a href="<?php echo Yii::app()->createUrl('callback/create')?>" class="callback-button footer--questions--link">заказать обратный звонок</a>
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

<?php /*<div class="footer-container">
    <footer id="footer" class="clearfix">
        <section class="footer-block">
            <h4>Полезное</h4>
            <ul>
                <li><?php echo CHtml::link('О магазине', array('/site/page', 'view' => 'about')) ?></li>
                <li><a href="#">Скидки</a></li>
                <li><a href="#">Популярные товары</a></li>
                <li><a href="#">О магазине</a></li>
                <li><?php echo CHtml::link('Обратная связь', array('/site/contact')) ?></li>
            </ul>
        </section>

        <div class="bottom-footer">
            &copy; <?php echo date('Y') ?> <a href="http://muwu.ru">MuWu.ru</a> Все права защищены
            <div
                class="payment-types pull-right"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/payment.png') ?></div>
        </div>

        <section class="footer-block">
            <h4>Информация</h4>
            <ul>
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
                <li><a href="#">Возврат</a></li>
            </ul>
        </section>
        <section class="footer-block">
            <h4>Контакты</h4>
            <div id="contact-block">
                <ul>
                    <li class="icon-phone"><a
                            href="tel:<?= Yii::app()->shop->phone ?>"><?= Yii::app()->shop->phone ?></a></li>
                    <li class="icon-phone"><a href="tel:84997030509">8 (499) 703-05-09</a></li>
                    <li class="icon-mail"><a
                            href="mailto:<?php echo Yii::app()->shop->email ?>"><?php echo Yii::app()->shop->email ?></a>
                    </li>
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
        <section class="footer-block">
            <h4>Мы ВКонтакте</h4>
            <ul>
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>

                <!-- VK Widget -->
                <div id="vk_groups"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {
                        redesign: 1,
                        mode: 3,
                        width: "170",
                        height: "400",
                        color1: 'FFFFFF',
                        color2: '000000',
                        color3: '644098'
                    }, 57320319);
                </script>
            </ul>
        </section>
    </footer>*/ ?>

<?php $this->renderPartial('//satellite/jivosite'); ?>

</body>
</html>