<?php
/* @var $this ProductsController */
/* @var $model Products */
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
                               href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot . $image->name) ?>">
                                <img class="img-responsive"
                                     src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_ADDITIONAL, Yii::app()->media->webroot . $image->name) ?>"
                                     title="<?= $model->title.'_'.$key ?>"/>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php echo $this->renderPartial('_video', array('product' => $model)); ?>
            </div>

            <div class="product-infoblock col-lg-7">
                <h1 class="title" itemprop="name"><?= $model->title ?></h1>



                <div class="row">
                <?php if ($model->type == Products::TYPE_COMPOSITION)
                    echo $this->renderPartial('view_composition', array('product' => $model));
                else
                    echo $this->renderPartial('view_simple', array('product' => $model));
                ?>
                </div>

                <?php echo $this->renderPartial('features', array('product' => $model)); ?>
                <?php echo $this->renderPartial('_attachments', array('product' => $model)); ?>

                <p>&nbsp;</p>

                <div class="description">
                    <h3>Описание</h3>

                    <span itemprop="description">
                        <?php echo $model->getDescription(); ?>
                    </span>
                </div>

                <?php if ($model->getDiscount()): ?>
                    <h4 style="color:#880000"> Внимание! Скидка по промокоду не действует на товары со скидкой.</h4>
                <?php endif; ?>

                <?php echo $this->renderPartial('_share_buttons'); ?>
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

