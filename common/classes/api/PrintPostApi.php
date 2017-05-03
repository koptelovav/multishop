<?php

class PrintPostApi extends CApplicationComponent
{
    CONST METHOD_GET_PRICE = 'sendprice';

    protected $zip_from = 197227;
    protected $zip_to;
    protected $weight;

    public function getAddress($index)
    {
        $requestUrl = 'http://api.print-post.com/api/'.$index;
        $response = json_decode(file_get_contents($requestUrl));
        var_dump($response);
    }

}