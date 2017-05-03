<?php
$sidebar = array(
    array('label' => 'Каталог', 'url' => array('products/index'))
);
foreach (Yii::app()->shop->categories as $category)
    if ($children = $category->children)
        foreach ($children as $subCategory)
            $sidebar[] = array('label' => $subCategory->short_title, 'url' => array('category/view','cid'=>$subCategory->id), 'linkOptions'=>array('class'=>$category->is_new ? 'is_new' : ''));
    else
        $sidebar[] = array('label' => $category->short_title, 'url' => array('category/view','cid'=>$category->id), 'linkOptions'=>array('class'=>$category->is_new ? 'is_new' : ''));

$sidebar[] =  array('label' => 'Акции', 'url' => array('products/sale'))
?>

<div id="sidebar">
    <div class="sidebar-header visible-xs">Категории</div>
    <?php $this->widget('zii.widgets.CMenu', array(
        'items' => $sidebar,
        'encodeLabel' => false,
        'htmlOptions' => array(
            'class' => 'nav nav-stacked',
        ),
    )); ?>
</div>