<?php
class CategoryFilterWidget extends CWidget{


    public function run()
    {
        $filer = array();

        $productIds = Category::getAllProductsIds(Yii::app()->request->getParam('cid'));
        Category::getFilter($productIds);

    }

    
}