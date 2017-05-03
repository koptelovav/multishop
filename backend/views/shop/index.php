<?php
/* @var $this ShopController */
/* @var $model Shop */
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shop-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'name',
            'value' => function ($data) {
                    if ($data->images->icon)
                        return CHtml::image(Yii::app()->media->baseUrl . $data->images->icon) . ' ' . $data->name;
                    else
                        return $data->name;
                },
            'type' => 'html'
        ),

        'domain',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update} {view} {delete}',

            'buttons' => array(
                'update' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-pencil'),
                ),
                'view' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'url' => function ($data) {
                            return 'http://' . $data->domain;
                        },
                    'options' => array('class' => 'glyphicon glyphicon-eye-open', 'target' => '_blank'),
                ),
                'delete' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-remove'),
                ),
            ),
            'htmlOptions' => array(
                'width' => '90px'
            )
        ),
    ),
)); ?>
