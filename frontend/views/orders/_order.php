<?php $this->widget('frontend.components.OrderGrid', array(
    'id' => 'view-cart',
    'itemsCssClass' => 'table table-hover',
    'dataProvider' => new CArrayDataProvider($products),
    'summaryText' => false,
    'template' => '{items}',
    'emptyText' => 'Вы не выбрали ни одного товара',
    'columns' => array(
        array(
            'type' => 'html',
            'name' => 'Название',
            'value' => function ($data) {
                return CHtml::link(
                    $data->short_title,
                    array('products/view', 'id' => $data->id),
                    array('class' => 'product-link')
                );
            }
        ),
        array(
            'name' => 'Количество',
            'type' => 'html',
            'value' => function ($data) {
                return Yii::app()->session['products'][$data->id];
            },
        ),

        array(
            'name' => 'Итогорвая цена',
            'value' => function ($data) {
                return Yii::app()->session['products'][$data->id] * $data->currentPrice . ' р.';
            },
        ),
    )
)); ?>