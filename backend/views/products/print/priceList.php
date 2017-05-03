<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/price_list.css');
?>

<div class="list">
    <?php foreach($products as $id=>$count): ?>
        <?php $product = Products::model()->findByPk($id); ?>
        <?php for($i = 0; $i < $count; $i++):?>
            <div class="price-list">
                <div class="seller">ИП Коптелов А.В.</div>
                <div class="content">
                    <div class="product-name"><?php echo $product->short_title ?></div>
                    <div class="product-price"><?php echo number_format($product->price, 2, '.', ' '); ?> руб.</div>
                    <div class="data">
                        <div class="product-article">арт.: <?php echo $product->article ?></div>
                        <div class="product-code">код: <?php echo $product->id ?></div>
                    </div>
                </div>
            </div>
        <?php endfor ?>
    <?php endforeach ?>
</div>

