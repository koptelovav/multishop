<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl.'/css/invoice.css' ?>"/>

    <div id="menu">
        <a href="#" onclick="window.print(); return false;">
            Печатать</a>
        <a href="<?php echo $this->createUrl('invoice',array('id'=>$order->id,'download'=>1));?>">
            Сохранить
        </a>
    </div>

<?php
$this->renderPartial('/orders/invoice/_view',array(
    'order'=>$order
));