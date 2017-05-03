<?php $currentPrice = $product->getCurrentPrice() ?>

<?php if($currentPrice): ?>
    <div class="product-price">
        <?= PHtml::price($product) ?>
    </div>
<?php endif ?>

<div class="product-info">
    <?php if($currentPrice): ?>
        <?= Cart::buyButton($product, 'В корзину', 'btn') ?>
    <?php endif ?>
</div>