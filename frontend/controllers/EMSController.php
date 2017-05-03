<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 09.10.13
 * Time: 0:24
 * To change this template use File | Settings | File Templates.
 */

class EMSController extends FrontEndController{

    public function actionRest(){
        $url = 'http://emspost.ru/api/rest/?';
        $url .= http_build_query($_POST);
        echo file_get_contents($url);
    }
}