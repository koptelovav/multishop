<?php
/* @var $this ProductsController */
/* @var $data Products */
?>
<?php $data= $data->product ?>
<li class="product block <?= $index % 6 == 0 ? 'first' : '' ?>">
    <h4><?php echo $data->short_title ?></h4>
    <a onclick="yaCounter22206275.reachGoal('advert'); return true;" href="<?php echo PHtml::url($data, false, true); ?>">
        <img class="img-responsive" src="<?php echo Yii::app()->image->createUrl( 'bbthumbnail', Yii::app()->media->webroot.$data->image); ?>" alt="<?= CHtml::encode($data->short_title); ?>"/>
        <strong><?php echo CHtml::encode($data->short_title); ?></strong>
    </a>
    <h4><?php echo SHtml::toPrice($data->currentPrice); ?></h4>
</li>
