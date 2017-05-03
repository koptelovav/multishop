<?php
class GalleryController extends FrontEndController{


    public function actionIndex(){
        $gallery = Gallery::model()->findByAttributes(array('shop_id'=>Yii::app()->shop->id));
        $this->pageTitle = $gallery->title;

        $this->render('index',array(
            'gallery'=>$gallery
        ));
    }

    public function actionViewAlbum($id){
        $model = GalleryAlbum::model()->findByPk($id);
        $this->pageTitle = $model->title;

        $this->render('view',array(
            'model'=>$model
        ));
    }
} 