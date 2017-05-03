<?php

class PieceController extends FrontEndController
{
	public function actionView($id)
	{
		$model = Piece::model()->findByPk($id);

		/*if(strcmp(Yii::app()->request->url,Yii::app()->createUrl('news/view', array('id'=>$model->id))) != 0)
			$this->redirect(Yii::app()->createUrl('news/view', array('id'=>$model->id)));

		$this->pageTitle = $model->title;
		$cs = Yii::app()->clientScript;
		$cs->registerMetaTag($model->short_text, 'description');
		$cs->registerMetaTag($model->title,null,null,array('property'=>'og:title'));
		$cs->registerMetaTag(Yii::app()->createAbsoluteUrl('news/view', array('id'=>$model->id)),null,null,array('property'=>'og:url'));
		$cs->registerMetaTag($model->short_text,null,null,array('property'=>'og:description'));
		$cs->registerMetaTag(Yii::app()->image->createUrl( 'thumbnail', Yii::app()->media->webroot.$model->image),null,null,array('property'=>'og:image'));
		$cs->registerLinkTag(null, null, Yii::app()->createAbsoluteUrl('news/view', array('id'=>$model->id)), null, array('rel' => 'canonical'));*/

		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionIndex()
	{
        $this->pageTitle = 'Элементы конструктора Магформерс';
		$pieces = Piece::model()->findAll();

		$this->render('index',array(
			'pieces'=>$pieces,
		));
	}
}
