<?php
/* @var $this NewsController */
/* @var $model News */

?>
<div id="news-item" itemscope itemtype="http://schema.org/Article">
    <h2 itemprop="headline"><?php echo CHtml::encode($model->title); ?></h2>
    <div class="date" itemprop="dateCreated" content="<?= date('c', strtotime($model->created))?>">Размещено: <?= SHtml::toHumanDate($model->created)?></div>
    <?php if($products = $model->products):?>
        <div class="row">
            <div class="col-sm-8">
                <div itemprop="articleBody" class="text-justify">
                    <?= $model->text ?>
                </div>
            </div>

            <div class="col-sm-4 text-right">
                <h3 style="margin-top: 0; padding-top: 0; line-height: 36px;">Связанные товары</h3>
                <div class="row">
                <?php foreach($products as $product): ?>
                    <div class="col-xs-6 col-sm-12 col-md-12 col-lg-12 product <?= !$product->in_stock ? 'no-stock' : ''?>">
                        <div class="product-inner">
                            <?= CHtml::link($product->short_title, SHtml::productUrl($product), array('class'=>'h3')) ?>

                            <div class="block-content">
                                <div class="image">
                                    <?= PHtml::image($product, PHtml::IMAGE_CATEGORY) ?>
                                </div>

                                <?php if ($product->type == Products::TYPE_COMPOSITION)
                                    $this->renderPartial('//products/_view_composition', array('product' => $product));
                                else
                                    $this->renderPartial('//products/_view_simple', array('product' => $product)); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                </div>
            </div>
        </div>
    <?php else:?>
    <div class="row">
        <div class="col-lg-12">
            <div itemprop="articleBody" class="text-justify">
                <?= $model->text ?>
            </div>
        </div>
    </div>
    <?php endif;?>

    <meta itemprop="isFamilyFriendly" content="true">

    <div class="clear"></div>
</div>
