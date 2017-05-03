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

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">Основные</a></li>
        <li><a href="#tab-text" data-toggle="tab">Текст</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tab-general">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 200)); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'meta_description', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textArea($model, 'meta_description', array('form-groups' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($model, 'meta_description'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'meta_keywords', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textArea($model, 'meta_keywords', array('form-groups' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($model, 'meta_keywords'); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'image', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                            'value' => $model->image,
                            'name' => 'News[image]',
                            'connectorRoute' => 'products/connector',
                            'settings' => array(
                                'showClearButton' => true
                            )
                        )
                    );
                    ?>
                    <?php echo $form->error($model, 'image'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo CHtml::label('Магазины', '', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <div class="scroll-box">
                        <?php echo CHtml::checkBoxList('Products[shops]', CHtml::listData($model->shops, 'id', 'id'), CHtml::listData(Shop::model()->findAll(), 'id', 'name'), array()); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab-text">
            <div class="form-group">
                <div class="col-lg-12">
                    <?php
                    $this->widget('backend.extensions.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'short_text',
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

            <div class="form-group">
                <div class="col-lg-12">
                    <?php
                    $this->widget('backend.extensions.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text',
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
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>
