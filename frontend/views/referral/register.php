<div class="col-lg-offset-3">
<h1>Регистрация реферала</h1>
</div>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'referral-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        "class" => "form-horizontal simple-text"
    )
)); ?>

<?php echo $form->errorSummary(array($referral)); ?>
    <fieldset>
        <div class="form-group">
            <?php echo $form->labelEx($referral, 'name', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->textField($referral, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($referral, 'email', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->textField($referral, 'email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 64)); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($referral, 'password', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-5">
                <?php echo $form->passwordField($referral, 'password', array('class' => 'form-control', 'size' => 60, 'maxlength' => 64)); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <button type="submit" class="btn btn-danger btn-lg" href="<?= Yii::app()->createUrl('orders/create') ?>">
                    Регистрация &rarr;
                </button>
            </div>
        </div>
    </fieldset>
<?php $this->endWidget(); ?>