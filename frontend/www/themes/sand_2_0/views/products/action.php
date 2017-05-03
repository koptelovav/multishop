<?php
$this->pageTitle = 'Скидки до 50%';
$this->layout = '//layouts/common';
$category = Category::model()->findByPk(90);
?>

    <div id="columns">
    <h1 class="category-title"><?= $category->title ?></h1>
<?php $this->widget('zii.widgets.CListView', array(
    'id'=>'category-list-view',
    'dataProvider'=>$dataProvider,
    'itemView'=>'//products/_view',
    'ajaxUpdate' => true,
    'enableHistory'=>true,
    'sorterHeader' => 'Сортировать по:',
    'sortableAttributes'=>array(
        'title',
        'sort',
        'price',
    ),
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