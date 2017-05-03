<?php
/* @var $this OrdersController */
/* @var $model Orders */
?>

<?php
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



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'orders-grid',
    'dataProvider' => $dataProvider,
    'filter'=>$model,
    'enableSorting' => false,
    'ajaxUpdate' => false,
    'rowHtmlOptionsExpression' => 'array("id"=>$data->id)',

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'headerTemplate'=>'',
            'checked' => function($data){
                return Yii::app()->checker->checkedByType('orders',$data->id);
            }
        ),
        array(
            'name' => 'id',
            'htmlOptions' => array(
                'width' => '20px'
            )
        ),
        array(
            'name' => 'date',
            'value' => 'SHtml::toHumanDate($data->date)'
        ),
        array(
            'name' => 'customer_id',
            'value' => function ($data) {
                    return $data->customer->name;
                }
        ),
        array(
            'name' => 'product',
            'value' => function ($data) {
                    foreach (OrderProducts::model()->findAllByAttributes(array('order_id'=>$data->id)) as $product) {
                        echo '<div class="order-product-title"><span class="pull-left">'.$product->product->short_title . '</span> <span class="pull-right">' . (($product->count > 1) ? $product->count : '').'</span></div><br/>';
                    }
                }
        ),

        array(
            'name' => 'shipping_id',
            'filter' => CHtml::listData(Shipping::model()->findAll(), 'id', 'name'),
            'value' => function ($data) {
                    echo $data->shipping->name;
                }
        ),
        array(
            'name' => 'total_price',
            'value'=> '$data->getTotal()',
            'htmlOptions' => array(
                'width' => '20px'
            )
        ),
        array(
            'name' => 'status',
            'type' => 'raw',
            'filter'=>CHtml::listData(OrderStatus::model()->findAll(),'id','name'),
            'value' => function ($data) {
                $oStatus = $data->orderStatus;
                echo '<span class="label label-'.$oStatus->label.'">'.$oStatus->name.'</span><br/>';
            },
            'htmlOptions' => array(
                'width' => '30px'
            )
        ),
        array(
            'name' => 'payment_status',
            'type' => 'raw',
            'filter'=>CHtml::listData(OrderPaymentStatus::model()->findAll(),'id','name'),
            'value' => function ($data) {
                $opStatus = $data->paymentStatus;
                echo '<span class="label label-'.$opStatus->label.'">'.$opStatus->name.'</span>';
            },
            'htmlOptions' => array(
                'width' => '30px'
            )
        ),
        array(
            'value' => function($data){
                 foreach (OrderTag::getAllTagsByOrderId($data->id) as $tag){
                     echo '<i class="icon-'.$tag->img.'"></i>';
                 }
            },
            'htmlOptions' => array(
                'class' => 'tag-view',
                'width' => '30px'
            )
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{fastView} {view} {print}',

            'buttons' => array(
                'fastView' => array(
                    'label'=> false,
                    'url'=> '',
                    'imageUrl'=> false,
                    'options' => array('class' => 'fast-view glyphicon glyphicon-eye-close'),
                ),

                'view' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-eye-open'),
                ),

                'print' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'url'=> function($data){
                        return Yii::app()->createUrl('print/allOrderDocuments', array('Orders[id]' => $data->id));
                    },
                    'options' => array('target'=>'_blank','class' => 'glyphicon glyphicon-print'),
                ),
               /* 'delete' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-remove'),
                ),*/
            ),
            'htmlOptions' => array(
                'width' => '90px'
            )
        ),
    ),
)); ?>
