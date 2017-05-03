<?php
/* @var Products $product */
?>
<div id="attribute-container">
    <?php foreach ($product->product_attributes as $attribute): ?>
        <div class="form-group">
            <?php echo CHtml::label($attribute->title, 'attribute_' . $attribute->id, array('class' => 'col-xs-2 control-label')); ?>
            <div class="col-xs-10">
                <?php switch ($attribute->type) {
                    case Attribute::TYPE_DROP_DOWN:
                        echo CHtml::openTag('select', array('id' => 'attribute_' . $attribute->id, 'class' => 'product_attribute', 'data-id' => $attribute->id));
                        echo CHtml::tag('option', array('data-mark-up' => 0), '');
                        foreach ($attribute->attribute_values as $value)
                            echo CHtml::tag('option', array('data-mark-up' => $value->mark_up, 'value' => $value->id), $value->value);

                        echo CHtml::closeTag('select');
                        break;
                    case Attribute::TYPE_RADIO:
                        foreach ($attribute->attribute_values as $value)
                            echo CHtml::radioButton('attribute_' . $attribute->id, false, array('data-mark-up' => $value->mark_up, 'data-id' => $attribute->id, 'class' => 'product_attribute', 'value' => $value->id)) . ' ' . $value->value . '<br>';
                        break;
                } ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>