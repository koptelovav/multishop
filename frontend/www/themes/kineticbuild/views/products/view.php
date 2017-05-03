<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->pageTitle = $model->title. ' | '.Yii::app()->shop->title;
?>
<div id="product">
    <div class="row">
        <div class="col-lg-7">
            <div class="product-images">
                <a rel="gallery" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$model->image) ?>">
                    <img class="img-responsive" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot.$model->image) ?>"/>
                </a>
                <div class="items">
                    <?php foreach($model->images as $image): ?>
                        <a rel="gallery" title="<?= $image->description?>" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$imageurlname) ?>">
                            <img class="img-responsive" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_ADDITIONAL, Yii::app()->media->webroot.$image->url) ?>"/>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <?php if($model->type == Products::TYPE_COMPOSITION){
                echo $this->renderPartial('view_composition', array('product' => $model));
            }else{
                echo'<h1>'.$model->title.'</h1>';
                echo $this->renderPartial('view_simple', array('product'=>$model));
            }
            ?>

            <p>&nbsp;</p>
            <?php echo $this->renderPartial('_attachments', array('product'=>$model));?>

            <?php if($model->getDiscount()):?>
                <h4 style="color:#880000"> Внимание! Скидка по промокоду не действует на товары со скидкой.</h4>
            <?php endif;?>

            <?php echo $model->getDescription(); ?>

            <?php echo $this->renderPartial('_video', array('product'=>$model));?>

            <?php echo $this->renderPartial('_share_buttons');?>
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


