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
        <div class="col-lg-2">
            <?php echo $form->textField($model,'amount',array('id'=>'amount-field', 'class'=>'col-lg-12', 'placeholder'=>'сумма')); ?>
        </div>
        <div class="col-lg-7">
		    <?php echo $form->textField($model,'comment',array('id'=>'comment-field','rows'=>3, 'class'=>'col-lg-12', 'placeholder'=>'комментарий')); ?>
            <?php echo $form->hiddenField($model,'order_id',array('value'=>$order->id)); ?>
        </div>
        <div class="col-lg-3">
            <?php echo CHtml::ajaxSubmitButton(
                'Отправить',
                array('orderExpenses/create'),
                array(
                    'success'=>"function(data){
                        if(data == 'ok'){
                            $('#amount-field').val('');
                            $('#comment-field').val('');
                            $.fn.yiiListView.update('order-expenses');
                        }
                    }",
                ),
                array('class'=>'btn btn-primary btn-sm')); ?>
        </div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->