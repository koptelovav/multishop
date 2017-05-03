<?php
/**
 * @var $product Products
 */
?>
<?php if($product): ?>
    <?php if($product->video): ?>
        <a class="_view-video" href="<?php echo PHtml::url($product); ?>#video-review">
            <img class="video-review" src="<?php echo Yii::app()->request->baseUrl ?>/images/video.png" alt="видеообзор"/>
        </a>
    <?php endif; ?>

    <?php if ($gifts = $product->gifts): ?>
        <?php foreach($gifts as $item): ?>
            <div class="gift-product sticker">
                <a href="<?php echo PHtml::url($item); ?>#gift-preview" class="gift-label">
                    +&nbsp;подарок
                </a>
            </div>
        <?php endforeach?>
    <?php endif; ?>

    <?php if ($discount = $product->getDiscount()): ?>
        <div class="discount-product sticker">
            <div><?php echo $discount->getLabel() ?></div>
        </div>
    <?php endif; ?>
<?php endif; ?>
