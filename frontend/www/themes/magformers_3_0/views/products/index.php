<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->layout = '//layouts/common';
?>
<div id="columns">
    <h1 class="category-title">ЗДЕСЬ НУЖНО ЧТО-ТО НАПИСАТЬ</h1>

    <div class="row products">
        <?php foreach(Category::model()->findByPk(32)->products(array('scopes'=>array('sort'))) as $key=>$product): ?>
            <?php $this->renderPartial('//products/_view', array('data'=>$product)) ?>
        <?php endforeach; ?>
    </div>
</div>
