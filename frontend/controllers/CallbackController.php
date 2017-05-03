<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 28.02.14
 * Time: 10:00
 * To change this template use File | Settings | File Templates.
 */

class CallbackController extends FrontEndController{
    public function actionCreate(){
        $callback = new Callback;


        if($_POST['Callback']){
            $callback->attributes = $_POST['Callback'];
            $callback->status = 0;
            if($callback->save()){
                $smsNotifier = new SmsNotifier();
                $callback->onNewCallback = array($smsNotifier, 'callback');
                $event = new CModelEvent($callback);
                $callback->onNewCallback($event);
                echo 'OK';
            }else{
                echo var_export($callback->errors);
            }

            Yii::app()->end();
        }

        $this->renderPartial('create', array(
            'callback' => $callback
        ),false,true);
    }
}