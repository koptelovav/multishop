<?php
/* @var $this OrdersController */
/* @var $model Orders */
?>

<?php/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
console.log($.cookie('order-search-form'));
    if($.cookie('order-search-form') == 1){
    console.log('hide');
        $('.search-form').hide();
        $.cookie('order-search-form', '0');
    }else{
    console.log('show');
        $('.search-form').show();
        $.cookie('order-search-form', '1');
    }
	return false;
});

if($.cookie('order-search-form') == 1){
     $('.search-form').show();
}else{
   $('.search-form').hide();
}

$('.blank-button').click(function(){
	$('.blank-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('orders-grid', {
		data: $(this).serialize()
	});
	return false;
});

$('.change-status').change(function(){
    var self = $(this),
        optionValue =self.val(),
        optionId = self.data('id');
    $.ajax({
        type: 'POST',
        url: 'orders/setStatus',
        data: {id: optionId,status: optionValue},
        success: function(data){
            if(data == 'ok'){
            }
        }
    });
});

$('.fast-view').click(function(){
    var self = $(this),
        row = self.closest('tr'),
        rowId = row.attr('id'),
        info = $('#f'+rowId);

   if(info.length > 0){
        if(info.is(':visible'))
            info.hide();
        else
            info.show();
   }else{
       $.ajax({
            type: 'POST',
            url: 'orders/fastView',
            data: {id: rowId},
            success: function(data){
                row.after(data);
            }
       });
   }
});
");

?>

<div class="row">
    <div class="col-lg-4">
        <?php echo CHtml::link('Поиск заказа', '#', array('class' => 'search-button')); ?><br/>
    </div>
    <?php if(Yii::app()->user->checkAccess('backend.Callback.*')): ?>
        <div class="col-lg-4">
            <?php echo CHtml::link('Заказ звонка', array('callback/index'))?> (<?php echo Callback::newCallbackCount() ?>)
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->checkAccess('backend.Print.*')): ?>
        <div class="col-lg-4 ">
            <?php echo CHtml::link('Бланки', '#', array('class' => 'blank-button')); ?>
            <div class="blank-form" style="display: none">
                <?php echo CHtml::link('Курьер СПБ', Yii::app()->createUrl('orders/courierShippingRegister', $_GET))?><br/>
                <?php echo CHtml::link('Бланки заказов', Yii::app()->createUrl('print/allOrderDocuments', $_GET), array('target'=>'_blank'))?><br/>
                <?php echo CHtml::link('Списоок ПРФ', Yii::app()->createUrl('orders/getPRFList', $_GET))?><br/>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="search-form">
    <?php $this->renderPartial('_search', array(
        'order' => $model,
        'customer' =>  $model->customerData,
        'customerAddress' => $model->customerAddressData ,
    )); ?>
</div><!-- search-form -->

*/ ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'orders-grid',
    'dataProvider' => $dataProvider,
    'enableSorting' => false,
    'ajaxUpdate' => false,
    'summaryText'=>false,
    'rowHtmlOptionsExpression' => 'array("id"=>$data->id)',

    'columns' => array(
        array(
            'name' => 'id',
            'type' => 'raw',
            'value' => function($data){
                    echo $data->id.'<br/>';
                    foreach (OrderTag::getAllTagsByOrderId($data->id) as $tag){
                        echo '<i class="icon-'.$tag->img.'"></i>';
                    }
                    $open = CHtml::link('Открыть', array('orders/view','id'=> $data->id));
                    $call = CHtml::link('Позвонить', 'tel://'.$data->customer->phone);
                    $complete = CHtml::link('Обработан', '');
                    $box = CHtml::link('На сборку', '');
                    echo <<<EOF
<div class='order-menu'>
<ul>
<li>
{$open}
</li>
<li>
{$call}
</li>
<li>
{$complete}
</li>
<li>
{$box}
</li>
</ul>

</div>
EOF;

                    ;
                },
            'htmlOptions' => array(
                'width' => '20px'
            )
        ),
        array(
            'name' => 'date',
            'value' => function ($data) {
                    echo CHtml::link($data->customer->name, 'tel://'.$data->customer->phone, array(
                            'style'=>'text-decoration:none;color:#333'
                        )).'<br/><br/>'.SHtml::toHumanDate($data->date);
                    if($data->comment){
                        echo '<br/><br/><b>'.$data->comment.'</b>';
                    }
                }
        ),
        array(
            'name' => 'shipping_id',
            'value' => function ($data) {
                    echo $data->shipping->label;
                }
        ),
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => function ($data) {
                    $oStatus = $data->orderStatus;
                    echo '<span class="label label-'.$oStatus->label.'">'.$oStatus->name.'</span><br/>';
                    $opStatus = $data->paymentStatus;
                    echo '<span class="label label-'.$opStatus->label.'">'.$opStatus->name.'</span>';
                },
            'htmlOptions' => array(
                'width' => '30px'
            )
        ),
    ),
)); ?>
