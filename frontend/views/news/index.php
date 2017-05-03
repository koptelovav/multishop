<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

?>

<div class="row">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'summaryText' => false,
        'itemsCssClass' => 'news'
    )); ?>
</div>


