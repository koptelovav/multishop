<?php
/* @var $this ProductsController */
/* @var $model Products */
$this->breadcrumbs = SHtml::getProductBreadcrumbs($model);
?>
<div itemscope itemtype="http://schema.org/Product">
    <div id="product">
        <div class="row">
            <div class="col-lg-5">
                <div class="product-images">
                    <a itemprop="image" rel="gallery"
                       href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot . $model->image) ?>">
                        <img class="img-responsive"
                             src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot . $model->image) ?>"
                             title="<?= $model->title ?>"/>
                    </a>
                    <div class="items">
                        <?php foreach ($model->images as $key=>$image): ?>
                            <a rel="gallery" title="<?= $image->description ?>"
                               href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot . $image->url) ?>">
                                <img class="img-responsive"
                                     src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_ADDITIONAL, Yii::app()->media->webroot . $image->url) ?>"
                                     title="<?= $model->title.'_'.$key ?>"/>
                            </a>
                        <?php endforeach; ?>
                        <?php if($model->video): ?>
                            <?= SHtml::popupImage('Видео для '.$model->title, '/images/products/kineticsand/play.jpg', $model->getVideoUrl(), PHtml::IMAGE_ADDITIONAL) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="product-infoblock col-lg-7">
                <h1 class="title" itemprop="name"><?= $model->title ?></h1>

                <div class="row">
                <?php if ($model->type == Products::TYPE_COMPOSITION)
                    $this->renderPartial('view_composition', array('product' => $model));
                else
                    $this->renderPartial('view_simple', array('product' => $model));
                ?>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="description">
                    <h3>Описание</h3>

                    <span itemprop="description">
                        <?php echo $model->getDescription(); ?>
                        <?php if ($model->getDiscount()): ?>
                            <h4 style="color:#880000"> Внимание! Скидка по промокоду не действует на товары со скидкой.</h4>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <?php $this->renderPartial('features', array('product' => $model)); ?>
                <?php $this->renderPartial('_attachments', array('product' => $model)); ?>
                <?php $this->renderPartial('_share_buttons'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="advert">
                    <?php // $this->widget('frontend.widgets.AdvertProductWidget')?>
                </div>
            </div>
        </div>
    </div>
</div>

