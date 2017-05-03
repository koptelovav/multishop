<?php
/**
 * User: alexey.koptelov
 * Date: 25.11.13
 * Time: 12:40
 */

class VkApi extends CApplicationComponent {
    public $api_secret;
    public $app_id;
    public $api_url;

    public function api($method,$params=false) {
        if (!$params) $params = array();
        $params['api_id'] = $this->app_id;
        $params['v'] = '5.29';
        $params['timestamp'] = time();
        $params['format'] = 'json';
        $params['random'] = rand(0,10000);
        ksort($params);
        $sig = '';
        foreach($params as $k=>$v) {
            $sig .= $k.'='.$v;
        }
        $sig .= $this->api_secret;
        $params['sig'] = md5($sig);
        $query = $this->api_url.$method.'?'.$this->params($params);
        $res = file_get_contents($query);
        return json_decode($res, true);
    }

    public function params($params) {
        $pice = array();
        foreach($params as $k=>$v) {
            $pice[] = $k.'='.urlencode($v);
        }
        return implode('&',$pice);
    }


}