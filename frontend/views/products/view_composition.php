

<div class="product-inner">
    <div class="block-content">
        <div class="product-offers" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
            <?php $aggregateOfferData = $product->aggregateOfferData() ?>
            <div class="row">
                <?php foreach($product->compositions as $compositionProduct): ?>
                    <?php $item = $compositionProduct->product ?>
                    <div class="offer" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <div class="col-xs-12">
                            <span class="h4" itemprop="itemOffered"><?php echo $item->title ?></span>
                            <div class="price product-price">
                                <?= PHtml::price($item) ?>
                                <meta itemprop="price" content="<?= PHtml::metaPrice($item) ?>">
                                <meta itemprop="priceCurrency" content="RUB">
                                <link itemprop="availability" href="<?= $item->in_stock ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock' ?>">
                                <?= CHtml::link('Выбрать', '', array('class'=>'more buy btn', 'data-show-equipment'=>'#equipment_'.$item->id))?>
                            </div>
                            <div class="product-equipment" id="equipment_<?= $item->id ?>">
                                <?= $this->renderPartial('_product_equipment', array('product'=>$item ));?>
                                <?php $this->renderPartial('_attributes', array('product' => $item)); ?>
                                <?php echo Cart::buyButton($item, 'добавить в корзину', 'btn') ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <i class="gray">
                Цена на <?= $product->title ?>: от <span itemprop="lowPrice"> <?= SHtml::toPrice($aggregateOfferData['lowPrice']) ?></span>
                до <span itemprop="highPrice"> <?= SHtml::toPrice($aggregateOfferData['highPrice']) ?></span>,
                всего <span itemprop="offerCount"> <?= $aggregateOfferData['offerCount'] ?></span> <?= SHtml::morph($aggregateOfferData['offerCount'],'предлжение','предлжения','предлжений')?>
                <meta itemprop="priceCurrency" content="RUB">
            </i>
        </div>
    </div>
</div>