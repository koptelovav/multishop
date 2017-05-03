<div class="col-sm-12">

    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <?php echo $this->renderPartial('info', array('product'=>$product));?>
    </div>
    <?php $this->renderPartial('_attributes', array('product' => $product)); ?>
    <?php echo $this->renderPartial('_product_equipment', array('product'=>$product));?>
</div>

