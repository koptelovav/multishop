<?php
/* @var $this NewsController */
/* @var $model News */
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'post-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'image',
            'value' => function ($data) {
                    if ($data->image) {
                        return CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $data->image), $data->title, array(
                            'width' => '100',
                        ));
                    }
                    return CHtml::image(Yii::app()->media->baseUrl . '/img/no-photo.png', $data->title, array(
                        'width' => '100',
                    ));

                },
            'filter' => false,
            'type' => 'html',
            'htmlOptions' => array(
                'width' => '100',
            )
        ),
        'title',
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

