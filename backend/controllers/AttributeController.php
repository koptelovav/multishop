<?php

class AttributeController extends BackEndController
{
    public $pageTitle = 'Аттрибуты товаров';
    public $controllerModelName = 'Attribute';

    protected function form($model){
        $attributeValue = new AttributeValue;

        if(isset($_POST[$this->controllerModelName]))
        {
            $model->attributes=$_POST[$this->controllerModelName];

            if($model->save()){
                if(isset($_POST['AttributeValue'])){
                   foreach($_POST['AttributeValue'] as $data){
                       $attributeValue = new AttributeValue;
                       $attributeValue->attributes = $data;
                       $attributeValue->attribute_id = $model->id;
                       if(isset($data['id']))
                           $attributeValue->isNewRecord = false;
                       $attributeValue->save();
                   }
                }

                $this->redirect(array('index'));
            }
        }

        $this->render('form',array(
            'model'=>$model,
            'attributeValue' => $attributeValue
        ));
    }

}
