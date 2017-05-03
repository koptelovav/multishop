<?php
return CMap::mergeArray(

    require_once(dirname(__FILE__) . '/../../common/config/main.php'),

    [
        'id' => 'frontend',
        'viewPath' => Yii::getPathOfAlias('frontend.views'),
        'controllerPath' => Yii::getPathOfAlias('frontend.controllers'),
        'runtimePath' => Yii::getPathOfAlias('frontend.runtime'),
        'onBeginRequest' => ['SiteRouter', 'routeRequest'],
        'import' => [
            'frontend.models.*',
            'frontend.components.*',
            'frontend.helpers.*',
        ],

        'components' => [
            'urlManager' => [
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => [
                    [
                        'class' => 'frontend.components.ShopUrlRule',
                    ],
                    'p' => 'billing/payment',
                    'sale' => 'products/sale',
                    'p/<id>' => 'billing/payment',
                    'page/<view:\w+>' => 'site/page',
                    'contact' => 'site/contact',
                    'sitemap'=>['site/sitemap', 'urlSuffix'=>'.xml', 'caseSensitive'=>false],
                    'robots'=>['site/robots', 'urlSuffix'=>'.txt', 'caseSensitive'=>false],
                    '<controller:\w+>' => '<controller>/index',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ],
            ],

            'YandexDirectChecker' =>[
                'class' => 'frontend.components.YandexDirectChecker'
            ],

            'clientScript' => [
                'class' => 'frontend.extensions.EClientScript.EClientScript',
                'combineScriptFiles' => false, // By default this is set to true, set this to true if you'd like to combine the script files
                'combineCssFiles' => false, // By default this is set to true, set this to true if you'd like to combine the css files
                'optimizeScriptFiles' => false, // @since: 1.1
                'optimizeCssFiles' => false, // @since: 1.1
                'optimizeInlineScript' => false, // @since: 1.6, This may case response slower
                'optimizeInlineCss' => false, // @since: 1.6, This may case response slower
                'scriptMap'=>[
                    'jquery.min.js' =>'/js/jquery.min.js'
          ]
            ],

            'cache'=>[
                'class' => 'system.caching.CFileCache',
            ]
        ],
    ]
);