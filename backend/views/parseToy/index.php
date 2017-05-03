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

        <div class="form-group">
            <?= CHtml::label('URL','data_typer', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?= CHtml::dropDownList('data[typer]',$data['typer'],array(
                    'Категория',
                    'Товар'
                ));?>
            </div>
        </div>

        <div class="form-group">
            <?= CHtml::label('URL','data_url', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?= CHtml::textField('data[url]',$data['url']);?>
            </div>
        </div>

        <div class="form-group">
            <?= CHtml::label('Категория','data_category', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?= CHtml::dropDownList('data[category]',$data['category'], CHtml::listData(Category::model()->findAll(),'id','title'));?>
            </div>
        </div>

        <div class="form-group">
            <?= CHtml::label('Папка картинок','data_image_folder', array('class' => 'col-lg-3 control-label'));?>
            <div class="col-lg-9">
                <?= CHtml::textField('data[image_folder]',$data['image_folder']);?>
            </div>
        </div>

        <div class="form-group">
            <?= CHtml::submitButton('Парсить');?>
        </div>

        <?php $this->endWidget(); ?>
    </div>