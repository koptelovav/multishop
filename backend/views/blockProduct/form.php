<?php
/* @var $this BlockProductController */
/* @var $model BlockProduct */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'hit-sales-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal form-panel-submit'
        )
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'product_id', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->dropDownList($model, 'product_id', CHtml::listData(Products::model()->findAll(), 'id', 'short_title'), array('empty' => '')); ?>
            <?php echo $form->error($model, 'product_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'block_id', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->dropDownList($model, 'block_id', CHtml::listData(Block::model()->findAll(), 'id', 'title'), array('empty' => '')); ?>
            <?php echo $form->error($model, 'block_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'sort', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'sort', array('size' => 10, 'maxlength' => 10)); ?>
            <?php echo $form->error($model, 'sort'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>
<!-- form -->