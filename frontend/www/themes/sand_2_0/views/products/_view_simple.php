<div class="product-info">
    <div class="product-price text-left">
        <?= PHtml::price($product) ?>
    </div>
    <div class="text-right">
        <?= Cart::buyButton($product, 'В корзину', 'btn') ?>
    </div>
</div>