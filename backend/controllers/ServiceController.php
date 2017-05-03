<?php
class ServiceController extends BackEndController{

    public function actionSms()
    {

        $balance = Yii::app()->sms->balance();
        $limit = Yii::app()->sms->limit();

        $this->render('sms',array(
            'balance' => $balance['code'] == SmsApi::CODE_SUCCESS ? $balance['balance'] : 'error code: '.$balance['code'],
            'limit' => $limit['code'] == SmsApi::CODE_SUCCESS ? $limit['current'].' / '.$limit['total'] : 'error code: '.$limit['code']
        ));
    }

    public function actionTracking()
    {
        $tracking = Yii::app()->posylka->trackList();
        if($tracking['response']['code'] == 200){
            $tracks = array();
            foreach ($tracking['tracks'] as $number=>$track) {
                $track['number'] = $number;
                $tracks[] = $track;
            }
            $dataProvider = new CArrayDataProvider($tracks);
        }else{
            throw CException('Неполадки с API. Код ошибки '.$tracking->response->code);
        }
        $this->render('tracking',array(
            'dataProvider' => $dataProvider
        ));
    }
}