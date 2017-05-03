<?php

/**
 * Class of cart
 * Class CartController
 */
class CartController extends FrontEndController
{
    public function filters(){
        return array();
    }
    /**
     * Cart. View added products
     */
    public function actionIndex()
	{
//        var_dump(Yii::app()->cart->getClientData()['shipping']);die;
        $this->pageTitle = 'Корзина';

        $cartForm = new CartForm();
        $cartForm->attributes = Yii::app()->cart->getClientData();

        if(isset($_POST['CartForm'])){
            $cartForm->cartProducts = $_POST['CartForm']['cartProducts'];
            foreach($cartForm->products as $productHash=>$item){
                $cartForm->products[$productHash]['count'] = $cartForm->cartProducts[$productHash];

                if($cartForm->cartProducts[$productHash] <= 0){
                    unset($cartForm->products[$productHash]);
                    unset($cartForm->cartProducts[$productHash]);
                }
            }

            $cartForm->gifts = array();
            $shippingDiscount = 0;
            foreach($cartForm->products as $productHash=>$item){
                $result = Yii::app()->db->createCommand()
                    ->select('pg.gift_id')
                    ->from('products p')
                    ->leftJoin('product_gift pg','pg.product_id = p.id')
                    ->where('p.id = '.$item['id'].' AND pg.shop_id = '.Yii::app()->shop->id)
                    ->queryColumn();


                foreach ($result as $giftId) {
                    if($giftId){
                        if(isset($cartForm->gifts[$giftId])){
                            $cartForm->gifts[$giftId] += $item['count'];
                        }else{
                            $cartForm->gifts[$giftId] = $item['count'];
                        }
                    }
                }

                $shippingDiscount = $shippingDiscount < $item['shipping_discount'] ? $item['shipping_discount'] : $shippingDiscount;
            }

            if($_POST['CartForm']['promoCode']){
                if($discount = $cartForm->checkPromoCode($_POST['CartForm']['promoCode'])){
                    $cartForm->discount = $discount;
                }else{

                }
            }

            $weight = $cartForm->getWeight() / 1000;
            $cartForm->totalProduct = $cartForm->getTotalProducts();
            $total = $cartForm->totalProduct;
            
           /* if($total > 4999)
                $shippingDiscount = $shippingDiscount < 300 ? 300 : $shippingDiscount;*/

            $shippingCodes = array();

            $oldCartForm = clone $cartForm;
            $cartForm->attributes = $_POST['CartForm'];

            if($oldCartForm->shippingType != $cartForm->shippingType || $oldCartForm->zip != $cartForm->zip)
                $cartForm->reset();
            if($oldCartForm->shippingType != $cartForm->shippingType) {
                $cartForm->zip = '';
            }
            if($oldCartForm->shipping != $cartForm->shipping){
//                $cartForm->pvz = '';
                $cartForm->pvzList = array();
            }

            if($cartForm->shippingType)
                $cartForm->shippingVariants =  Yii::app()->shippingCalculator->calculate($cartForm->shippingType,$cartForm->zip,$total,$weight,$shippingCodes);

            if(empty($cartForm->shippingVariant))

                foreach($cartForm->shippingVariants as $key=>$variant) {
                    $cartForm->shippingVariants[$key]['price'] = (int)$cartForm->shippingVariants[$key]['price'] - $shippingDiscount;

                    if($weight >= 5 && ($cartForm->shipping == Shipping::COURIER_SHIPPING || $cartForm->shipping == Shipping::COURIER_LO_SHIPPING))
                        $cartForm->shippingVariants[$key]['price'] += 100;

                    $cartForm->shippingVariants[$key]['price'] = $cartForm->shippingVariants[$key]['price'] < 0 ? 0 : $cartForm->shippingVariants[$key]['price'];
                }
            if(!empty($cartForm->shippingVariants) && $cartForm->shipping){
                $cartForm->city = $cartForm->shippingVariants['client_data']['city'];
                $cartForm->area = $cartForm->shippingVariants['client_data']['area'];
                $cartForm->zip = $cartForm->shippingVariants['client_data']['zip'];
                $shipping = Shipping::model()->findByPk($cartForm->shipping);
                $shipping->price = isset($cartForm->shippingVariants[$shipping->edost_code]) ? $cartForm->shippingVariants[$shipping->edost_code]['price']: 0;
                $cartForm->currentShipping = array(
                    'id'=> $shipping->id,
                    'name' => $shipping->customer_name,
                    'price' => $shipping->price
                );

                if($cartForm->shipping == Shipping::CDEK_STORE_SHIPPING ||/* $cartForm->shipping == Shipping::CDEK_SPB || */ $cartForm->shipping == Shipping::MSC_STORE_SHIPPING){
                    $cartForm->pvzList = Yii::app()->CDEKApi->getPVZList($cartForm->zip);
                    if(count($cartForm->pvzList) == 1) {
                        $cartForm->pvz = current($cartForm->pvzList);
                        $cartForm->pvz = $cartForm->pvz['code'];
                    }
                }
                if($cartForm->shippingType == Shipping::TYPE_SPB || $cartForm->shippingType == Shipping::TYPE_MSC){
                    $cartForm->pvzList = array_merge(Yii::app()->glavpunkt->punkts(), Yii::app()->glavpunkt->punkts(false));
                }
            }
            $cartForm->total = $cartForm->getTotal();
            Yii::app()->cart->setClientData($cartForm->attributes);
        }
        $criteria=new CDbCriteria;
        $criteria->addInCondition('id', $cartForm->getAllProductId());

        $dataProvider=new CActiveDataProvider('Products',array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>200,
            )
        ));

        $criteria=new CDbCriteria;
        $criteria->addInCondition('id', array_keys($cartForm->gifts));

        $giftDataProvider=new CActiveDataProvider('Products',array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>200,
            )
        ));

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'giftDataProvider'=>$giftDataProvider,
            'total' => Yii::app()->cart->total(),
            'cartForm' => $cartForm,
            'shippingDiscount' => $shippingDiscount
        ));
    }

    public function actionValidate()
    {
        $cartForm = new CartForm();
        if(isset($_POST['CartForm'])){
            $cartForm->attributes = $_POST['CartForm'];
            if(!$cartForm->shipping)
                $cartForm->shipping = $cartForm->shippingType;
            if($cartForm->validate()){
                $cartForm->attributes = array_merge($cartForm->attributes,Yii::app()->cart->getClientData());
                $cartForm->canOrder = true;
                Yii::app()->cart->setClientData($cartForm->attributes);

                echo CJSON::encode(array(
                    'success' => 'ok'
                ));
            }else{
                echo CJSON::encode(array(
                    'errors' =>$cartForm->getErrors()
                ));
            }
        }

    }

    /**
     * Add product to cart
     * @param $id int Product ID
     */
    public function actionAdd(){
        $id = Yii::app()->request->getPost('id');
        $attributes = Yii::app()->request->getPost('attributes', array());
        $product = $this->loadModel($id);
        if($product->active && $product->in_stock)
            Yii::app()->cart->add($product, $attributes);
    }

    /**
     * Sub product from cart
     * @param $id int Product ID
     */
    public function actionSub($id){
        $product = $this->loadModel($id);
        Yii::app()->cart->sub($product);
    }

    /**
     * Delete product from cart
     * @param $id int Product ID
     */
    public function actionDelete($id){
        Yii::app()->cart->delete($id);
    }

    public function actionGetProductCount(){
        $cartForm = new CartForm();
        $cartForm->attributes = Yii::app()->cart->getClientData();
        echo $cartForm->getProductsCount();
    }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Products the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Products::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
