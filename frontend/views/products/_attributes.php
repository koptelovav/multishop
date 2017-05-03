<?php
/* @var Products $product */
?>

<div class="form" id="attribute-container_<?= $product->id ?>">
    <?php foreach ($product->product_attributes as $attribute): ?>
        <div class="row form-group">
            <?php echo CHtml::label($attribute->title, 'attribute_' . $attribute->id, array('class' => 'col-xs-2 control-label')); ?>
            <div class="col-xs-10">
                <?php switch ($attribute->type) {
                    case Attribute::TYPE_DROP_DOWN:
                        echo CHtml::openTag('select', array('id' => 'attribute_' . $attribute->id, 'class' => 'product_attribute', 'data-id' => $attribute->id, 'data-product-id'=>$product->id));
                        foreach ($attribute->attribute_values as $value)
                            echo CHtml::tag('option', array('data-mark-up' => $value->mark_up, 'data-product-id'=>$product->id, 'value' => $value->id, 'selected'=>$value->sort == 0 ? 'selected' : ''), $value->value .($value->mark_up > 0 ?' (+'.SHtml::toPrice($value->mark_up).')' : ''));

                        echo CHtml::closeTag('select');
                        break;
                    case Attribute::TYPE_RADIO:
                        foreach ($attribute->attribute_values as $value)
                            echo CHtml::radioButton('attribute_' . $attribute->id, false, array('data-mark-up' => $value->mark_up, 'data-product-id'=>$product->id, 'data-id' => $attribute->id, 'class' => 'product_attribute', 'value' => $value->id)) . ' ' . $value->value . '<br>';
                        break;
                } ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
