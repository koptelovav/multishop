<h2>Характерстики</h2>

<ul class="list-unstyled">
    <?php if ($manufacturer = $product->manufacturer): ?>
        <li>Бренд: <span itemprop="brand"><?= $manufacturer->name ?></span></li>
    <?php endif ?>
    <li>Категория: <a href="<?= Yii::app()->createUrl('category/view', ['cid' => $product->category]) ?>"
                      itemprop="category">
            <?= $product->generalCategory->title ?>
        </a></li>
    <?php foreach ($product->features as $productFeature): ?>
        <?php $feature = $productFeature->feature ?>
        <?php if ($feature->visible): ?>
            <?php if($feature->id == 1)
                $itemProp = 'sku';
            else
                $itemProp = '';
            ?>
            <li>
                <?= $feature->title ?>:
                <span <?= $itemProp ? "itemprop='$itemProp'" : ''?>><?= $productFeature->value ?> <?= isset($feature->suffix) ? $feature->suffix : '' ?></span>
            </li>
        <?php endif ?>

    <?php endforeach; ?>
</ul>