<?php

class ProductsController extends FrontEndController
{

   /* public function actionTitle(){
        $titles =array(
            'norm' => array(),
            'over' => array(),
        );
        foreach(Products::model()->findAllByAttributes(array('page_title'=>null)) as $product){
            $title = $product->short_title.' купить с доставкой по Санкт-Петербургу, Москве и всей России';

            if(strlen($title) > 153){
                $titles['over'][] = 'UPDATE `products` SET `page_title` = \''.$title.'\' WHERE `id`='.$product->id.'; ';
            }else{
                $titles['norm'][] = 'UPDATE `products` SET `page_title` = \''.$title.'\' WHERE `id`='.$product->id.';';
            }
        }

        foreach($titles as $section){
            foreach($section as $title1){
                echo $title1.'<br/>';
            }
        }
    }*/

	public function actionView()
	{

        if(Yii::app()->request->getParam('id',false))
            $model = $this->loadModel(Yii::app()->request->getParam('id',false));
        else if(Yii::app()->shop->get('default_product_id'))
            $model = $this->loadModel(Yii::app()->shop->get('default_product_id'));
        else
            $model = $this->loadModel(false, true);
        
        if($cid = Yii::app()->request->getParam('cid',false)){
            $category = Category::model()->findByPk($cid);
            if($category->custom_style)
                Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/custom/'.$category->custom_style.'.css');
        }

        //page title and meta-tags
        $this->pageTitle = $model->page_title ? $model->page_title : $model->title;

        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag($model->meta_keywords, 'keywords');
        $cs->registerMetaTag($model->meta_description, 'description');
        $cs->registerMetaTag($model->title,null,null,array('property'=>'og:title'));
        $cs->registerMetaTag(PHtml::ogUrl($model),null,null,array('property'=>'og:url'));
        $cs->registerMetaTag($model->meta_description,null,null,array('property'=>'og:description'));
        $cs->registerMetaTag(Yii::app()->image->createUrl( 'thumbnail', Yii::app()->media->webroot.$model->image),null,null,array('property'=>'og:image'));
        $cs->registerLinkTag(null, null, PHtml::url($model), null, array('rel' => 'canonical'));

		$this->render('view',array(
			'model'=>$model,
		));
	}

    public function actionSale()
    {
        $productIds = Yii::app()->db->createCommand()
            ->select('pd.product_id')
            ->from('product_discount pd')
            ->leftJoin('discount d', 'd.id = pd.discount_id')
            ->leftJoin('product_shop ps', 'ps.product_id = pd.product_id')
            ->leftJoin('products p', 'p.id = pd.product_id')
            ->where('p.category_visible = 1 AND ps.shop_id = '.Yii::app()->shop->id.' AND DATE(NOW()) BETWEEN d.date_from AND d.date_to')
            ->queryColumn();


        $productIdString = implode(',',$productIds);

       if(!$productIdString){
            $productIdString = 'NULL';
        }




        $sort = new CSort;
//            $sort->multiSort = true;
        $sort->attributes = array(
            'price'=>array(
                'asc'=>'price',
                'desc'=>'price DESC',
                'label'=>'цене',
            ),
            'title'=>array(
                'asc'=>'title',
                'desc'=>'title DESC',
                'label'=>'названию',
            ),
            'sort'=>array(
                'asc'=>'sort',
                'desc'=>'sort DESC',
                'label'=>'популярности',
            ),
            'in_stock'=>array(
                'asc'=>'in_stock',
                'desc'=>'in_stock DESC',
                'label'=>'наличию',
            )
        );
        $sort->defaultOrder = array(
            'in_stock'=>CSort::SORT_DESC,
            'sort'=>CSort::SORT_ASC,
        );

        $dataProvider = new CActiveDataProvider('Products', array(
            'criteria'=>array(
                'condition' => 'id IN ('.$productIdString.')'
            ),
            'pagination' => array(
                'pageVar'=>'page',
                'pageSize' => Yii::app()->shop->productCount->category,
            ),
            'sort' => $sort
        ));


        $this->render('sale', array(
            'dataProvider' => $dataProvider,
        ));
    }

	public function actionIndex()
	{
        Yii::app()->shop->registerDefaultMeta();

        $dataProvider=new CArrayDataProvider(Yii::app()->shop->shop->products, array(
            'pagination'=>array(
                'pageSize'=>Yii::app()->shop->productCount->category,
            )
        ));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionEmpty(){
        Yii::app()->shop->registerDefaultMeta();
        $this->render('empty');
    }


	public function loadModel($id, $rand = false)
	{
        $criteria = new CDbCriteria();
        $criteria->compare('t.id', $id);
        $criteria->compare('shop_id', Yii::app()->shop->id);
        if($rand)
            $criteria->order = 'RAND()';

        $criteria->with = array('shops'=> array(
            'select' => false,
        ));

		$model=Products::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
