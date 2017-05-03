<div id="callback-area">
    <h2>Заказ звонка</h2>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'callback-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        )
    )); ?>

    <?php echo $form->errorSummary($callback); ?>

    <div class="form-group">
        <?php echo $form->labelEx($callback, 'name', array('class' => 'col-lg-4 control-label')); ?>
        <div class="col-lg-8">
            <?php echo $form->textField($callback, 'name', array('class' => 'col-lg-8','size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($callback, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($callback, 'phone', array('class' => 'col-lg-4 control-label')); ?>
        <div class="col-lg-8">
            <?php echo $form->textField($callback, 'phone', array('class' => 'col-lg-8','size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($callback, 'phone'); ?>
        </div>
    </div>

    <div class="form-group">
        <div style="margin-left: 20px">
            <?php echo CHtml::submitButton('Заказать', array('class'=>'col-lg-offset-4')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>