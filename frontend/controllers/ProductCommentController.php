<?php

class ProductCommentController extends FrontEndController
{
	public function actionCreate()
	{
		$model = new ProductComment;

		if(isset($_POST['ProductComment'])){
			$model->attributes = $_POST['ProductComment'];
			if($model->save()){
				Yii::app()->request->cookies['comment'.$model->id] = new CHttpCookie('comment'.$model->id, 1);
				echo 1;
			}
		}
	}
}
