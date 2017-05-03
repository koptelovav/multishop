<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 29.07.13
 * Time: 11:59
 * To change this template use File | Settings | File Templates.
 */

class ShippingCalculator extends CApplicationComponent{

    public $toCity;
    public $toArea;
    public $zip;
    public $weight;

    public function calculate($shippingType,$zip,$total,$weight){
        $shippingCodes = array();
        switch($shippingType){
            case Shipping::TYPE_MSC:
                $toCity = 'МОСКВА';
                $toArea = 'МОСКВА';
                $zip = 125130;
                $shippingCodes = array(34,56);
            break;

            case Shipping::TYPE_SPB:
                $toCity = 'Санкт-Петербург';
                $toArea = 'Санкт-Петербург';
                $zip = 197000;
                $shippingCodes = array(31,32,35,33);
                break;
            case Shipping::TYPE_RUS:
            case Shipping::TYPE_MO:
                if($zip){
                    $jsonData = @file_get_contents('http://api.print-post.com/api/index/v2/?index='.$zip);
                    if($jsonData){
                        $data = json_decode($jsonData,true);
                        $toCity = $data['city'];
                        $toArea = $data['region'];
                        $shippingCodes = array(1,2,3,16,49,37,38,22,51);
                    }
                }
                break;
        }
        $key = $this->getKey($toCity,$toArea,$zip,$total,$weight);
        $shippingVariants = $this->fromCache($key);

        if(!$shippingVariants && $zip){
            $shippingVariants = Yii::app()->edost->calculate($toCity,$zip,$total,$weight);
            $shippingVariants = $shippingVariants ? $shippingVariants : Yii::app()->edost->calculate($toArea,$zip,$total,$weight);
            $shippingVariants['client_data'] = array(
                'zip' => $zip,
                'city' => $toCity,
                'area' => $toArea
            );
            $this->toCache($key,$shippingVariants);
        }

        if($shippingCodes){
            $result = array();
            foreach ($shippingCodes as $code) {
                if($shippingVariants[$code]) {
                    $result[$code] = $shippingVariants[$code];
                }
            }
            $result['client_data'] = $shippingVariants['client_data'];
            return $result;
        }

        return array();
    }

    protected function getKey($toCity,$toArea,$zip,$total,$weight){
        return SHtml::translit_url($toCity.$toArea).$zip.$total.$weight;
    }
    protected function toCache($key,$shippingVariants){
        $clientData = Yii::app()->session['shipping_calculator'];
        if(!isset($clientData['shipping_variants']))
            $clientData['shipping_variants']=array();
        $clientData['shipping_variants'][$key] = $shippingVariants;
        Yii::app()->session['shipping_calculator'] = $clientData;

    }

    protected function fromCache($key){
        $clientData = Yii::app()->session['shipping_calculator'];
        if(isset($clientData['shipping_variants']) && is_array($clientData['shipping_variants']))
            return $clientData['shipping_variants'][$key];
        return false;
    }
}