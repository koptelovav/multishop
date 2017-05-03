<?php

class ReferralController extends FrontEndController{

    /**
     * Access filters
     * @return array
     */
    public function filters(){
        return array(
            'rights'
        );
    }

    public $layout = 'signin';
    public function actionLogin()
    {
        $model = new ReferralLoginForm;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login())
                $this->redirect(array('cabinet'));
        }
        $this->render('login', array('model' => $model));
    }

    public function actionCabinet()
    {
        $referral = Referral::model()->findByPk(Yii::app()->user->id);
        $this->render('cabinet', array(
            'referral' => $referral
        ));
    }
}