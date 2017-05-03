<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->layout = '//layouts/common';
?>
<?php $this->widget('frontend.widgets.YandexDirectOfferWidget', ['data'=>'category']); ?>
<?php //if ($this->beginCache('catalog_'.$category->id.'_'.implode(array_map('implode',$categories)).Yii::app()->globalSettings->cache_version, array('duration' => 3600))) { ?>
<div id="columns">
    <div id="category-list-view" itemtype="http://schema.org/ItemList" itemscope>
        <div class="category" data-id="sale">
            <h1 class="category-title">АКТУАЛЬНЫЕ СКИДКИ И АКЦИИ МАГФОРМЕРС</h1>
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>Yii::app()->shop->shop->getAllProductWithDiscount(),
                'itemView'=>'//products/_view',
                'ajaxUpdate' => true,
                'enableHistory'=>true,
                'enableSorting'=>true,
                'template' => '{sorter}{items}{pager}',
                'htmlOptions'=> array(
                    'class'=>'row products'
                ),
                'pager' => array(
                    'firstPageLabel'=>'<<',
                    'prevPageLabel'=>'Назад',
                    'nextPageLabel'=>'Вперед',
                    'lastPageLabel'=>'>>',
                    'maxButtonCount'=>'10',
                    'header'=>false,
                    'cssFile'=>false,
                ),

            )); ?>
        </div>

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
