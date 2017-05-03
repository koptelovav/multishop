<?php

class BaseController extends RController
{
    public function filters(){
        return array(
//            'rights'
        );
    }

    public static function plural($n, $forms)
    {
        if ($n>0)
        {
            $n = abs($n) % 100;
            $n1 = $n % 10;
            if ($n > 10 && $n < 20) return $forms[2];
            if ($n1 > 1 && $n1 < 5) return $forms[1];
            if ($n1 == 1) return $forms[0];
        }
        return $forms[2];
    }
}
