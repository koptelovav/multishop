<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */

$this->pageTitle = $model->short_title;

$this->buttonCurrentTemplate = '{save} {return}';
Yii::app()->clientScript->registerScript('show-image', "
$('.show-image').click(function(){
    $('.image-uploader:hidden:first').show();
    return false;
});


", CClientScript::POS_READY)
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'products-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal form-panel-submit'
    )
)); ?>


<?php echo $form->errorSummary($model); ?>
    <ul class="nav nav-tabs nav-save">
        <li class="active"><a href="#tab-general" data-toggle="tab">Основные</a></li>
        <li><a href="#tab-data" data-toggle="tab">Данные</a></li>
        <li><a href="#tab-images" data-toggle="tab">Изображения</a></li>
        <li><a href="#tab-links" data-toggle="tab">Связи</a></li>
        <li><a href="#tab-attribute" data-toggle="tab">Атрибуты и Характеристики</a></li>
        <li><a href="#tab-include" data-toggle="tab">Вложеные</a></li>
        <li><a href="#tab-piece" data-toggle="tab">Детали(части)</a></li>
        <li><a href="#tab-related" data-toggle="tab">Сопутствующие</a></li>
        <li><a href="#tab-attachments" data-toggle="tab">Документы</a></li>
        <li><a href="#tab-discount" data-toggle="tab">Скидки</a></li>
        <li><a href="#tab-composition" data-toggle="tab">Композиция</a></li>
</ul>

    <div class="tab-content">



   <div class="tab-pane active" id="tab-general">
        <?php $this->renderPartial('form/_general', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-data">
        <?php $this->renderPartial('form/_data', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-images">
        <?php $this->renderPartial('form/_images', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-links">
        <?php $this->renderPartial('form/_links', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-attribute">
        <?php $this->renderPartial('form/_attribute', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-include">
        <?php $this->renderPartial('form/_include', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-piece">
        <?php $this->renderPartial('form/_piece', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-related">
        <?php $this->renderPartial('form/_related', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-attachments">
        <?php $this->renderPartial('form/_attachments', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-composition">
        <?php $this->renderPartial('form/_composition', array('form'=>$form,'model'=>$model)); ?>
    </div>

    <div class="tab-pane" id="tab-discount">
        <?php $this->renderPartial('form/_discount', array('form'=>$form,'model'=>$model)); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->