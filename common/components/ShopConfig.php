<?php

require 'Mobile_Detect.php';

class ShopConfig extends CApplicationComponent{

    const APP_FRONTEND = 'frontend';
    const APP_BACKEND = 'backend';
    const APP_MEDIA = 'media';

    private $params = array();
    public $shop;
    protected $current;

    public function init(){
        $uri = empty($_SERVER['HTTP_HOST']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
        $uri = str_replace(array('www.','admin.', 'a.', 'm.'),'',$uri);

        $this->shop = Shop::model()->find(
            'domain LIKE :match',
            array(':match' => "%$uri%")
        );

        if($this->shop->id == 7)
            $this->shop = Shop::model()->find(
                'domain LIKE :match',
                array(':match' => "%muwu.ru%")
            );

        if($this->shop){
            $this->params = array_merge($this->shop->attributes, $this->shop->images->attributes);
        }
        else{
            var_dump($uri);die;
            throw new CException('Shop not found');
        }
    }

    public function getTemplate()
    {
        $detect = new Mobile_Detect();
        $isMobile = (string)Yii::app()->request->cookies['mobile_template'];
        $mobile_link = "http://m.$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($_SERVER['SERVER_NAME'],'m.') == false && $isMobile  ) {
            header('location: ' . $mobile_link);
        }else if(strpos($_SERVER['SERVER_NAME'],'m.') !== false || $isMobile  ) {
            return $this->shop->mobile_template;
        }else if($detect->isMobile() && $this->shop->mobile_template){

            Yii::app()->request->cookies['cookie_name'] = new CHttpCookie('mobile_template', 1);
            header('location: '.$mobile_link);
            return $this->shop->mobile_template;
        }

        return $this->shop->template;
    }

    public function get($name){
        if($name == 'icon'){
            return Yii::app()->media->baseUrl.$this->params[$name];
        }
        if(!is_null($this->params))
            if(isset($this->params[$name]))
                return $this->params[$name];
        return false;
    }

    public function __get($name){
        $getter='get'.$name;
        if(method_exists($this,$getter))
            return $this->$getter();
        return $this->shop->{$name};
    }

    public function registerDefaultMeta(){
        Yii::app()->controller->pageTitle = Yii::app()->shop->get('title');
        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag(Yii::app()->shop->get('meta_keywords'), 'keywords');
        $cs->registerMetaTag(Yii::app()->shop->get('meta_description'), 'description');
        $cs->registerMetaTag(Yii::app()->shop->title,null,null,array('property'=>'og:title'));
        $cs->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url),null,null,array('property'=>'og:url'));
        $cs->registerMetaTag(Yii::app()->shop->get('meta_description'),null,null,array('property'=>'og:description'));
        $cs->registerMetaTag(Yii::app()->image->createUrl( 'thumbnail', Yii::app()->media->webroot.Yii::app()->shop->get('logo')),null,null,array('property'=>'og:image'));
    }

    public function setCurrent($shopId){
        Yii::app()->session['current_shop'] = $shopId;
    }

    public function getCurrent(){
        if(!$this->current || isset(Yii::app()->session['current_shop']))
            $this->current =  Shop::model()->findByPk(Yii::app()->session['current_shop']);

        return  $this->current;
    }

    public function registerTemplateCss(){
        $fileName = $this->getCurrent()->template.'.css';
        $templateCssFile = Yii::getPathOfAlias('webroot.css.template') . DIRECTORY_SEPARATOR .$fileName;
        if(is_file($templateCssFile)){
            Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/template/'.$fileName);
        }
    }
}