<?php
/**
 * @var $product Products
 */
?>
<?php if($product): ?>
<?php if($product->video): ?>
    <a class="video-label label" href="<?php echo PHtml::url($product); ?>#video-review">
        <span>видеообзор</span>
    </a>
<?php endif; ?>

<?php if ($gifts = $product->gifts): ?>
    <?php foreach($gifts as $item): ?>
        <div class="gift-product sticker">
            <a href="<?= PHtml::url($item); ?>" class="gift-preview">
                <img class="img-responsive gift-image" src="<?php echo Yii::app()->image->createUrl( 'mini', Yii::app()->media->webroot.$item->image); ?>" alt="<?= CHtml::encode($item->short_title); ?>"/>
            </a>
            <a href="<?php echo PHtml::url($item); ?>#gift-preview" class="gift-label">
                подарок
            </a>
        </div>
    <?php endforeach?>
<?php endif; ?>

<?php if ($discount = $product->getDiscount()): ?>
    <div class="discount-product sticker">
        <div><?php echo $discount->getLabel() ?></div>
        <span>до <?php echo date('d.m.y', strtotime($discount->date_to)) ?></span>
    </div>
<?php endif; ?>

<?php if ($product->shipping_discount): ?>
    <div class="shipping-discount sticker">
        <span>скидка</span>
        <div>-<?php echo SHtml::toPrice($product->shipping_discount) ?></div>
        <span>на доставку</span>
    </div>
<?php endif; ?>
<?php endif; ?>
