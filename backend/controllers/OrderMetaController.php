<?php

class OrderMetaController extends BackEndController{
    public function actionAdd(){
        if(Yii::app()->request->isPostRequest)
            OrderMeta::add($_POST['order_id'], $_POST['name'], $_POST['value']);
        else
            throw new CHttpException(403,'Access denied');
    }

    public function actionRemove(){
        if(Yii::app()->request->isPostRequest)
            OrderMeta::remove($_POST['order_id'], $_POST['name']);
        else
            throw new CHttpException(403,'Access denied');
    }
}