<div class="row">
    <div class="col-lg-12">

        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'product_title',
            'source' => "js:function(request, response) {
      $.getJSON('" . Yii::app()->createUrl('products/suggest') . "', {
        term: request.term.split(/,\s*/).pop()
      }, response);
      }",
            'options' => array(
                'delay' => 300,
                'minLength' => 2,
                'showAnim' => 'fold',
                'multiple' => true,
                'select' => "js:function(event, ui) {
         this.value = ui.item.value ;
         $('#include_id').attr('value', ui.item.id);
         $('#product_count').attr('value', 1);
         $('#item-attributes').html(ui.item.attributes);


         return false;
       }",
            ),
            'htmlOptions' => array(
                'placeholder' => 'Товар',
                'size' => '30'
            ),
        ));
        ?>

        <?php echo CHtml::hiddenField('product_id', $model->id); ?>
        <?php echo CHtml::hiddenField('include_id', ''); ?>
        <?php echo CHtml::textField('product_count', '', array('placeholder' => 'Кол-во', 'size'=>2)); ?>
        <?php echo CHtml::link('+', Yii::app()->createUrl('products/addIncludeProduct') ,array('id'=>'add-include-product','class' => 'btn btn-primary btn-xs', 'name' => 'create')); ?>


        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'product-include-grid',
            'dataProvider' => new CArrayDataProvider($model->product_include, array(
                'keyField' => 'product_id',
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
                        return $data->product->title;
                    }
                ),

                array(
                    'value'=>function($data) use($model){
                        echo CHtml::textField('count', $data->count, array('class'=>'change_include_product_count','size'=>2, 'id'=>'count_'.$model->id, 'data-include-id'=>$data->include_id, 'data-product-id'=>$model->id, 'data-url'=>Yii::app()->createUrl('products/addIncludeProduct')));
                    },
                ),
                array(
                    'value'=>'$data->price',
                ),
            ),
        )); ?>

        <img class="img-responsive"
             src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot . $model->image) ?>"
             title="<?= $model->title ?>"/>
    </div>
</div>