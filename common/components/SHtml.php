<?php

class SHtml
{
    const URL_NO_CATEGORY = 0;
    const URL_CURRENT_CATEGORY = 1;
    const URL_PRODUCT_CATEGORY = 2;

    const IMAGE_VIDEO_BLOCK = 'video_block';

    static public function popupImage($title, $image, $url, $type, $htmlOptions = array())
    {

        $itemPropName = CHtml::encode($title);
        $itemPropContentUrl = Yii::app()->imageApi->createUrl($type, Yii::app()->media->webroot . $image);
        $image = CHtml::image($itemPropContentUrl, $title, array_merge(array('class'=>'img-responsive', 'itemprop'=>'contentUrl'), $htmlOptions));

        $result = <<<EOF
<span itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="name" content="$itemPropName"/>
<a class="funcybox-video" href="$url">
$image
</a>
<meta itemprop="description" content="$itemPropName. Оригинальное видео от KineticSand.ru"/>
</span>
EOF;

        return $result;
    }

    public static function imageWithMeta($type, $title, $image, $url = false, $htmlOptions = array()){

        $itemPropName = CHtml::encode($title);
        $itemPropContentUrl = strpos($image, 'http') === false ? Yii::app()->imageApi->createUrl($type, Yii::app()->media->webroot . $image) : $image;
        $img = CHtml::image($itemPropContentUrl, $title, array_merge(array('class'=>'img-responsive', 'itemprop'=>'contentUrl'), $htmlOptions));

        if($url){
            $img = '<a href="'.$url.'">'.$img.'</a>';
        }
        $result = <<<EOF
<div itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="name" content="$itemPropName"/>
$img
<meta itemprop="description" content="Реальная фотография $itemPropName"/>
</div>
EOF;

        return $result;
    }

    public static function toPrice($string, $symbol = '&#8381;' ,$empty = 'Бесплатно'){
        return $string == 0 ? (is_numeric($empty) ? $empty . '&nbsp;'.$symbol : $empty) : number_format($string). '&nbsp;'.$symbol;
    }

    public static function toCashPrice($number){
        return number_format($number, 2, '.', '');
    }

    public static function toHumanDate($string){
        $timestamp = is_numeric($string) ? $string : strtotime($string);
        $date = date('d.m.Y', $timestamp);

        if ($date == date('d.m.Y')) {
            $date = 'Сегодня в ';
        } else if ($date == date('d.m.Y', time() - (24 * 60 * 60))) {
            $date = 'Вчера в ';
        }

        return $date . ' ' . date('H:i', $timestamp);
    }
    public static function productLink($text, $product, $category = self::URL_NO_CATEGORY, $absolute = false)
    {
        return CHtml::link($text, self::productUrl($product, $category, $absolute));
    }

    public static function productUrl($product, $category = self::URL_NO_CATEGORY, $absolute = false, $withDomain = false)
    {
        $params['id'] = $product->id;

        switch ($category){
            case self::URL_CURRENT_CATEGORY:
                if($cid = Yii::app()->request->getParam('cid',false))
                    $params['cid'] = $cid;
                break;
            case self::URL_PRODUCT_CATEGORY:
                $params['cid'] = $product->category;
                break;
        }

        $url = $absolute ? Yii::app()->createAbsoluteUrl('products/view', $params) : Yii::app()->createUrl('products/view', $params);

        if($withDomain){
            $url = '//'.$product->generalShop->domain.$url;
            $url = self::crossDomainLink($url);
        }

        return $url;
    }

    public static function newsLink($id, $text, $options = array())
    {
        return CHtml::link($text, array('news/view','id'=>$id), $options);
    }

    public static function getCategoryBreadcrumbs($category, $rec = false)
    {
        if (!$category)
            return array();

        if (is_numeric($category))
            $category = Category::model()->findByPk($category);

        if ($category->pid != 0)
            $breadcrumbs = self::getCategoryBreadcrumbs($category->pid, true);

        if ($rec) {
            $breadcrumbs[$category->short_title] = array('category/view', 'cid' => $category->id);
        }else {
            $breadcrumbs[] = $category->short_title;
        }

        return $breadcrumbs;
    }

    public static function getProductBreadcrumbs($product)
    {
        $cid = Yii::app()->request->getParam('cid',false) ? Yii::app()->request->getParam('cid') : $product->category;

        $breadcrumbs = self::getCategoryBreadcrumbs($cid, true);
        $breadcrumbs[] = $product->title;

        return $breadcrumbs;
    }

    public static function titleToSlug($title)
    {
        return self::translit_url($title);
    }

    public static function translit_url($text)
    {
        preg_match_all('/./u', $text, $text);
        $text = $text[0];
        $simplePairs = array('а' => 'a', 'л' => 'l', 'у' => 'u', 'б' => 'b', 'м' => 'm', 'т' => 't', 'в' => 'v', 'н' => 'n', 'ы' => 'y', 'г' => 'g', 'о' => 'o', 'ф' => 'f', 'д' => 'd', 'п' => 'p', 'и' => 'i', 'р' => 'r', 'А' => 'A', 'Л' => 'L', 'У' => 'U', 'Б' => 'B', 'М' => 'M', 'Т' => 'T', 'В' => 'V', 'Н' => 'N', 'Ы' => 'Y', 'Г' => 'G', 'О' => 'O', 'Ф' => 'F', 'Д' => 'D', 'П' => 'P', 'И' => 'I', 'Р' => 'R',);
        $complexPairs = array('з' => 'z', 'ц' => 'c', 'к' => 'k', 'ж' => 'zh', 'ч' => 'ch', 'х' => 'kh', 'е' => 'e', 'с' => 's', 'ё' => 'jo', 'э' => 'eh', 'ш' => 'sh', 'й' => 'jj', 'щ' => 'shh', 'ю' => 'ju', 'я' => 'ja', 'З' => 'Z', 'Ц' => 'C', 'К' => 'K', 'Ж' => 'ZH', 'Ч' => 'CH', 'Х' => 'KH', 'Е' => 'E', 'С' => 'S', 'Ё' => 'JO', 'Э' => 'EH', 'Ш' => 'SH', 'Й' => 'JJ', 'Щ' => 'SHH', 'Ю' => 'JU', 'Я' => 'JA', 'Ь' => "", 'Ъ' => "", 'ъ' => "", 'ь' => "",);
        $specialSymbols = array("_" => "-", "'" => "", "`" => "", "^" => "", " " => "-", '.' => '', ',' => '', ':' => '', '"' => '', "'" => '', '<' => '', '>' => '', '«' => '', '»' => '', ' ' => '-',);
        $translitLatSymbols = array('a', 'l', 'u', 'b', 'm', 't', 'v', 'n', 'y', 'g', 'o', 'f', 'd', 'p', 'i', 'r', 'z', 'c', 'k', 'e', 's', 'A', 'L', 'U', 'B', 'M', 'T', 'V', 'N', 'Y', 'G', 'O', 'F', 'D', 'P', 'I', 'R', 'Z', 'C', 'K', 'E', 'S',);
        $simplePairsFlip = array_flip($simplePairs);
        $complexPairsFlip = array_flip($complexPairs);
        $specialSymbolsFlip = array_flip($specialSymbols);
        $charsToTranslit = array_merge(array_keys($simplePairs), array_keys($complexPairs));
        $translitTable = array();
        foreach ($simplePairs as $key => $val) $translitTable[$key] = $simplePairs[$key];
        foreach ($complexPairs as $key => $val) $translitTable[$key] = $complexPairs[$key];
        foreach ($specialSymbols as $key => $val) $translitTable[$key] = $specialSymbols[$key];
        $result = "";
        $nonTranslitArea = false;
        foreach ($text as $char) {
            if (in_array($char, array_keys($specialSymbols))) {
                $result .= $translitTable[$char];
            } elseif (in_array($char, $charsToTranslit)) {
                if ($nonTranslitArea) {
                    $result .= "";
                    $nonTranslitArea = false;
                }
                $result .= $translitTable[$char];
            } else {
                if (!$nonTranslitArea && in_array($char, $translitLatSymbols)) {
                    $result .= "";
                    $nonTranslitArea = true;
                }
                $result .= $char;
            }
        }
        return strtolower(preg_replace("/[-]{2,}/", '-', $result));
    }

    public static function video($url, $options = array()){

        $videoId = '';

        if(strpos($url, 'youtube') !== false){
            if(preg_match('/watch\?v=([A-za-z0-9\-_]*)/', $url, $matches)){
                $videoId = $matches[1];
            }
        }

        if(!$videoId)
            return '';

        $defaultOptions = array(
            'width' => '100%',
            'height' => 'auto',
            'src' => '//www.youtube.com/embed/'.$videoId,
            'frameborder' => 0,
            'allowfullscreen' => true
        );

        $options = array_merge($defaultOptions, $options);
        $html = CHtml::openTag('iframe',$options);
        $html .= CHtml::closeTag('iframe');
        return $html;
    }

    public static function num2list($num){
        $nums = array(
            '','один','два','три','четыре','пять','шесть','семь', 'восемь','девять',
            'десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        return $nums[$num];
    }
    /**
     * Возвращает сумму прописью
     * @author runcore
     * @uses morph(...)
     */
    public static function num2str($num) {
        $encoding = 'UTF-8';
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('копейка' ,'копейки' ,'копеек',	 1),
            array('рубль'   ,'рубля'   ,'рублей'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= self::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = self::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.self::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        $str = trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
            mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }

    /**
     * Склоняем словоформу
     * @ author runcore
     */
    public static function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }

    public static function monthToString($monthNumber){
        $monthArray = array('','Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');
        return $monthArray[(int)$monthNumber];
    }

    public static function russian_month($monthNumber){
        $monthArray = array('','января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
        return $monthArray[(int)$monthNumber];
    }

    public static function xml2array ( $xmlObject, $out = array () )
    {
        foreach ( (array) $xmlObject as $index => $node )
            $out[$index] = ( is_object ( $node ) ) ? self::xml2array ( $node ) : $node;

        return $out;
    }

    public static function crossDomainLink($url){
        return $url.'/?ssid='.Yii::app()->session->getSessionID();
    }

    public static function getAllOrdersCriteria(){
        $model=new Orders('search');
        $model->customerData = new Customers();
        $model->customerAddressData = new CustomerAddress();

        $model->unsetAttributes();  // clear any default values
        $model->customerData->unsetAttributes();
        $with =  array();

        if(isset($_GET['Orders']))
            $model->attributes=$_GET['Orders'];
        if(isset($_GET['Customers']))
            $model->customerData->attributes = $_GET['Customers'];
        if(isset($_GET['CustomerAddress']))
            $model->customerAddressData->attributes = $_GET['CustomerAddress'];


        $criteria = new CDbCriteria;


        if(isset($_GET['Orders'])){
            $model->attributes=$_GET['Orders'];
            $criteria->compare('t.id', $model->id);
            $criteria->compare('comment', $model->comment, true);
            $criteria->compare('shipping_id', $model->shipping_id);
            $criteria->compare('payment_id', $model->payment_id);
            $criteria->compare('status', $model->status);
            $criteria->compare('payment_status', $model->payment_status);
            $criteria->compare('track', $model->track, true);
            $criteria->compare('total_price', $model->total_price);
            $criteria->compare('DATE_FORMAT(formed_date,"%Y-%m-%d")', $model->formed_date, true);
            $criteria->compare('DATE_FORMAT(update_payment_status,"%Y-%m-%d")', $model->update_payment_status, true);
//            $criteria->compare('products.product_id', $model->product);
            $criteria->compare('customer.name', $model->customer_id, true);
            $with[] = 'customer';
        }

        if(isset($_GET['Customers'])) {
            if ($model->customerData->name)
                $criteria->compare('customer.name', $model->customerData->name, true);

            $criteria->compare('customer.email', $model->customerData->email, true);
            $criteria->compare('customer.phone', $model->customerData->phone, true);
            $criteria->compare('customerAddress.area', $model->customerAddressData->area, true);
            $criteria->compare('customerAddress.city', $model->customerAddressData->city, true);
            $criteria->compare('customerAddress.street', $model->customerAddressData->street, true);
            $criteria->compare('customerAddress.house', $model->customerAddressData->house, true);
            $criteria->compare('customerAddress.apartment', $model->customerAddressData->apartment, true);
            $with[] = 'customer';
        }

        if(isset($_GET['CustomerAddress'])){
            $model->customerAddressData->attributes = $_GET['CustomerAddress'];
            $with[] = 'customerAddress';
        }

        if(isset($_GET['Orders']['tags']) && !empty($_GET['Orders']['tags'])) {
            $criteria->group='t.id';
            $criteria->together = true;
            $criteria->addInCondition('orderTags.id', $_GET['Orders']['tags']);
            $with[] = 'orderTags';
        }
        $criteria->with = $with;


        return $criteria;
    }

    public static function phone($phone = '', $convert = true, $trim = true)
    {
       include(Yii::getPathOfAlias('common.data').'/phones.php');
        if (empty($phone)) {
            return '';
        }
        // очистка от лишнего мусора с сохранением информации о «плюсе» в начале номера
        $phone=trim($phone);
        $plus = ($phone[ 0] == '+');
        $phone = preg_replace("/[^0-9A-Za-z]/", "", $phone);
        $OriginalPhone = $phone;

        // конвертируем буквенный номер в цифровой
        if ($convert == true && !is_numeric($phone)) {
            $replace = array('2'=>array('a','b','c'),
                '3'=>array('d','e','f'),
                '4'=>array('g','h','i'),
                '5'=>array('j','k','l'),
                '6'=>array('m','n','o'),
                '7'=>array('p','q','r','s'),
                '8'=>array('t','u','v'),
                '9'=>array('w','x','y','z'));

            foreach($replace as $digit=>$letters) {
                $phone = str_ireplace($letters, $digit, $phone);
            }
        }

        // заменяем 00 в начале номера на +
        if (substr($phone,  0, 2)==«00»)
        {
            $phone = substr($phone, 2, strlen($phone)-2);
            $plus=true;
        }

        // если телефон длиннее 7 символов, начинаем поиск страны
        if (strlen($phone)>7)
            foreach ($phoneCodes as $countryCode=>$data)
            {
                $codeLen = strlen($countryCode);
                if (substr($phone,  0, $codeLen)==$countryCode)
                {
                    // как только страна обнаружена, урезаем телефон до уровня кода города
                    $phone = substr($phone, $codeLen, strlen($phone)-$codeLen);
                    $zero=false;
                    // проверяем на наличие нулей в коде города
                    if ($data['zeroHack'] && $phone[ 0]=='0')
                    {
                        $zero=true;
                        $phone = substr($phone, 1, strlen($phone)-1);
                    }

                    $cityCode=NULL;
                    // сначала сравниваем с городами-исключениями
                    if ($data['exceptions_max']!= 0)
                        for ($cityCodeLen=$data['exceptions_max']; $cityCodeLen>=$data['exceptions_min']; $cityCodeLen--)
                            if (in_array(intval(substr($phone,  0, $cityCodeLen)), $data['exceptions']))
                            {
                                $cityCode = ($zero? "0": "").substr($phone,  0, $cityCodeLen);
                                $phone = substr($phone, $cityCodeLen, strlen($phone)-$cityCodeLen);
                                break;
                            }
                    // в случае неудачи с исключениями вырезаем код города в соответствии с длиной по умолчанию
                    if (is_null($cityCode))
                    {
                        $cityCode = substr($phone,  0, $data['cityCodeLength']);
                        $phone = substr($phone, $data['cityCodeLength'], strlen($phone)-$data['cityCodeLength']);
                    }
                    // возвращаем результат
                    return ($plus? "+": "").$countryCode.'('.$cityCode.')'.Shtml::phoneBlocks($phone);
                }
            }
        // возвращаем результат без кода страны и города
        return ($plus? "+": "").Shtml::phoneBlocks($phone);
    }

    static public function phoneBlocks($number){
        $add='';
        if (strlen($number)%2)
        {
            $add = $number[ 0];
            $add .= (strlen($number)<=5? "-": "");
            $number = substr($number, 1, strlen($number)-1);
        }
        return $add.implode("-", str_split($number, 2));
    }
}