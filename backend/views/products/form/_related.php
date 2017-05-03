<div class="row">
    <div class="col-lg-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'product-related-grid',
            'dataProvider' => new CArrayDataProvider($model->related, array(
                'keyField' => 'id',
                'pagination'=>array(
                    'pageSize'=>100,
                ),

            )),
            'summaryText' => false,
            'htmlOptions'=>array(
                'class'=>'order-product-grid'
            ),
            'columns' => array(
                array(
                    'value'=>function($data){
                        return $data->title;
                    },
                    'footer'=>CHtml::dropDownList('product_id','',Products::getTree(),array(
                        'id'=>'product_related_id',
                        'data-product-id' => $model->id,
                        'style'=>'width:120px',
                        'empty'=>''
                    ))
                ),
                array(
                    'value'=>'$data->price',
                    'footer' => CHtml::link('+', $this->createUrl('addRelatedProduct') ,array('id'=>'add-product-related','class' => 'btn btn-primary btn-xs', 'name' => 'create'))
                ),
            ),
        )); ?>
    </div>
</div>