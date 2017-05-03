<div class="row">
    <div class="col-lg-9">
        <div class="scroll-box">
            <?php echo CHtml::checkBoxList('Products[product_attributes]', CHtml::listData($model->product_attributes, 'id', 'id'), CHtml::listData(Attribute::model()->findAll(), 'id', 'name'), array()); ?>
        </div>
    </div>
</div>

<?php foreach (Filter::model()->findAll() as $filter):?>
    <h5><?= $filter->title ?></h5>
    <div class="row">
        <div class="col-lg-9">
            <div class="scroll-box">
                <?php echo CHtml::checkBoxList('ProductFilters['.$filter->id.']', CHtml::listData(ProductFilter::model()->findAllByAttributes(array('product_id'=>$model->id, 'filter_id'=>$filter->id)), 'value', 'value'), CHtml::listData($filter->values, 'id', 'value'), array()); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>