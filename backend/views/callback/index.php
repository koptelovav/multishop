<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */
?>

<script>
    $(function(){
        $('.change-status').change(function(){
            var self = $(this),
                optionValue =self.val(),
                optionId = self.data('id');
            $.ajax({
                type: 'POST',
                url: 'callback/setStatus',
                data: {id: optionId,status: optionValue},
                success: function(data){
                    if(data == 'ok'){
                    }
                }
            });
        });
    });
</script>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shipping-status-grid',
    'dataProvider' => $model->search(),
    'summaryText' => false,
    'columns' => array(
        array(
          'name' => 'date',
          'value' => 'SHtml::toHumanDate($data->date)'
        ),
        'name',
        'phone',
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => function($data){
                    return CHtml::dropDownList('status',$data->status,$data->statuses, array('data-id'=>$data->id,'class'=>'change-status'));
                }
        ),
    ),
)); ?>

