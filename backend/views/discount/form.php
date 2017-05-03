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
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'label', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'label'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'value', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'value', array('size' => 5, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'value'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'date_from', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'date_from',
                    'language' => 'ru',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'size' => '10',         // textField size
                        'maxlength' => '10',    // textField maxlength
                    ),
                ));
            ?>
            <?php echo $form->error($model, 'date_from'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'date_to', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'date_to',
                'language' => 'ru',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                ),
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date_to'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php
            $this->widget('backend.extensions.tinymce.TinyMce', array(
                'model' => $model,
                'attribute' => 'description',
                'compressorRoute' => 'products/compressor',
                'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
                'fileManager' => array(
                    'class' => 'backend.extensions.elFinder.TinyMceElFinder',
                    'connectorRoute' => 'products/connector',
                ),
                'htmlOptions' => array(
                    'rows' => 6,
                    'cols' => 60,
                ),
            ));
            ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->