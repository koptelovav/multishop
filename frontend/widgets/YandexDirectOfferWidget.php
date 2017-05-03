<?php
class YandexDirectOfferWidget extends CWidget{

    public $data;

    public function run(){
        if($offerViewName = Yii::app()->YandexDirectChecker->getOfferByPriority()){
            $this->render($offerViewName, [
                'data'=>$this->data
            ]);
        }
    }
}