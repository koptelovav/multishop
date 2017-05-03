<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 13.11.13
 * Time: 23:20
 * To change this template use File | Settings | File Templates.
 */

class PostShipping extends BaseShipping{

    public function calculate()
    {
        $shippingPrice = 350;

        foreach($this->getPackages() as $package)
            $shippingPrice = $shippingPrice + $package*20;

        return $shippingPrice;
    }

    public function getMaxWeight()
    {
        return 16;
    }
}