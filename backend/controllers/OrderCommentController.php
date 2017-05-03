<?php

class OrderCommentController extends BackEndController
{
    public $controllerModelName = 'OrderComment';

	public function actionView($id)
	{
		$this->renderPatial('_view',array(
			'data'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new OrderComment;
		if(isset($_POST['OrderComment']))
		{
			$model->attributes=$_POST['OrderComment'];
            $model->user_id = Yii::app()->user->id;
			if($model->save())
				echo 'ok';
		}
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
        echo 'ok';
	}
}
