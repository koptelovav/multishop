<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs = SHtml::getCategoryBreadcrumbs($category);
?>

<?php if ($this->beginCache('catalog_'.$category->id.'_'.Yii::app()->globalSettings->cache_version, array('duration' => 3600))) { ?>

<div class="section-catalog row">
    <div id="leftCol" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <?php $this->renderPartial('_sidebar'); ?>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9">
        <h2 class="category-title"><?= $category->title ?></h2>
        <?php $this->widget('zii.widgets.CListView', array(
            'id'=>'category-list-view',
            'dataProvider'=>$dataProvider,
            'itemView'=>'//products/_view',
            'ajaxUpdate' => true,
            'enableHistory'=>true,
            'enableSorting'=>true,
//        'summaryText' => 'Показано c {start} по {end} из {count} (Страница {page})',
            'template' => '{sorter}{items}{pager}',
            'itemsCssClass'=>'row products',
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

        <?php if(!empty($category->description)): ?>
            <h2>Полезная информация</h2>
            <div class="category-description">
                <?= $category->description ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->endCache();} ?>