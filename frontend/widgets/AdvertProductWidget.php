<?php
class AdvertProductWidget extends CWidget{
    public $limit = 6;

    public function run(){
        $block = Block::model()->findByAttributes(array(
            'identifier' => 'ADVERT_PRODUCT'
        ));

        if($block){
            $dataProvider = new CArrayDataProvider(
                $block->blockProduct(array(
                    'limit'=>$this->limit,
                    'order'=>'RAND()'
                )),
                array(
                    'keyField' =>'product_id',
                ));

            $this->render('view',array(
                'dataProvider' => $dataProvider,
                'block' => $block,
            ));
        }

    }
}