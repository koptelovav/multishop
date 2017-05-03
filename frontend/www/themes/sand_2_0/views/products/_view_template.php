<?php if (isset($product) && !is_null($product)): ?>
    <?php $col =isset($col) ? $col : 4 ?>

    <div class="col-xs-6 col-md-<?= $col ?> col-lg-<?= $col ?> product <?= !$product->in_stock ? 'no-stock' : ''?>">
        <div class="product-inner">
            <?= CHtml::link($product->short_title, SHtml::productUrl($product), array('class'=>'h3')) ?>

            <div class="block-content">
                <?php $this->renderPartial('//products/_labels', array('product' => $product)) ?>

                <div class="image">
                    <?= PHtml::image($product, PHtml::IMAGE_CATEGORY) ?>
                </div>

                <?php if ($product->type == Products::TYPE_COMPOSITION)
                    $this->renderPartial('//products/_view_composition', array('product' => $product));
                else
                    $this->renderPartial('//products/_view_simple', array('product' => $product)); ?>
            </div>
        </div>
    </div>
<?php endif; ?>