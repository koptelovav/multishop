<?php

class PHtml{
    const URL_NO_CATEGORY = 0;
    const URL_CURRENT_CATEGORY = 1;
    const URL_PRODUCT_CATEGORY = 2;

    const IMAGE_THUMBNAIL = 'thumb';
    const IMAGE_VIEW = 'product';
    const IMAGE_CATEGORY = 'category';
    const IMAGE_ADDITIONAL = 'additional';
    const IMAGE_POPUP = 'popup';
    const IMAGE_CATEGORY_ICON = 'category_icon';
    const IMAGE_BANNER = 'banner';
    const IMAGE_GALLERY = 'gallery';
    const IMAGE_PIECE = 'piece';


    public static function image($product, $type, $htmlOptions = array()){

        $itemPropName = CHtml::encode($product->title);
        $itemPropContentUrl = Yii::app()->imageApi->createUrl($type, Yii::app()->media->webroot . $product->image);
        $image = CHtml::image($itemPropContentUrl, $product->title, array_merge(array('class'=>'img-responsive', 'itemprop'=>'contentUrl'), $htmlOptions));
        $url = self::url($product);

        $result = <<<EOF
<div itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="name" content="$itemPropName"/>
<a href="$url">
$image
</a>
<meta itemprop="description" content="Реальная фотография $itemPropName"/>
</div>
EOF;

        return $result;
    }

    public static function readMore($product, $label = 'Подробнее'){
        return CHtml::link($label, self::url($product, Yii::app()->shop->category_url_type), array('class'=>'more buy btn'));
    }

    public static function url($product, $absolute = false, $withDomain = false)
    {
        $params['id'] = $product->id;

        switch (Yii::app()->shop->category_url_type){
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

    public static function ogUrl($product)
    {
        $params['id'] = $product->id;
        $url = Yii::app()->createAbsoluteUrl('products/view', array('id'=>$product->id)) ;

        return $url;
    }

    public static function price($product, $showOldPrice = true){
        $productCurrentPrice = $product->getCurrentPrice();
        if($productCurrentPrice == 0)
            return false;
        $productPrice = $product->getPrice();
        $price = '';
        $prefix = '';
        $symbol = '&#8381;';
        $empty = 'Бесплатно';
        $productHumanPrice = number_format($productPrice);
        $productHumanCurrentPrice = number_format($product->getCurrentPrice());

        if($product->price_prefix){
            $prefix = 'от ';
        }

        if($showOldPrice && $product->isDiscount() && $productPrice != $productCurrentPrice)
            $price .= CHtml::openTag('del') . $productHumanPrice.' '.$symbol . CHtml::closeTag('del').' ';

        $price .= '<span class="update-price" data-id = "'.$product->id.'"data-value="'.$product->base_price.'">'.$prefix.$productHumanCurrentPrice.'</span>&nbsp;'.$symbol;

        return $price;
    }

    public static function metaPrice($product)
    {
        if(is_object($product))
            $productCurrentPrice = $product->getCurrentPrice();
        else
            $productCurrentPrice = $product;
        return number_format($productCurrentPrice, 2, '.', '');
    }
}