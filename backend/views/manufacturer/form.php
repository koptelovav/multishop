<?php
/* @var $this ManufacturerController */
/* @var $model Manufacturer */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'manufacturer-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal form-panel-submit'
        )
    )); ?>


    <?php echo $form->errorSummary($model); ?>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'country', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'country', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($model, 'country'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'site', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'site', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($model, 'site'); ?>
        </div>
    </div>

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
            <?php echo $form->error($model, 'image'); ?>
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