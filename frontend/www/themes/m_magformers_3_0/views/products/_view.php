<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php if (isset($data) && !is_null($data)): ?>
    <div class="col-xs-12 col-sm-6 product--wrap <?= !$data->in_stock ? 'no-stock' : ''?>" <?= $data->getAttributeString() ?> itemtype="http://schema.org/Product" itemscope>
        <div class="product--inside">
                <?php $this->renderPartial('//products/_labels', array('product' => $data)) ?>
                <a href="<?= PHtml::url($data)?>" class="product--image">
                <?=
                CHtml::image(
                    Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $data->image),
                    $data->title,
                    array('class'=>'img-responsive', 'itemprop'=>'image'))
                ?>
                </a>
                <?= CHtml::link('<span itemprop="name">'.$data->short_title.'</span>', PHtml::url($data), array('class'=>'product--title', 'itemprop'=>'url')) ?>
                <div class="product-inner-wrap">
                    <?php $this->renderPartial('//products/_view_simple', array('product' => $data)); ?>
                </div>
            <meta itemprop="description " content="<?= !empty($data->meta_description) ? CHtml::encode($data->meta_description) : ($data->title.' купить в Москве и Санкт-Петербурге') ?>">
        </div>
    </div>
<?php endif; ?>