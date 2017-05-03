<?php
class CardController extends BackEndController{
    public $buttonIndexTemplate = '{add}';
    public $pageTitle = 'Накопительные карты';
    public $controllerModelName = 'Card';

    protected function form($model){
        /* @var $model Card*/
        if(isset($_POST[$this->controllerModelName]))
        {
            $model->attributes=$_POST[$this->controllerModelName];
            $model->date_issue = new CDbExpression('NOW()');

            if($model->save())
                $this->redirect(array('view', 'id'=>$model->id));
        }

        $this->render('form',array(
            'model'=>$model,
        ));
    }

    public function actionIndex(){
        $this->buttonCurrentTemplate = $this->buttonIndexTemplate;

        $model=new $this->controllerModelName;
        $model->setScenario('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$this->controllerModelName]))
            $model->attributes=$_GET[$this->controllerModelName];

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    public function actionView(){
        $id = Yii::app()->request->getParam('id');
        $card = Card::model()->findByPk($id);

        if($card === NULL)
            throw new CHttpException(404,'Карта не найдена');

        $products = $card->cardProducts;

        $this->render('view',array(
            'card' => $card,
            'products' => $products
        ));
    }

    public function actionDeleteProduct($cid, $pid)
    {
        /* @var $product Products */
        /* @var $card Card */

        Yii::app()->db->createCommand()->delete('card_product','card_id=:card_id AND product_id=:product_id',array(
            ':card_id' => $cid,
            ':product_id' => $pid
        ));

        $product = Products::model()->findByPk($pid);
        $card = Card::model()->model()->findByPk($cid);
        $card->credits -= $product->credits;
        $card->save();
    }

    public function actionAddProduct($cid, $pid, $count, $discount)
    {
        if(!$count) $count = 1;
        if(!$discount) $discount = 0;
        /* @var $product Products */
        /* @var $card Card */
        $product = Products::model()->findByPk($pid);

        $cardProduct = new CardProduct();
        $cardProduct->card_id = $cid;
        $cardProduct->product_id = $product->id;
        $cardProduct->product_count = $count;
        $cardProduct->product_price = $product->currentPrice;
        $cardProduct->discount = $discount;
        $cardProduct->save();
    }

    public function actionUserUpdate()
    {
        if(!Yii::app()->user->isGuest){
            $es = new EditableSaver('CardUser');  //'User' is name of model to be updated
            $es->update();
        }
    }
}