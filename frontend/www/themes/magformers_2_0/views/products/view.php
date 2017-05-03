<?php
/* @var $this ProductsController */
/* @var $model Products */
//$this->breadcrumbs = SHtml::getProductBreadcrumbs($model);
$this->layout = '//layouts/main';
?>
<div id="product" class="view-product" itemscope itemtype="http://schema.org/Product">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-5">
            <div class="images">
                <div class="swipe-block visible-xs">
                    <img class="img-responsive view" src="#"/>
                    <img class="swipe-image" src="<?= Yii::app()->baseUrl ?>/images/swipe.gif"/>
                </div>

                <div class="product-image general-product-image hidden-xs">
                    <a itemprop="image" class="fancybox" rel="gallery" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$model->getImage()) ?>"
                       data-mobile="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot.$model->image) ?>">
                        <img class="img-responsive" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot.$model->getImage()) ?>"/>
                    </a>
                </div>

                <div class="addition-image product-image row hidden-xs">
                    <?php foreach ($model->images as $image): ?>
                        <div class="col-xs-2">
                            <a class="fancybox" rel="gallery" title="<?= $image->title?>" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$image->url) ?>"
                               data-mobile="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$image->url) ?>">
                                <img class="img-responsive" alt="<?= $image->alt ?>" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_ADDITIONAL, Yii::app()->media->webroot.$image->url) ?>"/>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-7">
            <div class="summary">
                <h1 itemprop="name"><?php echo $model->title ?></h1>

                <section class="info">
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                        <div class="price product-price">
                            <?= PHtml::price($model) ?>
                            <meta itemprop="price" content="<?= PHtml::metaPrice($model) ?>">
                            <meta itemprop="priceCurrency" content="RUB">
                            <link itemprop="availability" href="<?= $model->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
                            <?php echo Cart::buyButton($model, 'В корзину', 'btn') ?>
                        </div>
                    </div>

                    <div class="user-product-action">
                        <?php $this->widget('frontend.widgets.YandexDirectOfferWidget'); ?>

                        <?php if($model->getDiscount()):?>
                        <div class="item">
                            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/product/sale-informer.jpg"/>
                        </div>
                        <?php endif; ?>

                        <div class="item">
                            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/product/shipping-informer.jpg"/>
                        </div>

                        <?php if ($gifts = $model->gifts): ?>
                        <div class="item">
                            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/product/pieces-informer.jpg"/>
                        </div>
                        <?php endif; ?>

                        <?php if($model->video): ?>
                        <div class="item hidden-xs">
                            <a href="<?= $model->getVideoUrl() ?>" class="funcybox-video" title="Видео для <?= $model->title ?>">
                                <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/product/video-informer.jpg"/>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="description">
                    <h2>Описание</h2>
                     <span id="readMoreReadLess" class="product-description" itemprop="description">
                         <?php echo $model->getDescription(); ?>
                         <div class="p">
                                 <?php echo $this->renderPartial('features', array('product' => $model)); ?>
                         </div>
                         <?php if($model->getDiscount()):?>
                             <h4 style="color:#880000"> Внимание! Скидка по промокоду не действует на товары со скидкой.</h4>
                         <?php endif;?>
                    </span>
                </section>

                <section class="video visible-xs">
                    <?php echo $this->renderPartial('_video', array('product'=>$model));?>
                </section>


                <?php echo $this->renderPartial('_attachments', array('product' => $model)); ?>
                <?php echo $this->renderPartial('_product_equipment', array('product'=>$model));?>

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