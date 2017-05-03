<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */

?>

<table class="gtable bordered" id="products" style="font-size: 14px">
    <thead>
    <tr style="text-align: center">
        <td width="50">№</td>
        <td width="600">Наименование</td>
        <td width="200">Кол-во</td>
    </tr>
    </thead>
    <?php foreach (OrderProducts::model()->findAllByAttributes(array('order_id'=>$model->id)) as $key => $orderProduct): ?>
        <?php $product = $orderProduct->product; ?>
        <tr>
            <td style="text-align: center"><?php echo($key + 1) ?></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->title ?><br><span style="color:#fff;background: #000"><?= $orderProduct->attributes_string ?></span></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->count ?></td>
        </tr>
    <?php endforeach ?>
</table>