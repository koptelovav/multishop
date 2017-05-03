<?php
class HitSalesWidget extends CWidget{
    public $limit = 6;

    public function run(){
        $productsArray = Yii::app()->db->createCommand()
            ->select('p.*,hs.sort as sort')
            ->from('products p')
            ->rightJoin('hit_sales hs', 'p.id = hs.product_id')
            ->queryAll();

        $dataProvider = new CArrayDataProvider(Products::model()->populateRecords($productsArray, true),
        array(
            'sort'=>array(
                'defaultOrder'=> 'sort ASC',
            ),
        ));

        $this->render('view',array(
            'dataProvider' => $dataProvider
        ));
    }
}