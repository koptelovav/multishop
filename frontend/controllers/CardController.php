<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 16.04.14
 * Time: 11:57
 * To change this template use File | Settings | File Templates.
 */

class CardController extends FrontEndController{

    public function actionLogin(){
        if(!Yii::app()->user->isGuest)
            $this->redirect('index');

        $model = new LoginForm('card');
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->cardLogin())
                $this->redirect(array('index'));
        }
        $this->render('login', array('model' => $model));

    }

    public function actionActivation(){
        if(!Yii::app()->user->isGuest)
            $this->redirect('index');

        $model = new CardUser;

        if (isset($_POST['CardUser'])) {
            $model->attributes = $_POST['CardUser'];
            /* @var $card Card */
            $card = Card::model()->findByAttributes(array('number'=>$model->card_id));
            if($card || !$card->date_activation){
                $model->card_id = $card->id;
                if($model->save()){
                    $card->credits += Yii::app()->globalSettings->activation_card_credits;
                    $card->date_activation = new CDbExpression('NOW()');
                    $card->save();
                    Yii::app()->user->setFlash('success', 'Ваша карта активирована! Вам начисленно '.Yii::app()->globalSettings->activation_card_credits.' баллов в подарок! <br/> Свой бонусный баланс и купленные товары Вы можете посмотреть в '.CHtml::link('личном кабинете',array('card/login')));
                    $this->refresh();
                }
            }
            else{
                Yii::app()->user->setFlash('fail', 'Неаерный номер, либо повторная активация карты. <br/> Если номер карты был введен верно, пожалуйста свяжитеcь с нами удобным для Вас способом.');
            }
        }

        $this->render('activation', array('model' => $model));
    }

    public function actionIndex(){
        /* @var $card Card */
        $card = Card::model()->findByPk(Yii::app()->user->id);
        $user = $card->user;
        $user->password = null;
        $products = $card->cardProducts;
        $this->render('index', array(
            'card'=> $card,
            'user'=> $user,
            'products'=> $products
        ));
    }

    public function actionUserUpdate()
    {
        if(!Yii::app()->user->isGuest){
            $es = new EditableSaver('CardUser');  //'User' is name of model to be updated
            $es->update();
        }
    }
}