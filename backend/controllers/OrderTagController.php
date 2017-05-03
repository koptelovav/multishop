<?php

class OrderTagController extends BackEndController
{
    public $pageTitle = 'Тэги заказов';
    public $controllerModelName = 'OrderTag';

    public function actionSwitchTag($tag_id, $order_id){
        echo OrderTag::switchTag($tag_id, $order_id);
    }
}
