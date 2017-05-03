<?php $currentPrice = $product->getCurrentPrice() ?>

<?php if($currentPrice): ?>
    <div class="product--price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <?= PHtml::price($product) ?>
        <meta itemprop="price" content="<?= PHtml::metaPrice($product) ?>">
        <meta itemprop="priceCurrency" content="RUB">
        <link itemprop="availability" href="<?= $product->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
    </div>
<?php endif ?>

<div class="product--info">
    <?php if($product->in_stock): ?>
        <a href="#"
           data-href="<?= Yii::app()->createUrl('cart/add') ?>"
           data-id="<?= $product->id ?>"
           data-modificator="cart"
           data-event="buy_product"
           data-preloader="disable"
           class="btn buy"
           onclick="yaCounter41166644.reachGoal('ADD_TO_CART'); return true;"
        >
        <span class="btn--inside">
            <span class="btn--title">В корзину</span>
        </span>
        </a>
    <?php else: ?>
        <span class="no-stock-info">Нет в наличии</span>
    <?php endif; ?>


</div>