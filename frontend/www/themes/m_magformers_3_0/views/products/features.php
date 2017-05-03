<h2>Характерстики</h2>

<ul class="list-unstyled">
    <?php if($manufacturer = $product->manufacturer): ?>
        <li>Бренд: <?= $manufacturer->name ?></li>
    <?php endif ?>

<?php foreach($product->features as $productFeature): ?>
    <?php $feature = $productFeature->feature ?>
    <?php if($feature->visible): ?>
        <li>
        <?= $feature->title.': '.$productFeature->value ?> <?= isset($feature->suffix) ? $feature->suffix : ''?>
        </li>
    <?php endif ?>

<?php endforeach; ?>
</ul>