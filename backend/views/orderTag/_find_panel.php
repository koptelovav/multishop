<?php
Yii::app()->clientScript->registerScript('search-tag', "
$('.search-tag-button').click(function(){
	$('.search-tag').toggle();
	return false;
});
$('.search-tag form').submit(function(){
	$.fn.yiiGridView.update('orders-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Поиск по тэгам', '#', array('class' => 'search-tag-button')); ?>

<div class="search-tag" style="display: none">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'orders-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            "class" => "form-horizontal simple-text"
        )
    )); ?>
    <div id="find-order-by-tag">
        <?php foreach (OrderTag::model()->findAll() as $tag): ?>
            <input type="checkbox" name="Orders[tags][]" id="tag_<?php echo $tag->id?>" value="<?php echo $tag->id?>"/>
            <label for="tag_<?php echo $tag->id?>">
                <i class="icon-<?php echo $tag->img?>"> <?php echo $tag->label?></i>
            </label>
            <br />
        <?php endforeach?>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-1">
            <?php echo CHtml::submitButton('Искать',array('class'=>'btn btn-primary btn-sm'))?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>