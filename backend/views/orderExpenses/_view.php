<div class="well well-sm">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" data-update="order-expenses" data-href="<?php echo Yii::app()->createUrl('orderExpenses/delete',array('id'=>$data->id))?>">&times;</button>
    <?php echo date('d.m.Y H:i',strtotime($data->create_date)); ?> <b><?php echo CHtml::encode($data->amount); ?> рублей. <?php echo CHtml::encode($data->comment); ?></b>
</div>