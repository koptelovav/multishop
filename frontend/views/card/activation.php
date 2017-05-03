<?php
$this->pageTitle = 'Активация новой карты'
?>

<?php
/* @var $this CardController */
/* @var $model CardUser */
/* @var $form CActiveForm */
?>

    <h1><?php echo $this->pageTitle ?></h1>

<?php if (Yii::app()->user->hasFlash('fail')): ?>
    <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('fail'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php else: ?>
    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'card-user-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal'
            )
        )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'card_id', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'card_id',
                    'mask' => '999999',
                    'placeholder' => '*',
                    'htmlOptions' => array('size' => 6, 'maxlength' => 128)
                ));
                ?>
                <?php echo $form->error($model, 'card_id'); ?>
                <div class="hint">
                    6-значный номер на лицевой стороне карты
                </div>
            </div>

        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'lastname', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo $form->textField($model, 'lastname', array('size' => 60, 'maxlength' => 128)); ?>
                <?php echo $form->error($model, 'lastname'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'firstname', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo $form->textField($model, 'firstname', array('size' => 60, 'maxlength' => 128)); ?>
                <?php echo $form->error($model, 'firstname'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'patronymic', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo $form->textField($model, 'patronymic', array('size' => 60, 'maxlength' => 128)); ?>
                <?php echo $form->error($model, 'patronymic'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'phone', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'phone',
                    'mask' => '+7-999-999-9999',
                    'placeholder' => '*',
                    'htmlOptions' => array('size' => 60, 'maxlength' => 128)
                ));
                ?>
                <?php echo $form->error($model, 'phone'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'email', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
                <?php echo $form->error($model, 'email'); ?>
                <div class="hint">
                    E-mail для входа в личный кабинет
                </div>
            </div>

        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'password', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo $form->passwordField($model, 'password', array('size' => 32, 'maxlength' => 32)); ?>
                <?php echo $form->error($model, 'password'); ?>
                <div class="hint">
                    Пароль для входа в личный кабинет
                </div>
            </div>

        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'subscribe', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo $form->checkBox($model, 'subscribe'); ?>
                <?php echo $form->error($model, 'subscribe'); ?>
                <div class="hint">
                    Согласие на получение уведомлений об акциях и спецпредложениях и купонов на скидку.<br/>
                    Рассылка будет производиться не чаще двух раз в месяц и только с Вашего согласия.
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                <?php echo CHtml::submitButton('Активировать', array(
                    'class' => 'btn btn-primary'
                )); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
<?php endif; ?>