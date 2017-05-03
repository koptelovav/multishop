<?php
$root = dirname(__FILE__).'/../..';
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend');
Yii::setPathOfAlias('backend', $root . DIRECTORY_SEPARATOR . 'backend');
Yii::setPathOfAlias('media', $root . DIRECTORY_SEPARATOR . 'media');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Common',
    'language' => 'ru',
    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'common.models.*',
        'common.components.*',
        'common.classes.*',
        'common.classes.api.*',
        'common.classes.billing.*',
        'common.classes.delivery.*',
        'common.classes.notifier.*',
        'common.classes.manager.*',
        'common.modules.rights.*',
        'common.modules.rights.models.*',
        'common.modules.rights.components.*',
        'common.extensions.mail.YiiMailMessage',
        'editable.*'
    ),

    'behaviors' => array(

    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool

        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'45024502',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('*.*.*.*'),
        ),

        'rights' => array(
            'userNameColumn' => 'login',
            'appLayout'=>'backend.views.layouts.main',
        ),
    ),

    // application components
    'components'=>array(
        'ePdf' => array(
            'class'         => 'common.extensions.yii-pdf.EYiiPdf',
            'params'        => array(
                'mpdf'     => array(
                    'librarySourcePath' => 'common.extensions.yii-pdf.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                    /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode'              => '', //  This parameter specifies the mode of the new document.
                        'format'            => 'A4', // format A4, A5, ...
                        'default_font_size' => 0, // Sets the default document font size in points (pt)
                        'default_font'      => '', // Sets the default font-family for the new document.
                        'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                        'mgr'               => 15, // margin_right
                        'mgt'               => 16, // margin_top
                        'mgb'               => 16, // margin_bottom
                        'mgh'               => 9, // margin_header
                        'mgf'               => 9, // margin_footer
                        'orientation'       => 'P', // landscape or portrait orientation
                    )*/
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'common.extensions.yii-pdf.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php',
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    // For adding to Yii::$classMap
                    /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)

                        'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )*/
                )
            ),
        ),
        //X-editable config
        'editable' => array(
            'class'     => 'editable.EditableConfig',
            'form'      => 'plain',        //form style: 'bootstrap', 'jqueryui', 'plain'
            'mode'      => 'popup',            //mode: 'popup' or 'inline'

            'defaults'  => array(              //default settings for all editable elements
                'emptytext' => 'не заполнено',
                'onSave' => 'js: function(e, params) {
                    alert("Saved value: " + params.newValue);
}',
            )
        ),

        'paymentRobokassa' => array(
            'sMerchantLogin' => 'bamboogroup',
            'sMerchantPass1' => 'o1Tiz7oQdA5GE38vvhEvMS2V',
            'sMerchantPass2' => 'mhIH9ptD3dFFiqQBncJZlfYC',
            'orderModel' => 'Orders',
            'priceField' => 'total',
            'class' => 'common.classes.billing.RobokassaBilling'
        ),
        'paymentYandexKassa' => array(
//              'scId' => '528054',
            'scId' => '36963',
            'shopId' => '103664',
            'ShopPassword' => '5d6594d94351d13304c9',
    //        'ShopPassword' => '451774341347#cd',
            'class' => 'common.classes.billing.YandexKassaBilling'
        ),
        'paymentAvangard' => array(
            'class' => 'common.classes.billing.AvangardBilling',
            'shopSign' => 'NwtswBFDSYUTIbtrEHvC',
            'avangardSign' => 'mnASiGieNzHdQjyjqVXT',
            'shopId' => '5463',
            'shopPassword' => 'iTvFyGwsrl',
            'orderModel' => 'Orders',
            'priceField' => 'total',
        ),
        'paymentInvoice' => array(
            'class' => 'common.classes.billing.InvoiceBilling',
            'orderModel' => 'Orders',
        ),
        'posylka' => array
        (
            'class' => 'common.classes.api.GdePosylkaApi',
            'apikey' => '603879.199a0b6445',
        ),
        'sms' => array
        (
            'class' => 'common.classes.api.SmsApi',
            'apiId' => '9bbc4949-ecef-a1e4-61a4-7bdac360b664',
        ),
        'edost' => array
        (
            'class' => 'common.classes.api.EDostApi',
//            'shopId' => '3359',
//            'shopPassword' => 'iFOatdWP6RPo8yHUOsVnLf9Ff56tj8sE',
        ),
        'glavpunkt' => array
        (
            'class' => 'common.classes.api.GlavpunktAPI',
            'login' => 'kineticsand',
            'token' => '104736fdbf8406889d66811d962adfe9',
        ),
        'store' => array
        (
            'class' => 'common.classes.api.StoreApi',
            'url' => 'http://store.blackbamboo.ru/sale/sale',
//            'url' => 'http://store.blackbamboo.local/sale/sale',
        ),
        'vk' => array
        (
            'class' => 'common.classes.api.VkApi',
            'api_secret' => '5xJb8P56dNGYvmxrKuHb',
            'app_id' => '4858913',
            'api_url' => 'https://api.vk.com/method/',
        ),

        'printPost' => array
        (
            'class' => 'common.classes.api.PrintPostApi',
        ),
        'themeManager'=>array(
            'basePath' => Yii::getPathOfAlias('frontend.www.themes'),
        ),
        'cart' => array(
            'productModel' => 'Products',
            'priceField' => 'currentPrice',
            'class' => 'Cart',
        ),
        'mail' => array(
            'class' => 'common.extensions.mail.YiiMail',
            'transportType' => 'php',
            'viewPath' => 'frontend.views.mail',
            'logging' => true,
            'dryRun' => false
        ),
        'discounter' => array(
            'class' => 'Discounter',
        ),
        'shippingCalculator' => array(
            'class' => 'ShippingCalculator',
        ),
        'CDEKApi' => array(
            'class' => 'CDEKApi',
        ),

        'media' => array(
            'class' => 'Media',
//            'server' => '//media.blackbamboo.ru'
//            'server' => '//media.bamboo.local'
        ),

        'image'=>array(
            'class'=>'common.extensions.imageapi.CImage',
            'presets'=>array(
                'thumbnail'=>array(
                    'cacheIn'=>'media.www.images.cache.normthumb',
                    'actions'=>array(
                        'scaleAndNormalize'=>array('width'=>640,
                            'height'=>480),
                    ),
                ),
                'thumbnailSlimArmor'=>array(
                    'cacheIn'=>'media.www.images.cache.thumbnail',
                    'actions'=>array(
                        'scale'=>array('width'=>760,
                            'height'=>550),
                    ),
                ),

                'bbthumbnail'=>array(
                    'cacheIn'=>'media.www.images.cache.bb.thumbnail',
                    'actions'=>array(
                        'scaleAndNormalize'=>array('width'=>170,
                            'height'=>170),
                    ),
                ),

                'big'=>array(
                    'cacheIn'=>'media.www.images.cache.big',
                    'actions'=>array(
                        'scale'=>array('width'=>1200,
                            'height'=>1200),
                    ),
                ),
                'mini'=>array(
                    'cacheIn'=>'media.www.images.cache.mini',
                    'actions'=>array(
                        'scale'=>array('width'=>100,
                            'height'=>100),
                    ),
                ),
                'news'=>array(
                    'cacheIn'=>'media.www.images.cache.news',
                    'actions'=>array(
                        'scale'=>array('width'=>350,
                            'height'=>350),
                    ),
                ),
                'view'=>array(
                    'cacheIn'=>'media.www.images.cache.view',
                    'actions'=>array(
                        'scaleAndNormalize'=>array('width'=>640,
                            'height'=>640),
                    ),
                ),
            ),
        ),

        'imageApi'=>array(
            'class'=>'common.extensions.imageapi.BambooImage',
            'cacheIn'=>'media.www.images.cache',
        ),
        'user'=>array(
            'class' => 'RWebUser',
            'allowAutoLogin'=>true,
        ),

        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'defaultRoles' => array('Guest') // дефолтная роль
        ),

        'shop' => array(
            'class' => 'ShopConfig',
        ),
        'globalSettings' => array(
            'class' => 'GlobalSettingsComponent',
        ),

        'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=u6789569_default',
            'emulatePrepare' => true,
            'enableParamLogging' => true,
//            'username' => 'u6789569_default',
//            'password' => 'nmzLyi89',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',

        /*    'enableProfiling'=>true,*/
        ),

        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
              /*  array(
                    // направляем результаты профайлинга в ProfileLogRoute (отображается
                    // внизу страницы)
                    'class'=>'CFileLogRoute',
                    'levels'=>'profile',
                    'enabled'=>true,
                ),*/
                // uncomment the following to show log messages on web pages

            /*    array(
                    'class'=>'CWebLogRoute',
                ),*/

            ),
        ),
    ),
);