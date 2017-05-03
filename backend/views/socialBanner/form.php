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
            'class' => 'form-horizontal'
        )
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'image', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
            $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                    'model' => $model,
                    'attribute' => 'image',
                    'connectorRoute' => 'products/connector',
                )
            );
            ?>
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
        <?php echo $form->labelEx($model, 'text', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textArea($model, 'text', array('rows' => 10, 'cols' => 60)); ?>
            <?php echo $form->error($model, 'text'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->