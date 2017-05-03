<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php if (isset($data) && !is_null($data)): ?>
    <div class="col-xs-6 col-sm-6 col-md-2 product-wrap" itemtype="http://schema.org/Product" itemprop="itemListElement" itemscope>
        <div class="product">
            <div class="left-column">
                <a href="<?= PHtml::url($data)?>">
                    <?=
                    CHtml::image(
                        Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $data->image),
                        $data->title,
                        array('class'=>'img-responsive product-image', 'itemprop'=>'image'))
                    ?>
                </a>
            </div>
            <div class="right-column">
                <?= CHtml::link($data->short_title, PHtml::url($data), array('class'=>'product-title', 'itemprop'=> 'name')) ?>
                <div class="product-inner-wrap">
                    <?php $currentPrice = $data->getCurrentPrice() ?>

                    <?php if($currentPrice): ?>
                        <div class="product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <?= PHtml::price($data) ?>
                            <meta itemprop="price" content="<?= PHtml::metaPrice($data) ?>">
                            <meta itemprop="priceCurrency" content="RUB">
                            <link itemprop="availability" href="<?= $data->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
                        </div>
                    <?php endif ?>

                    <div class="product-info">
                        <?php if($currentPrice): ?>
                            <?= Cart::buyButton($data, 'В корзину', 'btn') ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <meta itemprop="description " content="<?= !empty($data->meta_description) ? CHtml::encode($data->meta_description) : ($data->title.' купить в Москве и Санкт-Петербурге') ?>">
        </div>
    </div>
<?php endif; ?>