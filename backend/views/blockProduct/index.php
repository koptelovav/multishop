<?php
/* @var $this BlockProductController */
/* @var $model BlockProduct */
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'hit-sales-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name'=>'product_id',
            'value'=>function($data){
                return $data->product->short_title;
            }
        ),

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
