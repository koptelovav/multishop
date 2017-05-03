<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php if (isset($data) && !is_null($data)): ?>
    <div class="col-xs-4 col-md-4 product--wrap <?= !$data->in_stock ? 'no-stock' : ''?>" <?= $data->getAttributeString() ?> itemtype="http://schema.org/Product" itemscope>
        <div class="product--inside">
                <?php $this->renderPartial('//products/_labels', array('product' => $data)) ?>
                <?//= PHtml::image($data, PHtml::IMAGE_CATEGORY, array('class'=>'img-responsive product-image')) ?>
                <a href="<?= PHtml::url($data)?>" class="product--image">
                <?=
                CHtml::image(
                    Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $data->getImage()),
                    $data->title,
                    array('class'=>'', 'itemprop'=>'image'))
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