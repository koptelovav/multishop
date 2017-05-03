<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Каталог';
?>

<div class="block block-color catalog">
    <div class="block-title">Наборы</div>
    <div class="block-content">
        <div class="row products">
        <?php foreach(Category::model()->findBypk(32)->products(array('scopes'=>array( 'sort' ))) as $key=>$product): ?>
            <?php $this->renderPartial('//products/_view', array('product'=>$product))?>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="block block-color elements">
    <div class="block-title">Детали</div>
    <div class="block-content">
        <div class="row products">
            <?php foreach(Category::model()->findBypk(37)->products(array('scopes'=>array( 'sort' ))) as $key=>$product): ?>
                <?php $this->renderPartial('//products/_view', array('product'=>$product))?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
