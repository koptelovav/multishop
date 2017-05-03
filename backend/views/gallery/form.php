<?php
/* @var $this BlockController */
/* @var $model Block */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'shipping-status-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal form-panel-submit'
        )
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'shop_id', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->dropDownList($model, 'shop_id', CHtml::listData(Shop::model()->findAll(), 'id', 'name'), array('empty' => '')); ?>
            <?php echo $form->error($model, 'shop_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'short_title', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'short_title', array('size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'short_title'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 60)); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'meta_description', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textArea($model, 'meta_description', array('class' => 'char-count', 'rows' => 6, 'cols' => 60)); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'meta_keywords', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textArea($model, 'meta_keywords', array('class' => 'char-count', 'rows' => 6, 'cols' => 60)); ?>
            <?php echo $form->error($model, 'meta_keywords'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->