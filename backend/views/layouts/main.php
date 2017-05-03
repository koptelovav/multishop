<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>
    <title><?php echo $this->pageTitle; ?></title>

    <?php
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap.min.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/whhg.css');
    $cs->registerCoreScript('jquery');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.cookie.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/main.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap.min.js');
    Yii::app()->shop->registerTemplateCss();
    ?>
</head>
<body>
<div id="wrap">
    <nav class="navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Товары', 'url' => array('products/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Products.*')),
                        array('label' => 'Заказы', 'url' => array('/orders/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Orders.*')),
                        array('label' => 'Заказы на сборку', 'url' => array('/orders/picker'), 'visible'=>Yii::app()->user->checkAccess('backend.Orders.Picker')),
                        array('label' => 'Новости', 'url' => array('/news/index'), 'visible'=>Yii::app()->user->checkAccess('backend.News.*')),
//                        array('label' => 'Карты', 'url' => array('/card/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Card.*')),
//                        array('label' => 'Бланк', 'url' => array('/sellerForm/index'), 'visible'=>Yii::app()->user->checkAccess('backend.SellerForm.*')),
//                        array('label' => 'ЗП', 'url' => array('/sellerForm/payrollPreparation'), 'visible'=>Yii::app()->user->checkAccess('backend.SellerForm.*')),
                        array('label' => 'Настройки каталога', 'url' => array('#'), 'linkOptions'=> array('class'=>'dropdown-toggle','data-toggle'=>'dropdown'), 'itemOptions'=> array('class'=>'dropdown'), 'items'=>array(
                            array('label' => 'Акции', 'url' => array('discount/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Discount.*')),
                            array('label' => 'Загрузка изображений', 'url' => array('image/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Image.*')),
                            array('label' => 'Атрибуты товаров', 'url'=>array('attribute/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Attribute.*')),
                            array('label' => 'Вложения', 'url' => array('attachment/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Attachment.*')),
                            array('label' => 'Прайс лист', 'url' => array('products/priceList'), 'visible'=>Yii::app()->user->checkAccess('backend.Products.*')),
                            array('label' => 'Производители', 'url'=>array('manufacturer/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Manufacturer.*')),
                            array('label' => 'Категории', 'url'=>array('category/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Category.*')),
                            array('label' => 'Блоки товаров', 'url'=>array('blockProduct/index'), 'visible'=>Yii::app()->user->checkAccess('backend.BlockProduct.*')),
                            array('label' => 'Детали (Части)', 'url'=>array('piece/index'), 'visible'=>Yii::app()->user->checkAccess('backend.BlockProduct.*')),
                        ), 'visible'=>Yii::app()->user->checkAccess('backend.Products.*')),
                        array('label' => 'Настройки магазина', 'url' => array('#'), 'linkOptions'=> array('class'=>'dropdown-toggle','data-toggle'=>'dropdown'), 'itemOptions'=> array('class'=>'dropdown'), 'items'=>array(
                            array('label' => 'Магазины', 'url' => array('/shop/index'), 'visible'=>Yii::app()->user->checkAccess('backend.Shop.*')),
                            array('label' => 'Товары в письме', 'url'=>array('ShopEmailTemplateProduct/index')),
                            array('label' => 'Статусы заказа', 'url' => array('orderStatus/index')),
                            array('label' => 'Статусы оплаты', 'url' => array('orderPaymentStatus/index')),
                            array('label' => 'Блоки товаров', 'url' => array('block/index')),
                            array('label' => 'Галлерея', 'url' => array('gallery/index')),
                            array('label' => 'Альбомы', 'url' => array('galleryAlbum/index')),
                            array('label' => 'Блоки товаров', 'url' => array('block/index')),
                            array('label' => 'Права доступа', 'url' => array('rights/authItem')),
                            array('label' => 'SMS-оповещения', 'url' => array('service/sms'), 'visible'=>Yii::app()->user->checkAccess('backend.Service.*')),
                            array('label' => 'Динакмика заказов', 'url' => array('statistics/dynamicsOrders'), 'visible'=>Yii::app()->user->checkAccess('backend.Statistics.*')),
                            array('label' => 'Сбросить кэш', 'url' => array('site/dropCache')),
                        ), 'visible'=>Yii::app()->user->checkAccess('backend.orderPaymentStatus.*')),
                        array('label' => 'Выход', 'url' => array('/site/logout')),
                    ),
                    'htmlOptions' => array(
                        'class' => 'nav navbar-nav navbar-right'
                    ),
                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                )); ?>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <div id="main">
        <div class="container-fluid">
            <?= $content; ?>
        </div>
    </div>
</div>
</body>
</html>