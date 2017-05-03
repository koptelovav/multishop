<div class="set-product-price text-left">
    <?php foreach ($product->compositions as $productComposition): ?>
        <div class="row hidden-xs">
            <div class="col-md-2 text-left visible-lg" style="padding-right: 0">
                <?= CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $productComposition->image), $product->title, array('class'=>'img-responsive')) ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6 composition-label" style="font-size: 20px">
                <?php echo $productComposition->label ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6">
                <?php echo Cart::buyButton($productComposition->product, SHtml::toPrice($productComposition->product->currentPrice) . '<br/>В корзину', 'btn big-buy') ?>
            </div>
        </div>
    <?php endforeach ?>
    <div class="product-price price-mobi visible-xs">
        от <?= PHtml::price($product->compositions[0]->product, false) ?>
    </div>
</div>

<div class="product-info">
    <div class="text-center">
        <?= PHtml::readMore($product) ?>
    </div>
</div>