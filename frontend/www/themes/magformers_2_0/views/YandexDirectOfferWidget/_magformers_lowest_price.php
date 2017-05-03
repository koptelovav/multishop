<?php if (isset($data) && $data == 'category'): ?>
    <div class="item">
        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/product/sale-category.jpg"/>
    </div>
<?php else: ?>
    <div class="item">
        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/product/ya-lowest-sale-informer.jpg"/>
    </div>
<?php endif; ?>