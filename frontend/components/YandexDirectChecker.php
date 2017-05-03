<?php
class YandexDirectChecker extends CApplicationComponent{

    public function run(){
        if($this->isNewAdvertisingVisit()){
            $this->setAdvertisingData();
        }
        $this->getOfferByPriority();
    }

    public function getOfferByPriority()
    {
        $advertisingData = $this->getAdvertisingData();

        if(is_array($advertisingData)){
            $utm_campaign = [];
            $utm_content = [];
            foreach ($advertisingData as $key=>$item){
                $utm_campaign[] = $key;
                $utm_content[] = $item;
            }

            $utm_campaign = implode(',',$utm_campaign);
            $utm_content = implode(',',$utm_content);


            $name = Yii::app()->db->createCommand()
                ->select('offer_name')
                ->from('yandex_direct_offer')
                ->where('utm_campaign IN ('.$utm_campaign.') AND (utm_content IN ('.$utm_content.') OR utm_content IS NULL)')
                ->order('priority DESC')
                ->limit(1)
                ->queryScalar();
            return $name;
        }
        return false;
    }

    public function showAdvert()
    {
        return (boolean)Yii::app()->request->cookies['yandex_advertising'] || Yii::app()->request->getParam('utm_campaign', false);
    }

    private function isNewAdvertisingVisit()
    {
        return Yii::app()->request->getParam('utm_campaign', false);
    }

    private function setAdvertisingData(){
        $advertisingData = [Yii::app()->request->getParam('utm_campaign') => Yii::app()->request->getParam('utm_content')];

        $oldData = $this->getAdvertisingData();


        if(is_array($oldData))
            $advertisingData = $oldData +  $advertisingData;

        Yii::app()->request->cookies['yandex_advertising'] = new CHttpCookie('yandex_advertising', serialize($advertisingData));
    }

    private function getAdvertisingData(){
        $advertisingData = Yii::app()->request->cookies['yandex_advertising'];
        if($advertisingData)
            $advertisingData = unserialize($advertisingData);

        return $advertisingData;
    }
}