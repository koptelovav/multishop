<?php
/* @var $this OrderCommentController */
/* @var $model OrderComment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-comment-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form-horizontal'
    )
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
        <div class="col-lg-9">
		    <?php echo $form->textArea($model,'text',array('id'=>'text-field','rows'=>3, 'class'=>'col-lg-12')); ?>
            <?php echo $form->hiddenField($model,'order_id',array('value'=>$order->id)); ?>
        </div>
        <div class="col-lg-3">
            <?php echo CHtml::ajaxSubmitButton(
                'Отправить',
                array('orderComment/create'),
                array(
                    'success'=>"function(data){
                        if(data == 'ok'){
                            $('#text-field').val('');
                            $.fn.yiiListView.update('order-comments');
                        }
                    }",
                ),
                array('class'=>'btn btn-primary btn-sm')); ?>
        </div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->