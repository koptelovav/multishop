<div id="description-container">
    <?php foreach (Shop::model()->findAll() as $shop): ?>
        <?php echo $shop->name ?>

        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($productDescription, 'short_description', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo CHtml::textArea('ProductDescription[' . $shop->id . '][short_description]', isset($descriptions[$shop->id]) ? $descriptions[$shop->id]->short_description : '', array('rows' => 6, 'cols' => 60)); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($productDescription, 'description', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-9">
                <?php echo CHtml::textArea('ProductDescription[' . $shop->id . '][description]', isset($descriptions[$shop->id]) ? $descriptions[$shop->id]->description : '', array('rows' => 6, 'cols' => 60)); ?>
            </div>
        </div>
    <?php endforeach ?>
</div>