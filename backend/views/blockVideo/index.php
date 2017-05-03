<?php
/* @var $this BlockProductController */
/* @var $model BlockProduct */
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'block-video',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name'=>'image',
            'type' => 'raw',
            'value'=>function($data){
                return CHtml::image($data->image);
            }
        ),
        'name',

        array(
            'name'=>'block_id',
            'value'=>function($data){
                return $data->block->title;
            }
        ),

        array(
            'class'=>'backend.extensions.SSortableBehavior.SSortableColumn',
        ),

        array(
            'class' => 'CButtonColumn',
            'template'=>'{delete}',

            'buttons'=>array (
                'delete'=>array(
                    'label'=>false,
                    'imageUrl'=>false,
                    'options'=>array( 'class'=>'glyphicon glyphicon-remove' ),
                ),
            ),
        ),
    ),
)); ?>
