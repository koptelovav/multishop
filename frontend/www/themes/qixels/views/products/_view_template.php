<?php if (isset($product) && !is_null($product)): ?>

    <div class="col-xs-12 col-md-3 col-lg-4 product <?= !$product->in_stock ? 'no-stock' : ''?>">
        <div class="product-inner">


            <div class="block-content">
                <?php $this->renderPartial('//products/_labels', array('product' => $product)) ?>

                <div id="product-image_<?= $product->id ?>" class="image" data-image="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $product->image)?>">
                    <?= PHtml::image($product, PHtml::IMAGE_CATEGORY) ?>
                </div>
                <?= CHtml::link($product->short_title, SHtml::productUrl($product), array('class'=>'h3')) ?>
                <?php if ($product->type == Products::TYPE_COMPOSITION)
                    $this->renderPartial('//products/_view_composition', array('product' => $product));
                else
                    $this->renderPartial('//products/_view_simple', array('product' => $product)); ?>
            </div>
        </div>
    </div>
<?php endif; ?>