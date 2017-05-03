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
        <?php echo $form->labelEx($model, 'block_id', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->dropDownList($model, 'block_id', CHtml::listData(Block::model()->findAll(), 'id', 'title'), array('empty' => '')); ?>
            <?php echo $form->error($model, 'block_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'name', array('size' => 128, 'maxlength' => 256)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'image', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
            $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                    'value' => $model->image,
                    'name' => 'BlockVideo[image]',
                    'connectorRoute' => 'products/connector',
                    'settings' => array(
                        'showClearButton' => true
                    )
                )
            );
            ?>
            <?php echo $form->error($model, 'image'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'video_url', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'video_url', array('size' => 128, 'maxlength' => 256)); ?>
            <?php echo $form->error($model, 'video_url'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textArea($model, 'description', array('form-groups' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'description'); ?>
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