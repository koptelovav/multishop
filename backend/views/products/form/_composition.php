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

         var title = ui.item.title;

         if (title.indexOf(\"2.5\") >= 0)
            $('#product_composition_label').attr('value', 'набор с<br/>2.5 кг песка');
         else if (title.indexOf(\"2.27\") >= 0)
            $('#product_composition_label').attr('value', 'набор с<br/>2.27 кг песка');
         else if (title.indexOf(\"910\") >= 0)
            $('#product_composition_label').attr('value', 'набор с<br/>мерцающим песком');
         else if (title.indexOf(\"2кг\") >= 0)
            $('#product_composition_label').attr('value', 'набор с<br/>2 кг песка');
         else if (title.indexOf(\"3кг\") >= 0)
            $('#product_composition_label').attr('value', 'набор с<br/>3 кг песка');


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
        <?php echo CHtml::textField('product_composition_label', '', array('size'=>30   )); ?>
        <?php echo CHtml::link('+', Yii::app()->createUrl('products/addCompositionProduct') ,array('id'=>'add-product-composition','class' => 'btn btn-primary btn-xs', 'name' => 'create')); ?>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'product-composition-grid',
            'dataProvider' => new CArrayDataProvider($model->compositions, array(
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
                        return CHtml::link($data->product->title, array('products/update','id'=>$data->include_id));
                    },
                    'type'=>'raw'
                ),
                array(
                    'value'=>function($data){
                        return $data->label;
                    },
                )
            ),
        )); ?>
    </div>
</div>