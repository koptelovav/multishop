<?php if($dataProvider->itemCount):?>
    <div class="block">
        <h3><?php echo $block->title?></h3>
        <div class="block-content">
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'enableSorting' => true,
                'emptyText' => 'В данной категории нет товаров',
                'itemView'=>'_view',
                'summaryText' => false,
                'itemsTagName'=>'ul',
                'itemsCssClass'=>'products products-block'
            )); ?>
        </div>
    </div>
<?php endif ?>