<div class="row" itemtype="http://schema.org/ItemList" itemscope>
    <?php if($dataProvider->itemCount):?>
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'enableSorting' => true,
            'emptyText' => 'В данной категории нет товаров',
            'itemView'=>'_view',
            'summaryText' => false,
            'itemsCssClass'=>'row products',
        )); ?>
    <?php endif ?>
</div>
