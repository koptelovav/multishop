<?php
class SiteRouter {
    public static function routeRequest($event)
    {
        $sender = &$event->sender;

        if(Yii::app()->user && Yii::app()->user->id)
            $sender->defaultController = Yii::app()->user->model->default_controller;
//        $sender->theme = strpos($_SERVER['HTTP_HOST'], 'm.admin.') !== false ? 'moby' : null;
        return;
    }

}