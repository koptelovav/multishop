<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 13.11.13
 * Time: 23:20
 * To change this template use File | Settings | File Templates.
 */

class EmsShipping extends BaseShipping
{

    public function calculate()
    {
        $shippingPrice = 0;

        foreach ($this->getPackages() as $package) {
            $result = $this->apiRequest(array(
                'method' => 'ems.calculate',
                'from' => 'city--sankt-peterburg',
                'to' => Yii::app()->request->getPost('to'),
                'weight' => $package
            ));

            if ($result->rsp->stat == 'ok') {
                $shippingPrice += $result->rsp->price;
            } else {
                throw new CException('EMS delivery. Calculate error');
            }
        }
        return $shippingPrice;
    }

    protected function apiRequest($params)
    {
        $requestUrl = 'http://emspost.ru/api/rest/?';
        $requestUrl .= http_build_query($params);
        return json_decode(file_get_contents($requestUrl));
    }

    public function getMaxWeight()
    {
        if (!$this->_maxWeight) {
            $result = $this->apiRequest(array(
                'method' => 'ems.get.max.weight',
            ));

            if ($result->rsp->stat == 'ok') {
                $this->_maxWeight = $result->rsp->max_weight;
            } else {
                throw new CException('EMS delivery. Calculate error');
            }
        }

        return $this->_maxWeight;
    }
}