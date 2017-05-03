<div class="text-left">
    <?php $i = 0; foreach ($product->compositions as $productComposition): $i++ ?>
        <div class="row visible-lg _view-composition" data-product-id="<?= $product->id ?>" data-image="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $productComposition->product->image)?>">
            <div class="col-md-2 text-left" style="padding-right: 0">
                <?php
                if($productComposition->image)
                    echo CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $productComposition->image), $product->title, array('class'=>'img-responsive'))
                ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6 composition-label">
                <?= CHtml::link($productComposition->label, SHtml::productUrl($product)) ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6 product-price text-right">
                <?php echo SHtml::toPrice($productComposition->product->currentPrice) ?>
            </div>
        </div>
    <?php if($i == 3) break; endforeach ?>
    <div class="product-price price-mobi hidden-lg">
        от <?= PHtml::price($product->compositions[0]->product, false) ?>
    </div>
</div>

<div class="product-info text-center visible-lg">
    <?= PHtml::readMore($product, 'все варианты') ?>
</div>

<div class="product-info text-center hidden-lg">
    <?= PHtml::readMore($product, 'подробнее') ?>
</div>