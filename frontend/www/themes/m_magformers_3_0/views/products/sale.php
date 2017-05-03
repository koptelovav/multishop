<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Актуальные скидки и акции';
$this->firstTitle = $this->pageTitle;
$this->bannerUrl = Yii::app()->media->baseUrl.'/images/products/mymagformers_2_0/category_background/default.jpg';
?>


<div id="columns">
    <h1 class="category-title"><?= $this->pageTitle ?></h1>

    <div id="category-list-view" itemtype="http://schema.org/ItemList" itemscope>
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
    </div>
    <div id="overflow"></div>
</div>
