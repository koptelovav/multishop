<?php
/* @var $this CategoryController */
/* @var $model Category */
?>
<form action ='/category'>
    <?= CHtml::dropDownList('shop_id',$shopId,CHtml::listData(Shop::model()->findAll(),'id','name'))?>
    <?= CHtml::submitButton('Выбрать', array('name'=>false))?>
</form>

<?php if(count($items)): ?>
    <?php $this->widget('zii.widgets.CMenu', array(
        'items' => $items,
        'activateParents'=>true,
        'linkLabelWrapper'=>'span',
        'encodeLabel'=>false,
        'htmlOptions'=>array(
            'class'=>'category-view'
        ),
        'submenuHtmlOptions' => array(
            'class' =>'subcategory-view',
        ),
    )); ?>
<?php endif ?>