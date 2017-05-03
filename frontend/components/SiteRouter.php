<?php
class SiteRouter {
    public static function routeRequest($event)
    {
        $sender = &$event->sender;
        $sender->defaultController = Yii::app()->shop->default_controller;
        $sender->theme = Yii::app()->shop->template;
        return;
    }

}