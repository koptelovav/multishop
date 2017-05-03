<div class="form-group">
    <?php echo $form->labelEx($model, 'id', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textField($model, 'id', array('style' => 'width:40px', 'disabled' => true)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'type', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->dropDownList($model, 'type',array(
            Products::TYPE_SIMPLE => 'простой',
            Products::TYPE_SET => 'комплект',
            Products::TYPE_PRODUCT_SET => 'набор',
            Products::TYPE_COMPOSITION => 'композиция',
        )); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'in_stock', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->checkBox($model, 'in_stock', array('style' => 'width:40px')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'category_visible', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->checkBox($model, 'category_visible', array('style' => 'width:40px')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'active', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->checkBox($model, 'active', array('style' => 'width:40px')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'price', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textField($model, 'price', array('size' => 10, 'maxlength' => 10)); ?> (<?php echo $model->currentPrice ?>)
        <?php echo $form->error($model, 'price'); ?>
    </div>
</div>


<?php foreach (Feature::model()->findAll() as $feature): ?>
    <div class="form-group">
        <?= CHtml::label( $feature->title,'ProductFeature_'.$feature->id.'_value', array('class' => 'col-lg-3 control-label'))?>
        <div class="col-lg-9">
            <?php echo $form->textField(ProductFeature::model(), '['.$feature->id.']value', array('size' => 20,'value'=>$model->{$feature->name})); ?>
            <?php echo $form->error(ProductFeature::model(), '['.$feature->id.']value'); ?>
        </div>
    </div>
<?php endforeach; ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'sort', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textField($model, 'sort', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'sort'); ?>
    </div>
</div>