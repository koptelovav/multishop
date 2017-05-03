<?php /*if($productAttributes = $product->product_attributes):?>
    <div class="attributes hidden-xs">
        <div class="form" id="attribute-container_<?= $product->id ?>">
            <?php foreach ($productAttributes as $attribute): ?>
                <?php if($attribute->show_on_preview):?>
                    <div class="row form-group">
                        <?php echo CHtml::label($attribute->title, 'attribute_' . $attribute->id, array('class' => 'col-xs-4 control-label')); ?>
                        <div class="col-xs-8    ">
                            <?php switch ($attribute->type) {
                                case Attribute::TYPE_DROP_DOWN:
                                    echo CHtml::openTag('select', array('id' => 'attribute_' . $attribute->id, 'class' => 'product_attribute', 'data-id' => $attribute->id, 'data-product-id'=>$product->id));
                                    foreach ($attribute->attribute_values as $value)
                                        echo CHtml::tag('option', array('data-mark-up' => $value->mark_up, 'data-product-id'=>$product->id, 'value' => $value->id, 'selected'=>$value->sort == 0 ? 'selected' : ''), $value->value .($value->mark_up > 0 ?' (+'.SHtml::toPrice($value->mark_up).')' : ''));

                                    echo CHtml::closeTag('select');
                                    break;
                            } ?>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif */?>

<div class="product-info">
    <div class="product-price text-left">
        <?= PHtml::price($product) ?>
    </div>
    <?php /*if($productAttributes = $product->product_attributes):?>
        <div class="text-right visible-xs">
            <?= PHtml::readMore($product) ?>
        </div>
        <div class="text-right hidden-xs">
            <?= Cart::buyButton($product, ' В корзину', 'btn') ?>
        </div>
    <?php else: */?>
        <div class="text-right">
            <?= Cart::buyButton($product, ' В корзину', 'btn') ?>
        </div>
    <?php /*endif */?>
</div>