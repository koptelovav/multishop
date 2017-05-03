<?php
/* @var $this ProductsController */
/* @var $model Products */
//$this->breadcrumbs = SHtml::getProductBreadcrumbs($model);
$this->layout = '//layouts/product';
$this->breadcrumbs = SHtml::getProductBreadcrumbs($model);
$this->headerClass = FrontEndController::HEADER_SLIM;
$this->bannerUrl = Yii::app()->media->baseUrl . Category::model()->findByPk($model->category)->getImage(Image::TYPE_CATEGORY_BANNER);
?>

<div class="container">
    <div id="product" class="product-view" itemscope itemtype="http://schema.org/Product">
        <div class="product-view--inside row">
            <div class="col-xs-6 product--left-column">
                <div class="sticky-column">
                    <div class="images">
                        <div class="product-image general-product-image">
                            <a itemprop="image" class="fancybox" rel="gallery"
                               href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot . $model->getImage()) ?>">
                                <img class="img-responsive"
                                     src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot . $model->getImage()) ?>"/>
                            </a>
                        </div>

                        <div class="addition-image product-image row">
                            <?php foreach ($model->images as $image): ?>
                                <div class="col-xs-3">
                                    <a class="fancybox" rel="gallery" title="<?= $image->title ?>"
                                       href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot . $image->url) ?>">
                                        <img class="img-responsive" alt="<?= $image->alt ?>"
                                             src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_ADDITIONAL, Yii::app()->media->webroot . $image->url) ?>"/>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 product--right-column">
                <div class="summary">
                        <div class="product-view--title" itemprop="name"><?php echo $model->title ?></div>


                        <span class="product-view--offer" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <span class="product--price product--price--large">
                                <?= PHtml::price($model) ?>
                                <meta itemprop="price" content="<?= PHtml::metaPrice($model) ?>">
                                <meta itemprop="priceCurrency" content="RUB">
                                <link itemprop="availability"
                                      href="<?= $model->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
                            </span>
                            <?php echo Cart::buyButton($model, '<span class="btn--inside">В корзину</span>', 'btn', "yaCounter41166644.reachGoal('ADD_TO_CART'); return true;") ?>
                        </span>

                    <section class="info">
                        <div class="product-advantages">
                            <a href="#" class="product-advantages--item" data-toggle="modal" data-target="#freeDelivery">
                                <span class="product-advantages--icon free-delivery--icon"></span>
                                <span class="product-advantages--item--title">Доставка 0 руб.</span>
                                <span class="product-advantages--item--desc">Бесплатная доставка по всей России</span>
                            </a>

                            <?php if ($model->getDiscount()): ?>
                                <a href="#" class="product-advantages--item col-xs-6">
                                    <span class="product-advantages--icon sale--icon"></span>
                                    <span class="product-advantages--item--title">Скидка 10%</span>
                                    <span class="product-advantages--item--desc">
                                        Скидка 10% на набор <?= $model->short_title ?>
                                    </span>
                                </a>
                            <?php elseif(Yii::app()->YandexDirectChecker->showAdvert()): ?>
                                <a href="#" class="product-advantages--item col-xs-6" data-toggle="modal" data-target="#promoSale">
                                    <span class="product-advantages--icon sale--icon"></span>
                                    <span class="product-advantages--item--title">Скидка 10%</span>
                                    <span class="product-advantages--item--desc">
                                        Скидка 10% на набор <?= $model->short_title ?> по промокоду <b style="color: #f82f38">SALE10</b>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if ($model->video): ?>
                                <a href="<?= $model->getVideoUrl() ?>" class="funcybox-video product-advantages--item" title="Видео для <?= $model->title ?>">
                                    <span class="product-advantages--icon video--icon"></span>
                                    <span class="product-advantages--item--title">Видеообзор</span>
                                    <span class="product-advantages--item--desc">Видеообзор набора <?= $model->short_title ?>. Обязательно посмотрите</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </section>

                    <section class="description">
                        <h2>Описание</h2>
                        <span class="product-description" itemprop="description">
                             <?php echo $model->getDescription(); ?>
                             <?php echo $this->renderPartial('features', array('product' => $model)); ?>
                             <?php if ($model->getDiscount()): ?>
                                 <h4 style="color:#880000"> Внимание! Скидка по промокоду не действует на товары со скидкой.</h4>
                             <?php endif; ?>
                         </span>
                    </section>

                    <section class="video visible-xs">
                        <?php echo $this->renderPartial('_video', array('product' => $model)); ?>
                    </section>


                    <?php echo $this->renderPartial('_attachments', array('product' => $model)); ?>
                    <?php echo $this->renderPartial('_product_equipment', array('product' => $model)); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row review">
        <div class="col-xs-12">
            <?php $this->widget('frontend.widgets.ProductCommentWidget', array(
                'productId' => $model->id
            )) ?>

        </div>
    </div>
</div>


<div class="modal fade" id="freeDelivery" tabindex="-1" role="dialog" aria-labelledby="freeDelivery">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Информация о доставке</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('//site/pages/shipping')?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="promoSale" tabindex="-1" role="dialog" aria-labelledby="promoSale">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Скидка 10%</h4>
            </div>
            <div class="modal-body">
                <p>
                    На данный набор действует скидка 10% по промокоду <span style="color: #f82f38; font-weight: bold">SALE10</span>.<br>
                    Промокод необходимо ввести в корзине.
                    На набор <?= $model->title ?> сикдка составит <span style="color: #f82f38; font-weight: bold"><?=  PHtml::metaPrice($model) -  PHtml::metaPrice($model)*.9 ?> руб.</span>
                </p>

            </div>
        </div>
    </div>
</div>