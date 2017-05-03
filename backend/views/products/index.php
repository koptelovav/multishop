<?php
/* @var $this ProductsController */
/* @var $model Products */
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'products-grid',
    'dataProvider' => $dataProvider,
    'template'=>"{pager}\n{items}\n{pager}",
    'filter' => $model,
    'ajaxUpdate' => true,
    'rowCssClassExpression' =>function($row, $data) use ($parentId){
        return ($data->active ? null : " disabled"). (isset($parentId) ? "composition-product composition_product_".$parentId : null);
    },
    'columns' => array(
        array(
            'type'=>'raw',
            'value'=>function($data){
                return $data->compositions ? CHtml::tag('span',array('data-product-id'=>$data->id,'class'=>'get-composition','style'=>'font-size:25px; cursor:pointer'), '+') : '';
            },
            'htmlOptions' => array(
                'style'=>'text-align:center;width:50px',
            )

        ),
        array(
            'name' => 'image',
            'value' => function ($data) {
                    return CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $data->image), $data->short_title, array(
                        'height' => '50',
                    ));
                },
            'filter' => false,
            'type' => 'html',
            'htmlOptions' => array(
                'width' => '50',
            )
        ),
        'short_title',
        array(
            'name' => 'price',
            'value' => function ($data) {
                    return $data->currentPrice;
                },
            'type' => 'html'
        ),
        array(
            'name' => 'category',
            'filter' => CHtml::listData(Category::model()->findAll(), 'id', 'title'),
            'value' => function ($data) {
                    return Category::model()->findByPk($data->category)->title;
                },
        ),
        array(
            'class'=>'backend.extensions.SSortableBehavior.SSortableColumn',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{copy}',

            'buttons' => array(
                'update' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'options' => array('class' => 'glyphicon glyphicon-pencil'),
                ),
                'copy' => array(
                    'label' => false,
                    'imageUrl' => false,
                    'click'=>'function(){return confirm("Скопировать товар?");}',
                    'url'=> function($data){
                        return Yii::app()->createUrl('products/copy', array('id' => $data->id));
                    },
                    'options' => array('class' => 'glyphicon glyphicon-share'),
                ),
            ),
            'htmlOptions' => array(
                'width' => '100px'
            )
        ),
    ),
)); ?>
