<?php

return CMap::mergeArray(

    require_once(dirname(__FILE__).'/../../common/config/main.php'),

    array(
        'id'=> 'backend',
        'language' => 'ru',
        'viewPath' => Yii::getPathOfAlias('backend.views'),
        'controllerPath' => Yii::getPathOfAlias('backend.controllers'),
        'runtimePath' => Yii::getPathOfAlias('backend.runtime'),
        'onBeginRequest' => array('SiteRouter', 'routeRequest'),
        'import'=>array(
            'backend.models.*',
            'backend.components.*',
            'backend.extensions.tinymce.*',
        ),
        'components' => array(
            /*'themeManager'=>array(
                'basePath' => Yii::getPathOfAlias('backend.www.themes'),
            ),*/

            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => array(
                    'p' => 'billing/payment',
                    'p/<id>' => 'billing/payment',
                    '/order/<id>' => 'orders/view',
                    '/cr/<id>' => 'orders/CdekRegister',
                    '/gr/<id>' => 'orders/GlavpunktRegister',
                    '/order/delete/<id>' => 'orders/delete',
                    '/products/<id>-<title>' => 'products/view',
                    '<controller:\w+>' => '<controller>/index',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                ),
            ),

            'user'=>array(
                'loginUrl'=>array('site/login'),
            ),
            'errorHandler'=>array(
                // use 'site/error' action to display errors
                'errorAction'=>'site/error',
            ),

            'checker' => array(
                'class' => 'CheckerComponent',
            ),

            'widgetFactory'=>array(
                'class'=>'CWidgetFactory',
                'widgets' => array(
                    'CGridView'=>array(
                        'selectableRows'=>100,
                        'itemsCssClass' => 'table table-hover table-index',
                        'pagerCssClass' => 'text-center',
                        'pager'=>array(
                            'class'=>'CLinkPager',
                            'header'=>false,
                            'hiddenPageCssClass'=>'disabled',
                            'selectedPageCssClass' => 'active',
                            'cssFile' => false,
                            'nextPageLabel' => '&raquo;',
                            'prevPageLabel' => '&laquo;',
                            'htmlOptions' => array(
                                'class'=>'pagination'
                            )
                        ),
                    ),

                    'EditableField'=>array(
                        'type' => 'text',
                        'placement' => 'right',
                        //'liveTarget' => 'main',
                        'onSave' => 'js: function(e, params) {
                        window.location.reload();
                            /*  $.ajax({
                                type: "POST",
                                url: window.location.href,
                                success: function(data){
                                    $("#main").html($(data).find("#main"));
                                    $("#main").trigger("ajaxUpdate.editable");
                                }
                           })*/
                        }'
                    ),
                ),
            ),
        ),
        'modules' => array(

        )

    )
);