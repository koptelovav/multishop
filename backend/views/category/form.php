<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'category-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal form-panel-submit'
        )
    )); ?>
    <?php echo $form->errorSummary($model); ?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">Основные</a></li>
        <li><a href="#tab-data" data-toggle="tab">Данные</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tab-general">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'id', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'id', array('size' => 1, 'disabled' => true)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'shop_id', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->dropDownList($model, 'shop_id', CHtml::listData(Shop::model()->findAll(),'id','name')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'short_title', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'short_title', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($model, 'short_title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'second_title', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textArea($model, 'second_title', array('form-groups' => 3, 'cols' => 50)); ?>
                    <?php echo $form->error($model, 'second_title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'slug', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'slug', array('size' => 60, 'maxlength' => 60)); ?>
                    <?php echo $form->error($model, 'slug'); ?>
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
                <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
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
                        'htmlOptions' => array(
                            'rows' => 6,
                            'cols' => 60,
                        ),
                    ));
                    ?>
                    <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab-data">
            <div class="tab-pane" id="tab-links">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pid', array('class' => 'col-lg-3 control-label')); ?>
                    <div class="col-lg-9">
                        <?php echo $form->dropDownList($model, 'pid', CHtml::listData(Category::model()->findAll(), 'id', 'title'), array('empty' => '')); ?>
                        <?php echo $form->error($model, 'pid'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'icon', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                            'value' => $model->icon,
                            'name' => 'Category[icon]',
                            'connectorRoute' => 'products/connector',
                        )
                    );
                    ?>
                    <?php echo $form->error($model, 'icon'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'visible', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->checkBox($model, 'visible'); ?>
                    <?php echo $form->error($model, 'visible'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'static_page', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->dropDownList($model, 'static_page', $model->getStaticPages(), array('empty'=>'')); ?>
                    <?php echo $form->error($model, 'static_page'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'sort', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($model, 'sort', array('size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'sort'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>