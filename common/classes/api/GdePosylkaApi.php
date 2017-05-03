<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 14.11.13
 * Time: 22:57
 * To change this template use File | Settings | File Templates.
 */

class GdePosylkaApi extends CApplicationComponent
{
    public static $statusCode = array(
        'NORMAL' => 'Сервис отслеживает трек',
        'STOPPED' => 'Отслеживание трека остановлено',
        'ERROR' => 'Произошла ошибка при отслеживании трека',
        'COMPLETE' => 'Адресат получил посылку'
    );

    public $apikey;
    public $format = 'json';
    protected $requestUrl = 'http://ws.gdeposylka.ru/x1/';

    protected function request($method, $params = array())
    {
        $params['apikey'] = $this->apikey;

        $url = $this->requestUrl;
        $url .= $method . '/' . $this->format . '/?';
        $url .= http_build_query($params);

        return file_get_contents($url);
    }

    protected function response($response){
        return json_decode($response, true);
    }

    public function trackAdd($track, $description = false)
    {
        return $this->response(
            $this->request('track.add', array(
                'id' => $track,
                'descr' => $description
            ))
        );
    }

    public function trackList(){
        return $this->response(
            $this->request('tracks.list')
        );
    }

    public function trackStatus($track){
        return $this->response(
            $this->request('track.status', array(
                'id'=>$track
            ))
        );
    }
}