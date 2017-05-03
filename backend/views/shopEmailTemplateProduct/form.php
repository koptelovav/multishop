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
            <?php echo $form->dropDownList($model, 'shop_id', Chtml::listData(Shop::model()->findAll(), 'id', 'name')); ?>
            <?php echo $form->error($model, 'shop_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 256)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'url', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 256)); ?>
            <?php echo $form->error($model, 'url'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'image', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
            $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                    'value' => $model->image,
                    'name' => 'ShopEmailTemplateProduct[image]',
                    'connectorRoute' => 'products/connector',
                )
            );
            ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textArea($model, 'description', array('cols' => 60, 'rows' => 5)); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->