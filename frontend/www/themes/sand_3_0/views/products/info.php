<div class="price product-price">
    <?= PHtml::price($product) ?>
    <meta itemprop="price" content="<?= PHtml::metaPrice($product) ?>">
    <meta itemprop="priceCurrency" content="RUB">
    <link itemprop="availability" href="<?= $product->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
    <?php echo Cart::buyButton($product, 'В корзину', 'btn', "yaCounter22206275.reachGoal('ADD_TO_CART'); return true;") ?>
</div>

