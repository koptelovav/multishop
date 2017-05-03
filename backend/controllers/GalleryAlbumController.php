<?php

class GalleryAlbumController extends BackEndController
{
    public $pageTitle = 'Альбомы';
    public $controllerModelName = 'GalleryAlbum';

    public function form($model)
    {
        if(isset($_POST[$this->controllerModelName]))
        {
            $model->attributes=$_POST[$this->controllerModelName];
            if($model->save()){
                if ($_POST['Images'])
                    $model->saveImages($_POST['Images']);
                $this->redirect(array('index'));
            }
        }

        $this->render('form',array(
            'model'=>$model,
        ));
    }
}
