<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'post-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal form-panel-submit'
        )
    )); ?>


    <?php echo $form->errorSummary($model); ?>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'short_title', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'short_title', array('size' => 60, 'maxlength' => 200)); ?>
                    <?php echo $form->error($model, 'short_title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 200)); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'preview_image', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                            'value' => $model->preview_image,
                            'name' => 'Piece[preview_image]',
                            'connectorRoute' => 'products/connector',
                            'settings' => array(
                                'showClearButton' => true
                            )
                        )
                    );
                    ?>
                    <?php echo $form->error($model, 'general_image'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'general_image', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                            'value' => $model->general_image,
                            'name' => 'Piece[general_image]',
                            'connectorRoute' => 'products/connector',
                            'settings' => array(
                                'showClearButton' => true
                            )
                        )
                    );
                    ?>
                    <?php echo $form->error($model, 'general_image'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-12">
                    <?php
                    $this->widget('backend.extensions.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'description',
                        // Optional config
                        'compressorRoute' => 'products/compressor',
                        //'spellcheckerUrl' => array('tinyMce/spellchecker'),
                        // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
                        'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
                        'fileManager' => array(
                            'class' => 'backend.extensions.elFinder.TinyMceElFinder',
                            'connectorRoute' => 'products/connector',
                        ),
                    ));
                    ?>
                </div>
            </div>
    <?php $this->endWidget(); ?>
</div>
