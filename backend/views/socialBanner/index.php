<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shipping-status-grid',
    'dataProvider' => $model->search(),
    'summaryText' => false,
    'columns' => array(
        'image',
        'title',
        'text',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}',

            'buttons' => array(
                'update' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-pencil'),
                ),
            ),
            'htmlOptions' => array(
                'width' => '20px'
            )
        ),
    ),
)); ?>

