<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shipping-status-grid',
    'dataProvider' => $model->search(),
    'summaryText' => false,
    'columns' => array(
        'title',
        'value',
        array(
            'name'=>'date_range',
            'value' => function($data){
                return SHtml::toHumanDate($data->date_from). ' - '.SHtml::toHumanDate($data->date_to);
            }
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',

            'buttons' => array(
                'update' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-pencil'),
                ),
                'delete' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-remove'),
                ),
            ),
            'htmlOptions' => array(
                'width' => '70px'
            )
        ),
    ),
)); ?>

