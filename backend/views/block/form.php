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
        <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'identifier', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'identifier', array('size' => 60, 'maxlength' => 60, 'disabled' => !$model->isNewRecord)); ?>
            <?php echo $form->error($model, 'identifier'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'product_count', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'product_count', array('size' => 10, 'maxlength' => 10)); ?>
            <?php echo $form->error($model, 'product_count'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->