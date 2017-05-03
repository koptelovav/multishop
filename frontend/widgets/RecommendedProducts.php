<?php
class RecommendedProducts extends CWidget
{
    public $limit = 4;
    public $order = 'RAND()';
    public $displayUrl = array('products/view');

    public function run()
    {
        if(in_array(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id,$this->displayUrl)){
            $shop =  Yii::app()->shop->shop;
            $recommend = $shop->products(array(
                'limit'=>4,
                'order'=>'RAND()'
            ));

            $this->render('view',array(
                'recommend' => $recommend
            ));
        }
    }
}