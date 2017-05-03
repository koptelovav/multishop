<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 25.11.13
 * Time: 12:40
 * To change this template use File | Settings | File Templates.
 */

class EDostApi extends CApplicationComponent {
    public $shopId;
    public $shopPassword;

    protected $xmlParser;
    protected $encoding = 'UTF-8';

    public function init(){
        $this->shopId = Yii::app()->shop->edost_shop_id;
        $this->shopPassword = Yii::app()->shop->edost_shop_password;
    }
    protected function apiRequest($params){
        $params = array_merge($params,array(
           'id' => $this->shopId,
           'p' => $this->shopPassword
        ));

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => http_build_query($params),
            ),
        ));

        $response = file_get_contents("http://www.edost.ru/edost_calc_kln.php", false, $context);

        return new SimpleXMLElement($response);
    }

    public function calculate($to, $zip, $total, $weight, $codes = array()){
        //return array ( 1 => array ( 'id' => '1', 'price' => '485', 'day' => array ( ), 'strah' => '0', 'company' => 'Почта России', 'name' => 'отправление 1-го класса', ), 2 => array ( 'id' => '2', 'price' => '201', 'day' => array ( ), 'strah' => '0', 'company' => 'Почта России', 'name' => 'наземная посылка', ), 3 => array ( 'id' => '3', 'price' => '270', 'day' => array ( ), 'strah' => '0', 'company' => 'EMS Почта России', 'name' => array ( ), ), 32 => array ( 'id' => '32', 'price' => '600', 'day' => array ( ), 'strah' => '0', 'company' => 'Курьер', 'name' => array ( ), ), );
        $result = array();

        $params = array(
            'to_city' => $to,
            'weight' => $weight,
            'strah' => $total,
            'ln' => 26,
            'wd' => 42,
            'hg' => 38
        );

        if($zip)
            $params['zip'] = $zip;

        $response = $this->apiRequest($params);

        if($response->stat == 1){
            foreach($response->tarif as $tarif){
                $tarifId = (int)$tarif->id;
                if(empty($codes) || in_array($tarifId, $codes)){
                    $result[$tarifId] =  SHtml::xml2array($tarif);
                }
            }
            return $result;
        }

        return $result;
    }


}