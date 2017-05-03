<div class="form-group">
    <?php echo $form->labelEx($model, 'manufacturer_id', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->dropDownList($model, 'manufacturer_id', CHtml::listData(Manufacturer::model()->findAll(), 'id', 'name'), array('empty' => '')); ?>
        <?php echo $form->error($model, 'manufacturer_id'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'shop', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->dropDownList($model, 'shop', CHtml::listData(Shop::model()->findAll(), 'id', 'name'), array('empty' => '')); ?>
        <?php echo $form->error($model, 'shop'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo CHtml::label('Магазины', '', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <div class="scroll-box">
            <?php echo CHtml::checkBoxList('Products[shops]', CHtml::listData($model->shops, 'id', 'id'), CHtml::listData(Shop::model()->findAll(), 'id', 'name'), array()); ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'category', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->dropDownList($model, 'category', CHtml::listData(Category::model()->findAll(), 'id', 'title'), array('empty' => '')); ?>
        <?php echo $form->error($model, 'category'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo CHtml::label('Категории', '', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <div class="scroll-box">
            <?php echo CHtml::checkBoxList('Products[categories]', CHtml::listData($model->categories, 'id', 'id'), CHtml::listData(Category::model()->findAll(), 'id', 'title'), array()); ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?php echo CHtml::label('Новости', '', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <div class="scroll-box">
            <?php echo CHtml::checkBoxList('Products[news]', CHtml::listData($model->news, 'id', 'id'), CHtml::listData(News::model()->findAll(), 'id', 'title'), array()); ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?php echo CHtml::label('Сопутствующие товары', '', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <div class="scroll-box">
            <?php echo CHtml::checkBoxList('Products[related]', CHtml::listData($model->related, 'id', 'id'), CHtml::listData($model->potentialRelatedProduct, 'id', 'short_title'), array()); ?>
        </div>
    </div>
</div>