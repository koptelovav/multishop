<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-comment-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form-horizontal'
    )
)); ?>


<div class="form-group">
        <div id="alert-sms-success" class="alert alert-success" style="display: none">Смс отправлено</div>
         <div id="alert-sms-error" class="alert alert-danger" style="display: none">Ошибка отправки смс</div>
    <div class="col-lg-9">
        <?php echo CHtml::textArea('text','',array('id'=>'text-field-sms','rows'=>3, 'class'=>'col-lg-12')); ?>
        <?php echo CHtml::hiddenField('order_id',$order->id); ?>
    </div>
    <div class="col-lg-3">
        <?php echo CHtml::ajaxSubmitButton(
            'Отправить',
            array('orders/sendSms'),
            array(
                'success'=>"function(data){
                        if(data == 'ok'){
                            $('#text-field-sms').val();
                            $('#alert-sms-success').show();
                        }else{
                              $('#alert-sms-error').show();
                        }
                    }",
            ),
            array('class'=>'btn btn-primary btn-sm')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>