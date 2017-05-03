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
    <div class="gift-product sticker">
        <span class="gift-preview">
            <img class="img-responsive gift-image" src="<?= Yii::app()->theme->baseUrl ?>/img/product/pieces.jpg" alt="Детали в подарок"/>
        </span>
        <span class="gift-label">
            подарок
        </span>
    </div>
<?php endif; ?>

<?php if ($discount = $product->getDiscount()): ?>
    <div class="discount-product sticker">
        <div><?php echo $discount->getLabel() ?></div>
    </div>
<?php endif; ?>

<?php endif; ?>
