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
        <div class="col-lg-6">
            <?php echo $form->textField($model, 'title', array('class'=>'form-control','size' => 1, 'maxlength' => 120)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'type', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-6">
            <?php echo $form->dropDownList($model, 'type', Attachment::$types, array('class'=>'form-control','maxlength' => 10)); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
    </div>

    <div class="form-group image-uploader">
        <?php echo $form->labelEx($model, 'url', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
            $this->widget('backend.extensions.elFinder.ServerFileInput', array(
                    'model' => $model,
                    'attribute'=>'url',
                    'connectorRoute' => 'products/connector',
                    'settings' => array(
                        'showClearButton' => true
                    )
                )
            );
            ?>
            <?php echo $form->error($model, 'url'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->