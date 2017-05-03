<?php if($includeProducts = $product->product_include): ?>
    <b>Комплектация набора:</b>
    <ul class="include-product">
        <?php foreach($includeProducts as $item): ?>
            <?php $eProduct = $item->product ?>
            <li><?= CHtml::link($eProduct->title, PHtml::url($eProduct)) ?><?= $item->count > 1 ? ' x '.$item->count : ''; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if($gifts = $product->gifts): ?>
    <h4>Подарки:</h4>
    <ul class="include-product list-unstyled">
        <?php foreach($gifts as $item): ?>
            <li><?= CHtml::link($item->title, PHtml::url($item)) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
