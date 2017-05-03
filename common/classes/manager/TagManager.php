<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 20.11.2014
 * Time: 11:32
 */

class TagManager {
    public function newOrder($event){
        $order = $event->sender;
        if($order->send_no_call == CartForm::SEND_BEFORE_CALL)
            OrderTag::switchTag(OrderTag::NEED_CALL, $order->id);
    }
} 