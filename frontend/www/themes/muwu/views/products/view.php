<?php
/* @var $this ProductsController */
/* @var $model Products */
$this->breadcrumbs = SHtml::getProductBreadcrumbs($model);
$this->layout = '//layouts/common';
?>

<div id="product" class="view-product">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="images">
                <div class="product-image general-product-image">
                    <a class="fancybox" rel="gallery" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$model->image) ?>">
                        <img class="img-responsive" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot.$model->image) ?>"/>
                    </a>
                </div>

                <div class="addition-image product-image row">
                    <?php foreach ($model->images as $image): ?>
                        <div class="col-xs-4 col-md-4 col-lg-3">
                            <a class="fancybox" rel="gallery" title="<?= $image->description?>" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$image->url) ?>">
                                <img class="img-responsive" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_ADDITIONAL, Yii::app()->media->webroot.$image->url) ?>"/>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="summary">
                <h1><?php echo $model->title ?></h1>
                <div class="row">
                    <?php if($model->type == Products::TYPE_COMPOSITION)
                        echo $this->renderPartial('view_composition', array('product' => $model));
                    else
                        echo $this->renderPartial('view_simple', array('product'=>$model)); ?>
                </div>
                <div class="description">
                    <h4>Описание</h4>
                    <?php echo $model->getDescription(); ?>

                    <?php if($model->getDiscount()):?>
                        <h4 style="color:#880000"> Внимание! Скидка по промокоду не действует на товары со скидкой.</h4>
                    <?php endif;?>

                    <?php echo $this->renderPartial('_video', array('product'=>$model));?>

                    <?php echo $this->renderPartial('_share_buttons', array('product'=>$model));?>
                </div>
            </div>
        </div>
    </div>
    <div class="row review">
        <div class="col-xs-12">
            <?php $this->widget('frontend.widgets.ProductCommentWidget', array(
                'productId' => $model->id
            )) ?>

        </div>
    </div>
</div>


<div class="related">
    <?php /*$this->widget('frontend.widgets.RelatedProductWidget', array(
        'product' => $model
    )) */?>
</div>

