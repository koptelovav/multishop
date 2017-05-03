<?php foreach ($shippingVariants as $shipping): ?>
    <div class="row shipping-row">
        <div class="col-lg-5">
                <?php echo $shipping->name ?>
        </div>
        <div class="col-lg-3 text-right">
            <?php echo $shipping->times; ?>
        </div>
        <div class="col-lg-3 text-right price">
            <?php echo SHtml::toPrice($shipping->price); ?>
        </div>
    </div>
<?php endforeach; ?>