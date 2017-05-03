<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php if (isset($data) && !is_null($data)): ?>
    <div class="col-xs-6 col-sm-6 col-md-2 product-wrap">
        <div class="product">
            <div class="left-column">
                <?php $this->renderPartial('//products/_labels', array('product' => $data)) ?>
                <?= PHtml::image($data, PHtml::IMAGE_CATEGORY, array('class'=>'img-responsive product-image')) ?>
            </div>
            <div class="right-column">
                <?= CHtml::link($data->short_title, PHtml::url($data), array('class'=>'product-title')) ?>
                <div class="product-inner-wrap">
                    <?php $this->renderPartial('//products/_view_simple', array('product' => $data)); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>