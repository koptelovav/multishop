<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php $data= $data->product ?>
<li class="product">
    <a href="<?php echo PHtml::url($data) ?>">
        <img class="img-responsive" src="<?php echo Yii::app()->image->createUrl( 'mini', Yii::app()->media->webroot.$data->image); ?>" alt="<?php echo CHtml::encode($data->short_title); ?>"/>
    </a>
    <div class="product-inner-wrap">
        <div class="title"><?php echo CHtml::link($data->short_title, array('products/view', 'id'=>$data->id, 'title'=>$data->short_title)); ?></div>
        <span class="price">
            <?php if($data->getDiscount()):?>
                <del><?php echo $data->price; ?> р.</del>
                <ins><?php echo $data->currentPrice; ?> р.</ins>
            <?php else: ?>
                <?php echo $data->currentPrice; ?> р.
            <?php endif ?>
        </span>
    </div>
</li>
