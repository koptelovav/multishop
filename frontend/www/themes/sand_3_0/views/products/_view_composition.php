<div class="text-left" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
    <?php $aggregateOfferData = $product->aggregateOfferData() ?>
    <?php $i = 0; foreach ($product->compositions as $productComposition): $i++ ?>
        <div class="row visible-lg _view-composition" data-product-id="<?= $product->id ?>" data-image="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $productComposition->product->image)?>">
            <div class="col-md-2 text-left" style="padding-right: 0">
                <?php
                if($productComposition->image)
                    echo CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $productComposition->image), $product->title, array('class'=>'img-responsive'))
                ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6 composition-label">
                <?= CHtml::link($productComposition->label, SHtml::productUrl($product), array("itemprop"=>"itemOffered")) ?>
            </div>
            <div class="col-xs-12 col-md-5 col-xs-6 product-price text-right" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <?php echo SHtml::toPrice($productComposition->product->currentPrice) ?>
                <meta itemprop="price" content="<?= PHtml::metaPrice($productComposition->product) ?>">
                <meta itemprop="priceCurrency" content="RUB">
                <link itemprop="availability" href="<?= $productComposition->product->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
            </div>
        </div>
    <?php if($i == 3) break; endforeach ?>
    <div class="product-price price-mobi hidden-lg">
        от <?= PHtml::price($product->compositions[0]->product, false) ?>
    </div>
    <meta itemprop="lowPrice" content="<?= PHtml::metaPrice($aggregateOfferData['lowPrice']) ?>">
    <meta itemprop="highPrice" content="<?= PHtml::metaPrice($aggregateOfferData['highPrice']) ?>">
    <meta itemprop="offerCount" content=" <?= $aggregateOfferData['offerCount'] ?>">
    <meta itemprop="priceCurrency" content="RUB">
</div>

<div class="product-info text-center visible-lg">
    <?= PHtml::readMore($product, 'все варианты') ?>
</div>

<div class="product-info text-center hidden-lg">
    <?= PHtml::readMore($product, 'подробнее') ?>
</div>