<?php

class OrderExpensesController extends BackEndController
{
    public $controllerModelName = 'OrderExpenses';

	public function actionView($id)
	{
		$this->renderPatial('_view',array(
			'data'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new OrderExpenses;
		if(isset($_POST['OrderExpenses']))
		{
			$model->attributes=$_POST['OrderExpenses'];
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
