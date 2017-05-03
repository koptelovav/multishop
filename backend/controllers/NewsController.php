<?php

class NewsController extends BackEndController
{
    public $pageTitle = 'Новости';
    public $controllerModelName = 'News';

    public function form($model){
        if(isset($_POST[$this->controllerModelName]))
        {
            $model->attributes=$_POST[$this->controllerModelName];
            if($model->save()){
                $model->shops = isset($_POST['Products']['shops']) ? $_POST['Products']['shops'] : array();
                $model->saveRelated('shops');
                $model->save();
                $this->redirect(array('index'));
            }
        }

        $this->render('form',array(
            'model'=>$model,
        ));
    }
}
