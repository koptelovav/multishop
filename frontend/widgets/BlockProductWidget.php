<?php
class BlockProductWidget extends CWidget{
    public $limit = 8;
    public $identifier;
    public $orientation = 'horizontal';

    public function run(){
        $block = Block::model()->findByAttributes(array(
            'identifier' => $this->identifier
        ));
        if($block){
            $dataProvider = new CArrayDataProvider('Products');
            $dataProvider->setData($block->products);

            $this->render('view',array(
                'dataProvider' => $dataProvider,
                'block' => $block,
                'identifier' => strtolower($this->identifier)
            ));
        }

    }
}