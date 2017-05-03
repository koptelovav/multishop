<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontEndController extends BaseController
{
    public function filters(){
        return array_merge(parent::filters(),array(
            /*array(
                'COutputCache -cart/index',
                'duration'=>3600,
                'varyByParam'=>array(
                    Yii::app()->shop->domain,
                    Yii::app()->request->hostInfo,
                    Yii::app()->request->url
                ),
            )*/
        ));
    }
    // лейаут
    public $layout='//layouts/main';

    // меню
    public $menu = array();

    CONST HEADER_SLIM = 'slim';

    public $firstTitle;
    public $secondTitle;
    public $thirdTitle;
    public $bannerUrl;
    public $headerClass;

    // крошки
    public $breadcrumbs = array();

    public $showHeader = true;

    public $leftBlock = 'HIT_SALES';

    public function init(){
        Yii::app()->YandexDirectChecker->run();

        parent::init();
    }
}