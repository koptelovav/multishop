<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 19.01.14
 * Time: 12:36
 */

class EmailNotifier extends BaseNotifier{
    public function order($event){
        $order = $event->sender;

        Yii::app()->mail->viewPath = 'frontend.views.mail';
        $message = new YiiMailMessage;
        $message->view = 'new-order2';
        $message->setBody(array('order' => $order ), 'text/html');
        $message->subject = 'Заказ №'.$order->id.' в интернет-магазине '.Yii::app()->shop->get('name');
        $message->addTo($order->customer->email);
        $message->from = Yii::app()->shop->get('email');
        Yii::app()->mail->send($message);
    }

    public function sendOrderTrack($event){
        $order = $event->sender;

        Yii::app()->mail->viewPath = 'backend.views.mail';
        $message = new YiiMailMessage;
        $message->view = 'track';
        $message->setBody(array('order' => $order ), 'text/html');
        $message->subject = 'Заказ №'.$order->id.' в интернет-магазине '.$order->shop->name;
        $message->addTo($order->customer->email);
        $message->from = $order->shop->email;
        Yii::app()->mail->send($message);
    }

    public static function managerNotification($order, $text){
        $message = new YiiMailMessage;
        $message->setBody($text, 'text/html');
        $message->subject = 'Заказ №'.$order->id.' в интернет-магазине '.$order->shop->name;
        $message->addTo($order->customer->email);
        $message->from = $order->shop->email;
        Yii::app()->mail->send($message);
    }
}