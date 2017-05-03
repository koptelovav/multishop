<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->pageTitle = $model->title;
$this->breadcrumbs = SHtml::getProductBreadcrumbs($model);
Yii::app()->clientScript->registerMetaTag(PHtml::url($model), null, null, array('rel' => 'canonical'));
?>
<div class="block block-color elements">
    <div class="block-title"><?php echo $model->title ?></div>
    <div class="block-content">
        <div id="product" class="view-product">
            <div class="images">
                <div class="bordered product-image">
                    <a class="fancybox" rel="gallery" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$model->image) ?>">
                        <img class="img-responsive" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot.$model->image) ?>"/>
                    </a>
                </div>

                <div class="addition-image product-image">
                    <?php foreach ($model->images() as $image): ?>
                        <a class="fancybox" rel="gallery" title="<?= $image->description?>" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$image->url) ?>">
                            <img class="img-responsive" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_ADDITIONAL, Yii::app()->media->webroot.$image->url) ?>"/>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="summary">
                <div class="block">
                    <?php if($model->type == Products::TYPE_COMPOSITION)
                        echo $this->renderPartial('view_composition', array('product' => $model));
                    else
                        echo $this->renderPartial('view_simple', array('product'=>$model)); ?>

                    <?php if($model->getDiscount()):?>
                        <h4 style="color:#880000"> Внимание! Скидка по промокоду не действует на товары со скидкой.</h4>
                    <?php endif;?>

                    <?php echo $model->getDescription(); ?>

                        <?php echo $this->renderPartial('_video', array('product'=>$model));?>
                    </div>

                    <?php echo $this->renderPartial('_share_buttons');?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="related">
    <?php $this->widget('frontend.widgets.RelatedProductWidget', array(
        'product' => $model
    )) ?>
</div>

