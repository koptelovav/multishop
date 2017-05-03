<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-comment-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form-horizontal'
    )
));

?>


<div class="form-group">
    <div class="col-lg-12">
        <?php echo CHtml::textArea('text','',array('id'=>'text-field-mail','rows'=>10, 'class'=>'col-lg-12')); ?>
        <?php echo nl2br(Yii::app()->user->model->signature) ?>
        <?php echo CHtml::hiddenField('order_id',$order->id); ?>
    </div>
    <div class="col-lg-12">
        <?php echo CHtml::ajaxSubmitButton(
            'Отправить',
            array('orders/sendMail'),
            array(
                'success'=>"function(data){
                        if(data == 'ok'){
                         $('#text-field-mail').val();
                        }
                    }",
            ),
            array('class'=>'btn btn-primary btn-sm')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>