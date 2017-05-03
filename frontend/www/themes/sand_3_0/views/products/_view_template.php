<?php if (isset($product) && !is_null($product)): ?>
    <?php $col =isset($col) ? $col : 4 ?>

    <div class="col-xs-6 col-md-<?= $col ?> col-lg-<?= $col ?> product <?= !$product->in_stock ? 'no-stock' : ''?>" itemtype="http://schema.org/Product" itemprop="itemListElement" itemscope>
        <div class="product-inner">
            <div class="block-content">
                <?php $this->renderPartial('//products/_labels', array('product' => $product)) ?>

                <div id="product-image_<?= $product->id ?>" class="image" data-image="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $product->image)?>">
                    <?//= PHtml::image($product, PHtml::IMAGE_CATEGORY) ?>
                    <a href="<?= PHtml::url($product)?>">
                        <?=
                        CHtml::image(
                            Yii::app()->imageApi->createUrl(PHtml::IMAGE_CATEGORY, Yii::app()->media->webroot . $product->image),
                            $data->title,
                            array('class'=>'img-responsive product-image', 'itemprop'=>'image'))
                        ?>
                    </a>
                </div>
                <?= CHtml::link($product->short_title, SHtml::productUrl($product), array('class'=>'h3', 'itemprop'=> 'name')) ?>
                <?php if ($product->type == Products::TYPE_COMPOSITION)
                    $this->renderPartial('//products/_view_composition', array('product' => $product));
                else
                    $this->renderPartial('//products/_view_simple', array('product' => $product)); ?>
            </div>
        </div>
        <meta itemprop="description " content="<?= !empty($product->meta_description) ? CHtml::encode($product->meta_description) : (CHtml::encode($product->title).' купить в Москве и Санкт-Петербурге') ?>">
    </div>
<?php endif; ?>