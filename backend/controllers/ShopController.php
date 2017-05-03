<?php

class ShopController extends BackEndController
{
    public $pageTitle = 'Магазины';
    public $controllerModelName = 'Shop';

	public function actionCreate()
	{
        $this->buttonCurrentTemplate = $this->buttonEditTemplate;

		$shop = new Shop;
        $shopImages = new ShopImages;
        $shopProductCount = new ShopProductCount;
        $shopEmailTemplate = new ShopEmailTemplate;
		$this->createAndRender($shop,$shopImages,$shopProductCount, $shopEmailTemplate);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $this->buttonCurrentTemplate = $this->buttonEditTemplate;

        $shop = Shop::model()->findByPk($id);
        $shopImages = ShopImages::model()->findByPk($id);
        $shopProductCount = ShopProductCount::model()->findByPk($id);
        $shopEmailTemplate = ShopEmailTemplate::model()->findByPk($id);
        if(is_null($shopEmailTemplate)){
            $shopEmailTemplate = new ShopEmailTemplate();
            $shopEmailTemplate->shop_id = $id;
            $shopEmailTemplate->save();
        }
        $this->createAndRender($shop,$shopImages,$shopProductCount, $shopEmailTemplate);
	}

    protected function createAndRender($shop, $shopImages, $shopProductCount, $shopEmailTemplate){
        if(isset($_POST['Shop']) && isset($_POST['ShopImages']) && isset($_POST['ShopProductCount']))
        {
            $shop->attributes=$_POST['Shop'];
            $shop->categories = isset($_POST['Shop']['categories']) ? $_POST['Shop']['categories'] : array();
            $shopImages->attributes=$_POST['ShopImages'];
            $shopEmailTemplate->attributes=$_POST['ShopEmailTemplate'];
            $shopProductCount->id = 0;
            $shopProductCount->attributes = $_POST['ShopProductCount'];

            $validate = $shop->validate();
            $validate = $validate && $shopImages->validate();
            $validate = $validate && $shopProductCount->validate();
            if($validate){
                $shop->saveWithRelated(array(
                    'categories',
                ));
                $shopImages->save();
                $shopEmailTemplate->save();
                $shopProductCount->id = $shop->id;
                $shopProductCount->save();
                $this->redirect(array('index'));
            }
        }
        $this->render('form',array(
            'shop'=>$shop,
            'shopImages'=>$shopImages,
            'shopProductCount' => $shopProductCount,
            'shopEmailTemplate' => $shopEmailTemplate
        ));
    }

    public function actionSetCurrentShop(){
        if(Yii::app()->request->isPostRequest){
            if(isset($_POST['current_shop'])){
                Yii::app()->shop->setCurrent($_POST['current_shop']);
            }
        }
    }
}
