
<div class="col-xs-12">
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <?php echo $this->renderPartial('info', array('product'=>$product));?>
    </div>
</div>

<div class="col-xs-12">
    <?php echo $this->renderPartial('features', array('product' => $product)); ?>
    <?php echo $this->renderPartial('_product_equipment', array('product'=>$product));?>
    <?php echo $this->renderPartial('_attachments', array('product' => $product)); ?>
</div>
