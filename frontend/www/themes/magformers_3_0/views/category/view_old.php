<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->layout = '//layouts/common';
?>
<?php $this->widget('frontend.widgets.YandexDirectOfferWidget', ['data'=>'category']); ?>
<?php //if ($this->beginCache('catalog_'.$category->id.'_'.implode(array_map('implode',$categories)).Yii::app()->globalSettings->cache_version, array('duration' => 3600))) { ?>
<div id="columns">
    <?php foreach ($categories as $cid=>$categoryProducts):?>
        <?php if(count($categoryProducts)): ?>
            <div class="category" data-id="<?= $cid ?>">
                <h1 class="category-title"><?= Category::model()->findByPk($cid)->title ?></h1>
                <div class="row products">
                    <div class="items">
                        <?php foreach ($categoryProducts as $productId):?>
                            <?php $this->renderPartial('//products/_view',array('data'=>Products::model()->findByPk($productId)))?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach ?>
</div>
<div id="overflow"></div>
</div>
<?php //$this->endCache();} ?>
