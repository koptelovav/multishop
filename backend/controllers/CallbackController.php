<?php

class CallbackController extends BackEndController
{
    public $pageTitle = 'Заказ звонка';
    public $controllerModelName = 'Callback';

    public function actionSetStatus(){
        if(Yii::app()->request->isAjaxRequest){
            if(isset($_POST['status'])){
                $callback = Callback::model()->findByPk($_POST['id']);
                $callback->status = $_POST['status'];
                $callback->save();
                echo 'ok';
            }
        }

        Yii::app()->end();
    }
}
