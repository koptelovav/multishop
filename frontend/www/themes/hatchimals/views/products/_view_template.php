<?php if (isset($product) && !is_null($product)): ?>


    <div class="col-xs-6 col-md-3 product <?= !$product->in_stock ? 'no-stock' : ''?>">
        <div class="product-inner">
            <div class="block-content">
                <?php $this->renderPartial('//products/_labels', array('product' => $product)) ?>

                <a href="<?= PHtml::url($product)?>">
                    <?=
                    CHtml::image(
                        Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $product->image),
                        $product->title,
                        array('class'=>'img-responsive product-image', 'itemprop'=>'image'))
                    ?>
                </a>
                <?= CHtml::link($product->short_title, SHtml::productUrl($product), array('class'=>'h3')) ?>
                <?php if ($product->type == Products::TYPE_COMPOSITION)
                    $this->renderPartial('//products/_view_composition', array('product' => $product));
                else
                    $this->renderPartial('//products/_view_simple', array('product' => $product)); ?>
            </div>
        </div>
    </div>
<?php endif; ?>