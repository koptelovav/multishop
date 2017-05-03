<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'class' => 'form-horizontal'
    )
)); ?>


    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <?= Yii::t('core', 'User'); ?>
            <div class="control pull-right">
                <?= CHtml::submitButton(Yii::t('core','Save'), array('class'=>'btn btn-success btn-xs', 'name'=>'save'));?>
                <?= CHtml::submitButton(Yii::t('core','Apply'), array('class'=>'btn btn-primary btn-xs', 'name'=>'apply'));?>
                <?= CHtml::link(Yii::t('core','Return'), $this->createUrl('index'), array('class'=>'btn btn-primary btn-xs'));?>
            </div>
        </div>
        <div class="panel-body">
            <?php echo $form->errorSummary($model); ?>

                <div class="form-group">
                    <?= $form->labelEx($model,'login', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'login',array('size'=>60,'maxlength'=>128)); ?>
                        <?= $form->error($model,'login'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'password', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
                        <?= $form->error($model,'password'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'email', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
                        <?= $form->error($model,'email'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'autologin', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'autologin',array('size'=>60,'maxlength'=>128)); ?>
                        <?= $form->error($model,'autologin'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'registration_date', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'registration_date'); ?>
                        <?= $form->error($model,'registration_date'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'last_login', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'last_login'); ?>
                        <?= $form->error($model,'last_login'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'active', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'active',array('size'=>6,'maxlength'=>6)); ?>
                        <?= $form->error($model,'active'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'track', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'track',array('size'=>10,'maxlength'=>10)); ?>
                        <?= $form->error($model,'track'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'partner', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'partner',array('size'=>10,'maxlength'=>10)); ?>
                        <?= $form->error($model,'partner'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= $form->labelEx($model,'email_verified', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->textField($model,'email_verified'); ?>
                        <?= $form->error($model,'email_verified'); ?>
                    </div>
                </div>

                    </div>
    </div>
        <?php $this->endWidget(); ?>

</div><!-- form -->