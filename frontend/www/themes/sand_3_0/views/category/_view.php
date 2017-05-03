<?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>new CArrayDataProvider($products, array(
            'sort'=>'sort',
            'pagination' => array(
                'pageSize' => Yii::app()->shop->productCount->category,
            ),
        )),
        'itemView'=>'//products/_view',
        'ajaxUpdate'=>false,
//        'summaryText' => 'Показано c {start} по {end} из {count} (Страница {page})',
        'template' => '{sorter}{items}{pager}',
        'itemsCssClass'=>'row products',
        'pager' => array(
            'firstPageLabel'=>'<<',
            'prevPageLabel'=>'Назад',
            'nextPageLabel'=>'Вперед',
            'lastPageLabel'=>'>>',
            'maxButtonCount'=>'10',
            'header'=>false,
            'cssFile'=>false,
        ),

    )); ?>
