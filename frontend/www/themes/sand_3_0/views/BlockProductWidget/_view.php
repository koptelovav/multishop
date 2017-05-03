<?php
/* @var $this ProductsController */
/* @var $data Products */
?>


<div class="col-xs-6 col-md-4 col-lg-4 product <?= !$data->in_stock ? 'no-stock' : ''?>" itemtype="http://schema.org/Product" itemprop="itemListElement" itemscope>
    <div class="product-inner">
        <div class="block-content">
            <div id="product-image_<?= $data->id ?>" class="image" data-image="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $data->image)?>">
                <?//= PHtml::image($data, PHtml::IMAGE_CATEGORY) ?>
                <a href="<?= PHtml::url($data)?>">
                    <?=
                    CHtml::image(
                        Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $data->image),
                        $data->title,
                        array('class'=>'img-responsive product-image', 'itemprop'=>'image'))
                    ?>
                </a>
            </div>
            <?= CHtml::link($data->short_title, SHtml::productUrl($data), array('class'=>'h3', 'itemprop'=> 'name')) ?>
            <div class="product-info">
                <div class="product-price text-left" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <?= PHtml::price($data) ?>
                    <meta itemprop="price" content="<?= PHtml::metaPrice($data) ?>">
                    <meta itemprop="priceCurrency" content="RUB">
                    <link itemprop="availability" href="<?= $data->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
                </div>
                <div class="text-right">
                    <?= Cart::buyButton($data, ' В корзину', 'btn') ?>
                </div>
            </div>
        </div>
    </div>
    <meta itemprop="description " content="<?= !empty($data->meta_description) ? CHtml::encode($data->meta_description) : (CHtml::encode($data->title).' купить в Москве и Санкт-Петербурге') ?>">
</div>