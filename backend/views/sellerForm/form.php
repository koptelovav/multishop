<?php
/* @var $this BlockController */
/* @var $model Block */
/* @var $form CActiveForm */

$this->pageTitle = 'Бланк кассира от '.date('d.m.Y');
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
        <?php echo $form->labelEx($model, 'user_id', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->dropDownList($model, 'user_id', CHtml::listData(User::model()->findAll(), 'id','name') ,array('options' => array(Yii::app()->user->id=>array('selected'=>true)))); ?>
            <?php echo $form->error($model, 'user_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'start_sum', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'start_sum', array('size' => 20, 'maxlength' => 60, 'disabled' => !$model->isNewRecord)); ?>
            <?php echo $form->error($model, 'start_sum'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
            <?php echo CHtml::submitButton('Начать смену', array('class'=>'btn btn-primary'));?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->