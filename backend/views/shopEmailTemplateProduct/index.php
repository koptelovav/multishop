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
        array(
            'name'=>'shop_id',
            'value'=> function($data){
                return $data->shop->name;
            }
        ),
        array(
            'name'=>'url',
            'value'=> function($data){
                return CHtml::link($data->url,$data->url, array('target'=>'_balnk'));
            },
            'type'=>'raw'
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
                'width' => '20px'
            )
        ),
    ),
)); ?>

