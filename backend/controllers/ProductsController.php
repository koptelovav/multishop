<?php

class ProductsController extends BackEndController
{
    public $pageTitle = 'Товары';
    public $controllerModelName = 'Products';

    public function actions()
    {
        return array(
            'compressor' => array(
                'class' => 'TinyMceCompressorAction',
                'settings' => array(
                    'compress' => true,
                    'disk_cache' => true,
                )
            ),
            'spellchecker' => array(
                'class' => 'TinyMceSpellcheckerAction',
            ),
            'connector' => array(
                'class' => 'backend.extensions.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::app()->media->webroot . '/images/products/',
                    'URL' => Yii::app()->media->baseUrl . '/images/products/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none'
                )
            ),
            'move'=>array(
                'class'=>'backend.extensions.SSortableBehavior.SSortableAction',
            )
        );
    }

    public function actionIndex()
    {
      /*  $model= Products::model()->findByPk(851);
        echo '<pre>';
        foreach ($model->compositionsProduct as $item) {
            echo $item->id;
        }
         echo '</pre>';
            die;*/
        $this->buttonCurrentTemplate = $this->buttonIndexTemplate;

        $model=new $this->controllerModelName;
        $model->resetScope();
        $model->setScenario('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$this->controllerModelName]))
            $model->attributes=$_GET[$this->controllerModelName];

        $this->render('index',array(
            'model'=>$model,
            'dataProvider'=>$model->search()
        ));
    }

    public function actionGetComposition($id)
    {
        $model= Products::model()->findByPk($id);
        $model->resetScope();

        $this->renderPartial('index',array(
            'model'=>$model,
            'dataProvider'=> new CArrayDataProvider($model->compositionsProduct),
            'parentId' => $id
        ), false, false);
    }

    public function form($model){
        if(isset($_POST['Products'])) {
            $images = array();
            $descriptions = array();
            @$model->attributes = $_POST['Products'];
            $model->slug = $model->slug ? $model->slug : SHtml::titleToSlug($model->title);

            if ($model->save()) {
                $model->categories = isset($_POST['Products']['categories']) ? $_POST['Products']['categories'] : $model->categories;
                $model->news = isset($_POST['Products']['news']) ? $_POST['Products']['news'] : $model->news;
                $model->shops = isset($_POST['Products']['shops']) ? $_POST['Products']['shops'] : $model->shops;
                $model->related = isset($_POST['Products']['related']) ? $_POST['Products']['related'] : $model->related;
                $model->attachments = isset($_POST['Products']['attachments']) ? $_POST['Products']['attachments'] : $model->attachments;
                $model->discount = isset($_POST['Products']['discounts']) ? $_POST['Products']['discounts'] : $model->discount;
                $model->product_attributes = isset($_POST['Products']['product_attributes']) ? $_POST['Products']['product_attributes'] : $model->product_attributes;

                if (isset($_POST['ProductDescription'])) {
                    foreach ($_POST['ProductDescription'] as $shop => $data)
                        if (!empty($data['short_description']) || !empty($data['description']))
                            $descriptions[] = array(
                                'shop_id' => $shop,
                                'product_id' => $model->id,
                                'description' => $data['description'],
                                'short_description' => $data['short_description'],
                            );
                }

                $model->descriptions = $descriptions;

                $model->saveRelated(array(
                    'descriptions',
                    'categories',
                    'news',
                    'shops',
                    'related',
                    'attachments',
                    'discount',
                    'product_attributes'
                ));
            }

            if ($_POST['Images'])
                $model->saveImages($_POST['Images']);

            if ($_POST['ProductFeature']){
                foreach ($_POST['ProductFeature'] as $feature_id => $data) {
                    $feature = ProductFeature::model()->findByAttributes(array('product_id' => $model->id, 'feature_id' => $feature_id));
                    if (!$feature)
                        $feature = new ProductFeature();
                    $feature->product_id = $model->id;
                    $feature->feature_id = $feature_id;
                    $feature->value = $data['value'];
                    $feature->save();
                }
            }

            if($_POST['ProductFilters']) {
                foreach ($_POST['ProductFilters'] as $filterID => $filterValues) {
                    $productFilters = ProductFilter::model()->findAllByAttributes(array('product_id' => $model->id, 'filter_id' => $filterID));
                    if ($productFilters)
                        foreach ($productFilters as $productFilter)
                            $productFilter->delete();

                    foreach ($filterValues as $filterValue) {
                        $productFilter = new ProductFilter();
                        $productFilter->product_id = $model->id;
                        $productFilter->filter_id = $filterID;
                        $productFilter->value = $filterValue;
                        $productFilter->save();
                    }
                }
            }
        }

        $this->render('form',array(
            'model'=>$model,
            'view' => '_form',
        ));
    }

    public function actionCopy($id){
        $model = $this->loadModel($id);
        $newModel = new Products();
        $productDescriptions = array();
        foreach($model->descriptions as $description){
            $productDescriptions[$description->shop_id] = $description;
        }

        $newModel->attributes = $model->attributes;
        $newModel->image = $model->image;
        $newModel->slug = $model->slug;
        $newModel->sort = ++$model->sort;
        if($newModel->save()){
            $newModel->categories = $model->categories;
            $newModel->shops = $model->shops;
            $newModel->related = $model->related;
            $newModel->attachments = $model->attachments;
            $newModel->discount = $model->discount;
            $newModel->descriptions = $model->descriptions;
            $newModel->product_include = $model->product_include;

            $newModel->saveRelated(array(
                'descriptions',
                'categories',
                'shops',
                'related',
                'attachments',
                'discount',
                'product_include'
//                    'gifts'
            ));
            $this->redirect(array('update', 'id'=>$newModel->id));
        }
    }

    public function actionAddIncludeProduct(){

        $productId = Yii::app()->request->getParam('product_id');
        $count = Yii::app()->request->getParam('count');
        $includeId = Yii::app()->request->getParam('include_id');

        $productInclude = ProductInclude::model()->findByAttributes(array(
            'product_id' => $productId,
            'include_id' => $includeId
        ));
        if(!$productInclude){
            $productInclude = new ProductInclude;
            $productInclude->product_id = $productId;
            $productInclude->include_id = $includeId;
            $productInclude->count = $count;
        }
        $productInclude->count = $count;
        $productInclude->save();
        $this->redirect(array('update','id'=>Yii::app()->request->getParam('product_id')));
    }

    public function actionAddProductPiece()
    {
        $productId = Yii::app()->request->getParam('product_id');
        $count = Yii::app()->request->getParam('count');
        $includeId = Yii::app()->request->getParam('include_id');

        $productPiece = ProductPiece::model()->findByAttributes(array(
            'product_id' => $productId,
            'piece_id' => $includeId
        ));

        if(!$productPiece){
            $productPiece = new ProductPiece;
            $productPiece->product_id = $productId;
            $productPiece->piece_id = $includeId;
            $productPiece->piece_count = $count;
        }

        $productPiece->piece_count = $count;
        $productPiece->save();
        $this->redirect(array('update','id'=>Yii::app()->request->getParam('product_id')));
    }

    public function actionAddRelatedProduct(){

        $productId = Yii::app()->request->getParam('product_id');
        $relatedId = Yii::app()->request->getParam('related_id');

        $productInclude = RelatedProduct::model()->findByAttributes(array(
            'product_id' => $productId,
            'related_id' => $relatedId
        ));

        if(!$productInclude){
            $productInclude = new RelatedProduct();
            $productInclude->product_id = $productId;
            $productInclude->related_id = $relatedId;
            $productInclude->save();
        }

        $this->redirect(array('update','id'=>Yii::app()->request->getParam('product_id')));
    }

    public function actionAddCompositionProduct(){

        $productId = Yii::app()->request->getParam('product_id');
        $includeId = Yii::app()->request->getParam('include_id');
        $includeLabel = Yii::app()->request->getParam('include_label');


        $productComposition = new ProductComposition();
        $productComposition->product_id = $productId;
        $productComposition->include_id = $includeId;
        $productComposition->label = $includeLabel;
        $productComposition->save();

        $this->redirect(array('update','id'=>Yii::app()->request->getParam('product_id')));
    }

    public function actionSuggest(){
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = Products::model()->findAll(array(
                'condition' => 'title LIKE :keyword',
                'params' => array(
                    ':keyword' => '%' . strtr($_GET['term'], array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
                )
            ));
            $result = array();
            foreach ($models as $key=>$m) {
                $productAttributes = array();

                foreach ($m->product_attributes as $attribute) {
                    $productAttributes[$attribute->id] = array(
                        'title' => $attribute->name,
                        'type' => $attribute->type
                    );
                    foreach ($attribute->attribute_values as $item) {
                        $productAttributes[$attribute->id]['values'] = array(
                            'id' => $item->id,
                            'title' => $item->value,
                            'markUp' => $item->mark_up
                        );
                    }
                }

                $productAttributes = $this->renderPartial('_attributes', array('product'=>$m), true, false);

                $result[$key] = array(
                    'id' => $m->id,
                    'title'=>$m->title,
                    'price' => $m->currentPrice,
                    'label' => $m->short_title,
                    'value' => $m->title,
                    'attributes' => $productAttributes
                );
            }

            echo CJSON::encode($result);
        }
    }

    public function actionPiecesSuggest(){
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = Piece::model()->findAll(array(
                'condition' => 'title LIKE :keyword',
                'params' => array(
                    ':keyword' => '%' . strtr($_GET['term'], array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
                )
            ));
            $result = array();
            foreach ($models as $key=>$m) {
                $result[$key] = array(
                    'id' => $m->id,
                    'title'=>$m->title,
                    'value' => $m->title,
                );
            }

            echo CJSON::encode($result);
        }
    }


    public function actionPriceList()
    {
        $this->buttonCurrentTemplate = $this->buttonIndexTemplate;

        $model=new $this->controllerModelName;
        $model->setScenario('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$this->controllerModelName]))
            $model->attributes=$_GET[$this->controllerModelName];

        $this->render('priceList',array(
            'model'=>$model,
        ));
    }

    public function actionSetPriceListProduct(){
        if(Yii::app()->request->getPost('selected'))
            $this->addPriceListProduct(Yii::app()->request->getPost('id'));
        else
            $this->removePriceListProduct(Yii::app()->request->getPost('id'));
    }

    public function actionPrintPriceList(){

        if(!isset(Yii::app()->session['price_list']))
            $products = array();
        $products = Yii::app()->session['price_list'];

        $this->renderPartial('print/priceList', array(
            'products' => $products
        ),false, true);
    }

    public function actionSetPriceListCountProduct(){
        $products =  Yii::app()->session['price_list'];
        $products[Yii::app()->request->getPost('id')] = Yii::app()->request->getPost('count');
        Yii::app()->session['price_list'] = $products;
    }

    protected function addPriceListProduct($id){
        if(!isset(Yii::app()->session['price_list']))
            Yii::app()->session['price_list'] = array();
        $products =  Yii::app()->session['price_list'];
        $products[$id] = 1;
        Yii::app()->session['price_list'] = $products;
    }

    protected function removePriceListProduct($id){
        $products =  Yii::app()->session['price_list'];
        unset($products[$id]);
        Yii::app()->session['price_list'] = $products;

    }
}
