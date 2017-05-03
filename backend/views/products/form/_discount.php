<div class="row">
    <div class="col-lg-9">
        <div class="scroll-box">
            <?php echo CHtml::checkBoxList('Products[discounts]', CHtml::listData($model->discount(), 'id', 'id'), CHtml::listData(Discount::model()->active()->findAll(), 'id', 'title'), array()); ?>
        </div>
    </div>
</div>