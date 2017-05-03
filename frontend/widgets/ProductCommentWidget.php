<?php
class ProductCommentWidget extends CWidget{
    public $productId;
    private $_assetsUrl;

    public function run(){
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($this->getAssetsUrl() . "/rateit.css");
        $cs->registerScriptFile($this->getAssetsUrl() . "/jquery.rateit.js");

        $model = new ProductComment;
        $model->product_id = $this->productId;
        $model->shop_id = Yii::app()->shop->id;

        $dataProvider = new CActiveDataProvider('ProductComment',array(
            'criteria'=>array(
                'condition'=>'product_id = :product_id AND shop_id = :shop_id',
                'params'=>array(
                    ':product_id'=>$this->productId,
                    ':shop_id'=> Yii::app()->shop->id),
            ),
            'pagination'=> array(
                'pageSize'=> 50
            ),
            'sort' => array(
                'defaultOrder' => array(
                    'date' => SORT_DESC,
                )
            ),
        ));
        $this->render('productCommentWidget',array(
            'model'=>$model,
            'dataProvider' => $dataProvider
        ));
    }


    private function getAssetsUrl()
    {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else
        {
            $assetsPath = Yii::getPathOfAlias('frontend.widgets.assets.productCommentWidget');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
            return $this->_assetsUrl = $assetsUrl;
        }
    }
}