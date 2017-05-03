<?php
/* @var $this BlockProductController */
/* @var $model BlockProduct */

$this->buttonCurrentTemplate = '';
$this->addButton(array(
    'name' => 'price_list_print',
    'label' => 'Печатать',
    'route' => 'products/printPriceList',
    'options'=> array(
        'target' => '_blank'
    )
));

?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUpdate' => false,
    'columns' => array(
        array(
            'class'=>'CCheckBoxColumn',
            'selectableRows' => null,
            'checked' => function($data){
                return isset(Yii::app()->session['price_list'][$data->id]);
            },
            'checkBoxHtmlOptions'=>array(
                'class' => 'price-list-checkbox'
            )
        ),
        'short_title',
        'article',
        array(
            'type'=>'raw',
            'value' => function($data){
                return CHtml::textField('count_'.$data->id,
                    isset(Yii::app()->session['price_list'][$data->id]) ? Yii::app()->session['price_list'][$data->id] : ''
                    , array(
                        'class'=>'price-list-count',
                        'data-id'=>$data->id,
                        'size'=> 2,
                        'disabled'=>!isset(Yii::app()->session['price_list'][$data->id])));
            }
        ),
    ),
)); ?>
