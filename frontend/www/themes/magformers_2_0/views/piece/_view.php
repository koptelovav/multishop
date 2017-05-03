<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php if (isset($data) && !is_null($data)): ?>
    <div class="col-xs-6 col-sm-6 col-md-2 product-wrap">
        <div class="product">
            <div class="left-column">
                <?php   $image = realpath(Yii::app()->media->basePath.'/www'.$data->preview_image) ? $data->preview_image : $data->temp_image;?>
                <?= SHtml::imageWithMeta(PHtml::IMAGE_CATEGORY,$data->title,$image, Yii::app()->createUrl('piece/view', ['id'=>$data->id]), ['class'=>'img-responsive product-image']) ?>
            </div>
            <div class="right-column">
                <?= CHtml::link($data->short_title, $this->createUrl('view',['id'=>$product->id]), ['class'=>'product-title']) ?>
            </div>
        </div>
    </div>
<?php endif; ?>