<?php if($dataProvider->itemCount):?>
    <div class="block block-color">
        <h1 class="block-header">Сопутствующие товары</h1>
    </div>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'emptyText' => 'В данной категории нет товаров',
        'itemView'=>'_view',
        'summaryText' => false,
        'itemsTagName'=>'ul',
        'itemsCssClass'=>'products'
    )); ?>
<?php endif ?>