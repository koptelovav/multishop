<?php
/* @var $this ProductsController */
/* @var $data Products */
?>
<?php $data= $data->product ?>
<li class="product block <?= $index % 6 == 0 ? 'first' : '' ?>">
        <?php if($data->getDiscount()):?>
           <div class="onsale">Акция</div>
        <?php endif ?>

    <a href="<?php echo SHtml::productUrl($data); ?>">
        <img class="img-responsive" src="<?php echo Yii::app()->image->createUrl( 'bbthumbnail', Yii::app()->media->webroot.$data->image); ?>" alt="<?= CHtml::encode($data->short_title); ?>"/>
        <strong><?php echo CHtml::encode($data->short_title); ?></strong>
    </a>
    <div class="product-inner-wrap">
        <div class="product-short-desc">
        </div>
        <span class="price">
            <?php echo $data->currentPrice; ?> р.
        </span>
        <?php echo Cart::buyButton($data,'В корзину','button-buy')?>
    </div>
</li>
