<?php
/* @var $this ProductsController */
/* @var $data Products */
$this->layout = '//layouts/common'
?>

<?php if (isset($data) && !is_null($data)): ?>
    <div class="col-xs-3 product--wrap product-piece">
        <div class="product--inside">
                <?php $image = realpath(Yii::app()->media->basePath.'/www'.$data->preview_image) ? $data->preview_image : $data->temp_image;?>
                <?= SHtml::imageWithMeta(PHtml::IMAGE_CATEGORY,$data->title,$image, Yii::app()->createUrl('piece/view', ['id'=>$data->id]), ['class'=>'img-responsive product-image']) ?>
                <?= CHtml::link($data->short_title, $this->createUrl('view',['id'=>$product->id]), ['class'=>'product--title']) ?>
        </div>
    </div>
<?php endif; ?>