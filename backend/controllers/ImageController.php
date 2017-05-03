<?php

class ImageController extends BackEndController
{
    public $pageTitle = 'Загрузка изображений';
    public $controllerModelName = 'Image';
    public $buttonIndexTemplate = false;
    public function actions()
    {
        return array(
            'compressor' => array(
                'class' => 'TinyMceCompressorAction',
                'settings' => array(
                    'compress' => true,
                    'disk_cache' => true,
                )
            ),
            'spellchecker' => array(
                'class' => 'TinyMceSpellcheckerAction',
            ),
            'connector' => array(
                'class' => 'backend.extensions.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::app()->media->webroot . '/images/products/',
                    'URL' => Yii::app()->media->baseUrl . '/images/products/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none'
                )
            ),
        );
    }
}
