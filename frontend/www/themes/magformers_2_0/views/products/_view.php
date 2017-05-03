<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<?php if (isset($data) && !is_null($data)): ?>
    <div class="col-xs-6 col-sm-6 col-md-2 product-wrap <?= !$data->in_stock ? 'no-stock' : ''?>" <?= $data->getAttributeString() ?> itemtype="http://schema.org/Product" itemprop="itemListElement" itemscope>
        <div class="product">
            <div class="left-column">
                <?php $this->renderPartial('//products/_labels', array('product' => $data)) ?>
                <?//= PHtml::image($data, PHtml::IMAGE_CATEGORY, array('class'=>'img-responsive product-image')) ?>
                <a href="<?= PHtml::url($data)?>">
                <?=
                CHtml::image(
                    Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $data->getImage()),
                    $data->title,
                    array('class'=>'img-responsive product-image', 'itemprop'=>'image'))
                ?>
                </a>
            </div>
            <div class="right-column">
                <?= CHtml::link($data->short_title, PHtml::url($data), array('class'=>'product-title', 'itemprop'=> 'name')) ?>
                <div class="product-inner-wrap">
                    <?php $this->renderPartial('//products/_view_simple', array('product' => $data)); ?>
                </div>
            </div>
            <meta itemprop="description " content="<?= !empty($data->meta_description) ? CHtml::encode($data->meta_description) : ($data->title.' купить в Москве и Санкт-Петербурге') ?>">
        </div>
    </div>
<?php endif; ?>