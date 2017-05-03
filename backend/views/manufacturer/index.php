<?php
/* @var $this ManufacturerController */
/* @var $model Manufacturer */
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'manufacturer-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'image',
            'filter' => false,
            'value' => function ($data) {
                    return CHtml::image($data->image, $data->name, array('class' => 'col-lg-2 img-responsive'));
                },
            'type' => 'html'
        ),
        'name',
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
