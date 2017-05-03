<?php
class RelatedProductWidget extends CWidget{
    public $product;
    public $limit = 4;

    public function run(){
        $dataProvider = new CArrayDataProvider($this->product->related(array('limit'=>$this->limit)));
        $this->render('view',array(
            'dataProvider' => $dataProvider
        ));
    }
}