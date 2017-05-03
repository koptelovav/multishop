<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 20.02.14
 * Time: 12:33
 * To change this template use File | Settings | File Templates.
 */

class CallbackWidget extends CWidget{
    public $options = array(
        'disabledTitle' => 'Быстрый заказ',
        'activeTitle' => 'Быстрый заказ',
    );

    public function run(){
        $this->render('callbackWidget', array(
            'options'=>$this->options
        ));
    }
}