<div class="text-left">
    <?php foreach ($product->compositions as $productComposition): ?>
        <div class="row visible-lg">
            <div class="col-md-2 text-left" style="padding-right: 0">
                <?= CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $productComposition->image), $product->title, array('class'=>'img-responsive')) ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6 composition-label">
                <?php echo $productComposition->label ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6 product-price">
                <?php echo SHtml::toPrice($productComposition->product->currentPrice) ?>
            </div>
        </div>
    <?php endforeach ?>
    <div class="product-price price-mobi hidden-lg">
        от <?= PHtml::price($product->compositions[0]->product, false) ?>
    </div>
</div>

<div class="product-info text-center">
    <?= PHtml::readMore($product) ?>
</div>