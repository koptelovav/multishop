<?php if($dataProvider->itemCount):?>
    <div class="block block-color">
        <div class="block-title"><?php echo $block->title?></div>
        <div class="block-content">
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'enableSorting' => true,
                'emptyText' => 'В данной категории нет товаров',
                'itemView'=>$view,
                'summaryText' => false,
                'itemsTagName'=>'ul',
                'itemsCssClass'=>'products hit-sales'
            )); ?>
        </div>
    </div>
<?php endif ?>