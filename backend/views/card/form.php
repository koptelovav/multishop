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
        <?php echo $form->labelEx($model, 'number', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
            $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'number',
                'mask' => '999999',
                'placeholder' => '*',
                'htmlOptions' => array('size' => 6, 'maxlength' => 128)
            ));
            ?>
            <?php echo $form->error($model, 'number'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'buyer', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model,'buyer',array('size' => 45, 'maxlength' => 128))?>
            <?php echo $form->error($model, 'number'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'phone', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model,'phone',array('size' => 45, 'maxlength' => 128))?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model,'email',array('size' => 45, 'maxlength' => 128))?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'subscribe', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->checkBox($model,'subscribe',array('size' => 45, 'maxlength' => 128))?>
            <?php echo $form->error($model, 'subscribe'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->