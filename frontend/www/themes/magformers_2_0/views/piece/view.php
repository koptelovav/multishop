<?php
$this->pageTitle = $model->title;
?>

<h1><?= $model->title ?></h1>
<ul>
    <?php foreach ($model->products as $product): ?>
        <li><a href="<?= PHtml::url($product)?>"><?= $product->title ?></a></li>
    <?php endforeach ?>
</ul>
