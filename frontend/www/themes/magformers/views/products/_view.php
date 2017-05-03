<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php if (isset($product) && !is_null($product)): ?>
<div class="col-xs-6 col-md-3 col-lg-3 product">
    <?php $this->renderPartial('_labels', array('product' => $product)) ?>

    <?= PHtml::image($product, PHtml::IMAGE_CATEGORY, array('class'=>'img-responsive product-image')) ?>

    <?= CHtml::link($product->short_title, PHtml::url($product), array('class'=>'product-title')) ?>

    <div class="product-inner-wrap">
       <?php $this->renderPartial('_view_simple', array('product' => $product)); ?>
    </div>
</div>
<?php endif; ?>