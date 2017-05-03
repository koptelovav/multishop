<?php $currentPrice = $product->getCurrentPrice() ?>

<?php if($currentPrice): ?>
    <div class="product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <?= PHtml::price($product) ?>
        <meta itemprop="price" content="<?= PHtml::metaPrice($product) ?>">
        <meta itemprop="priceCurrency" content="RUB">
        <link itemprop="availability" href="<?= $product->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
    </div>
<?php endif ?>

<div class="product-info">
    <?php if($currentPrice): ?>
        <?= Cart::buyButton($product, 'В корзину', 'btn') ?>
    <?php endif ?>
</div>