<section class="block block-color">
    <h4 class="block-title"><?php echo $block->title?></h4>
    <div class="block-content">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'enableSorting' => true,
            'emptyText' => 'В данной категории нет товаров',
            'itemView'=>'_view',
            'summaryText' => false,
            'itemsCssClass'=>'add-products'
        )); ?>
    </div>
</section>
