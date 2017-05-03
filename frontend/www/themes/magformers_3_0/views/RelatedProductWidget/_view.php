<?php
/* @var $this ProductsController */
/* @var $data Products */
?>


<li class="product block">
        <?php if($data->getDiscount()):?>
           <div class="onsale">Акция</div>
        <?php endif ?>

    <a href="<?= Yii::app()->createUrl('products/view', array('id'=>$data->id, 'title'=>$data->short_title)); ?>">
        <img class="img-responsive" src="<?= Yii::app()->image->createUrl( 'bbthumbnail', Yii::app()->media->webroot.$data->image); ?>" alt="<?= CHtml::encode($data->short_title); ?>"/>
        <strong><?= CHtml::encode($data->short_title); ?></strong>
    </a>
    <div class="product-inner-wrap">
        <div class="product-short-desc">
        </div>
        <span class="price">
            <?php if($data->getDiscount()):?>
                <del><?= $data->currentPrice; ?> р.</del>
                <ins><?= $data->price; ?> р.</ins>
            <?php else: ?>
                <?= $data->currentPrice; ?> р.
            <?php endif ?>
        </span>
        <a href="<?= Yii::app()->createUrl('cart/add', array('id'=>$data->id)) ?>" data-href="<?= Yii::app()->createUrl('cart/add', array('id'=>$data->id)) ?>" class="button-buy">
            <?php if($data->amount == 0):?>
                Предзаказ
            <?php else: ?>
                В корзину
            <?php endif ?>
        </a>
    </div>
</li>
