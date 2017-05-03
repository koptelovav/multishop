<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<div class="product-wrap">
    <div class="product">
        <div class="left-column">
            <?= PHtml::image($data, PHtml::IMAGE_CATEGORY, array('class'=>'img-responsive product-image')) ?>
        </div>
        <div class="right-column">
            <?= CHtml::link($data->short_title, PHtml::url($data), array('class'=>'product-title')) ?>
            <div class="product-inner-wrap">
                <div class="product-price">
                    <?= PHtml::price($data) ?>
                </div>
            </div>
        </div>
    </div>
</div>
