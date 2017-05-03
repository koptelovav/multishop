<?php
/* @var $this OrdersController */
/* @var $model Orders */
?>

<div class="row">
    <div class="col-lg-4">
        <?php echo CHtml::link('Бланки заказов', Yii::app()->createUrl('print/allOrderDocuments', array('picker'=>1)), array('target'=>'_blank'))?><br/>
    </div>
    <div class="col-lg-4">
        <?php echo CHtml::link('Почта | Оборот', "http://admin.blackbamboo.ru/orders/print?id=6360&type=prf2", array('target'=>'_blank'))?><br/>
    </div>

    <div class="col-lg-4">
        <?php echo CHtml::link('Главпункт | Накладная', Yii::app()->createUrl('orders/glavpunktRegister'), array('id'=>'greg' ,'target'=>'_blank'))?><br/>
    </div>


</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'orders-grid',
    'dataProvider' => $dataProvider,
    'ajaxUpdate' => true,
    'enableSorting' => false,
    'rowHtmlOptionsExpression' => 'array("id"=>$data->id)',

    'columns' => array(
        array(
            'name' => 'check',
            'id' => 'ordersIds',
            'value' => '$data->id',
            'class' => 'CCheckBoxColumn',
            'selectableRows' => '100',

        ),
        array(
            'name' => 'date',
            'value' => function ($data) {
                echo '<div style="font-weight:bold;">'.$data->id.'</div>';
                echo '<div style="font-size:12px;">'.SHtml::toHumanDate($data->update_payment_status ? $data->update_payment_status : $data->date).'</div>';
            }
        ),

        array(
            'name' => 'customer_id',
            'value' => function ($data) {
                    echo '<div style="font-weight:bold;">'.$data->customer->address->city.'</div>';
                    echo '<div style="font-size:12px;">'.$data->customer->name.'</div>';
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
            'class' => 'editable.EditableColumn',
            'name' => 'status',
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('orders/orderEditableServerUpdate', array('model'=>get_class($model))),
                'source' => array(
                    array ('value' => '13', 'text' => 'распечатан'),
                    array ('value' => '7', 'text' => 'сформирован')
                ),
            ),
            'filter' => CHtml::listData(OrderStatus::model()->findAll(), 'id', 'name'),
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->orderStatus->name;
                },
            'htmlOptions' => array(
                'width' => '100px'
            )
        ),
        array(
            'name' => 'payment_status',
            'filter' => CHtml::listData(OrderPaymentStatus::model()->findAll(), 'id', 'name'),
            'value' => function ($data) {
                    return $data->paymentStatus->name;
                },
            'htmlOptions' => array(
                'width' => '30px'
            )
        ),
        array(
            'name'=>'П',
            'value'=>'$data->priority'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{print}{view}',

            'buttons' => array(
                'print' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'url'=> function($data){
                        return Yii::app()->createUrl('print/allOrderDocuments', array('Orders[id]' => $data->id));
                    },
                    'options' => array('target'=>'_blank','class' => 'glyphicon glyphicon-print'),
                ),
                'view' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-eye-open'),
                ),
            ),
            'htmlOptions' => array(
                'width' => '90px'
            )
        ),

    ),
)); ?>
