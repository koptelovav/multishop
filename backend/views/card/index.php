<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shipping-status-grid',
    'dataProvider' => $model->search(),
    'filter'=>$model,
    'summaryText' => false,
    'columns' => array(
        'number',
        'buyer',
        array(
            'name' => 'date_issue',
            'value' => 'SHtml::toHumanDate($data->date_issue)',
        ),

        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',

            'buttons' => array(
                'view' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-eye-open'),
                ),
            ),
            'htmlOptions' => array(
                'width' => '20px'
            )
        ),
    ),
)); ?>

