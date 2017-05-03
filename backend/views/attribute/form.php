<?php
/* @var $this AttributeController */
/* @var $model Attribute */
/* @var $attributeValue AttributeValue*/
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'shipping-status-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal form-panel-submit'
        )
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 60)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'show_on_preview', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->checkBox($model, 'show_on_preview'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'type', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->DropDownList($model, 'type', Attribute::$types); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
    </div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'sort', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'sort', array('size' => 2, 'maxlength' => 10)); ?>
            <?php echo $form->error($model, 'sort'); ?>
        </div>
    </div>

    <template id="attribute_value" data-current-index="10000">
        <div class="item-row">
            <hr>

            <div class="form-group">
                <?php echo $form->labelEx($attributeValue, 'value', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($attributeValue, 'value', array('size' => 60, 'maxlength' => 256, 'name'=>'AttributeValue[#index#][value]')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($attributeValue, 'mark_up', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($attributeValue, 'mark_up', array('size' => 4, 'maxlength' => 10, 'name'=>'AttributeValue[#index#][mark_up]')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($attributeValue, 'active', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->checkBox($attributeValue, 'active', array('name'=>'AttributeValue[#index#][active]')); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($attributeValue, 'sort', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($attributeValue, 'sort', array('size' => 2, 'maxlength' => 10, 'name'=>'AttributeValue[#index#][sort]')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-9">
                    <?php echo CHtml::linkButton('Удалить значение', array('class'=>'col-lg-offset-4', 'onclick'=>' $(this).parent().parent().parent().remove();return false;')); ?>
                </div>
            </div>
        </div>
    </template>

        <?php foreach($model->attribute_values as $item): ?>
            <div class="item-row">
                <hr>

                <?php echo $form->hiddenField($item, 'id', array('size' => 60, 'maxlength' => 256, 'name'=>'AttributeValue['.$item->id.'][id]')); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($item, 'label', array('class' => 'col-lg-3 control-label')); ?>
                    <div class="col-lg-9">
                        <?php echo $form->textField($item, 'label', array('size' => 60, 'maxlength' => 256, 'name'=>'AttributeValue['.$item->id.'][label]')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($item, 'value', array('class' => 'col-lg-3 control-label')); ?>
                    <div class="col-lg-9">
                        <?php echo $form->textField($item, 'value', array('size' => 60, 'maxlength' => 256, 'name'=>'AttributeValue['.$item->id.'][value]')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($item, 'mark_up', array('class' => 'col-lg-3 control-label')); ?>
                    <div class="col-lg-9">
                        <?php echo $form->textField($item, 'mark_up', array('size' => 4, 'maxlength' => 10, 'name'=>'AttributeValue['.$item->id.'][mark_up]')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($item, 'active', array('class' => 'col-lg-3 control-label')); ?>
                    <div class="col-lg-9">
                        <?php echo $form->checkBox($item, 'active', array('name'=>'AttributeValue['.$item->id.'][active]')); ?>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo $form->labelEx($item, 'sort', array('class' => 'col-lg-3 control-label')); ?>
                    <div class="col-lg-9">
                        <?php echo $form->textField($item, 'sort', array('size' => 2, 'maxlength' => 10, 'name'=>'AttributeValue['.$item->id.'][sort]')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-9">
                        <?php echo CHtml::linkButton('Удалить значение', array('class'=>'col-lg-offset-4', 'onclick'=>' $(this).parent().parent().parent().remove();return false;')); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <div id="attribute_value_container"></div>

    <div class="form-group">
        <div class="col-lg-9">
            <?php echo CHtml::linkButton('Добавить значение', array('class'=>'col-lg-offset-4 add-template-button','data-template'=>'attribute_value')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->