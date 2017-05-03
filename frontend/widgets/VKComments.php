<?php
class VKComments extends CWidget
{
    public $displayUrl = array('products/view');

    public function init(){
        if(in_array(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id,$this->displayUrl)){
            Yii::app()->clientScript->registerScriptFile('//vk.com/js/api/openapi.js?98');
            Yii::app()->clientScript->registerScript('vk-comments-init','VK.init({apiId: '.Yii::app()->shop->vk_app_id.', onlyWidgets: true});',CClientScript::POS_HEAD);
        }
    }

    public function run()
    {
        if(in_array(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id,$this->displayUrl)){
            $this->render('view');
        }
    }
}