<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Скидки на кинетический песок';
$this->breadcrumbs[] = $this->pageTitle;
?>

<?php if ($this->beginCache('catalog_sale_'.Yii::app()->globalSettings->cache_version, array('duration' => 3600))) { ?>

<div class="section-catalog row">
    <div id="leftCol" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <?php $this->renderPartial('//category/_sidebar'); ?>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9">
        <h2 class="category-title"><?= $category->title ?></h2>
        <p></p>

        <?php $this->widget('zii.widgets.CListView', array(
            'id'=>'category-list-view',
            'dataProvider'=>$dataProvider,
            'itemView'=>'//products/_view',
            'ajaxUpdate' => true,
            'enableHistory'=>true,
            'enableSorting'=>true,
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
        <h2>Актуальные акции и спецпредложения</h2>
        <?php $this->renderPartial('action') ?>
    </div>
</div>

<?php $this->endCache();} ?>