<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 19.01.14
 * Time: 12:35
 */

class SmsNotifier{
    public function order($event){
        $order = $event->sender;
//        Yii::app()->sms->send('+79533609916', 'Новый заказ №'.$order->id.' на сайте '.Yii::app()->shop->get('name'), 'BambooGroup');
        Yii::app()->sms->send($order->customer->phone, 'Номер Вашего заказа - '.$order->id.'. Спасибо за выбор нашего магазина!', 'MuWu.ru');
    }

    public function sendOrderTrack($event){
        $order = $event->sender;
        Yii::app()->sms->send($order->customer->phone, <<<EOF
Заказ No.$order->id. Трэк для отслеживания посылки: $order->track
C уважением, MuWu.ru
EOF
        , 'MuWu.ru');
    }

    public function callback($event){
        $callback = $event->sender;
//        Yii::app()->sms->send('+79533609916', 'Заказ звонка: '.$callback->name.' '.$callback->phone, 'BambooGroup');
    }

    public static function managerNotification($order, $text){
        Yii::app()->sms->send($order->customer->phone, $text, 'BambooGroup');
    }

    public function sendOrderStatus($event){
        $order = $event->sender;
        Yii::app()->sms->send($order->customer->phone, <<<EOF
Заказ No.$order->id. Ваш заказ полностью оплачен, укомплектован и передан в службу доставки.
C уважением, MuWu.ru
EOF
            , 'MuWu.ru');
    }

} 