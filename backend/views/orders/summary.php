<?php
/* @var $this NewsController */
/* @var $model News */
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'summary-grid',
    'dataProvider' => $dataProvider,
    'summaryText' => false,
    'columns' => array(
        'id',
        'title::Товар',
        'count::Количество',
    ),
)); ?>

