<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */

?>

<table class="gtable">
    <tr>
        <td style="font-weight: bold; text-align: center">ИП Коптелов АВ Санкт-Петербург пр. Испытателей 20 ИНН
            424623808213 8 (812) 981-72-62
        </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td style="text-align: center">ТОВАРНЫЙ ЧЕК № <?php echo $model->id ?> от <?php echo date('d.m.Y', strtotime($model->update_payment_status ? $model->update_payment_status : $model->date))?> г.
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<table class="gtable bordered" id="products">
    <thead>
    <tr style="text-align: center">
        <td width="50">№</td>
        <td width="450">Наименование</td>
        <td width="200">Каталожный номер</td>
        <td width="200">Кол-во</td>
        <td width="200">Цена</td>
        <td width="250">Сумма</td>
    </tr>
    </thead>
    <?php $productTotalPrice = 0 ?>
    <?php foreach (OrderProducts::model()->findAllByAttributes(array('order_id'=>$model->id)) as $key => $orderProduct): ?>
        <?php
        $product = $orderProduct->product;
        $productTotalPrice += $orderProduct->price * $orderProduct->count;
        ?>
        <tr>
            <td style="text-align: center"><?php echo($key + 1) ?></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->title ?></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->product_id ?></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->count ?></td>
            <td style="padding-left: 10px"><?php echo SHtml::toCashPrice($orderProduct->getPrice()) ?></td>
            <td style="padding-left: 10px"><?php echo  SHtml::toCashPrice($orderProduct->getPrice() * $orderProduct->count) ?></td>
        </tr>
    <?php endforeach ?>
    <?php if($model->shipping_price > 0):?>
    <tr>
        <td style="text-align: center"><?php echo($key + 2) ?></td>
        <td style="padding-left: 10px">Доставка</td>
        <td style="padding-left: 10px">2</td>
        <td style="padding-left: 10px">1</td>
        <td style="padding-left: 10px"><?php echo  SHtml::toCashPrice($model->shipping_price) ?></td>
        <td style="padding-left: 10px"><?php echo  SHtml::toCashPrice($model->shipping_price) ?></td>
    </tr>
    <?php endif ?>
    <tr>
        <td colspan="5" style="text-align: right;padding-right: 10px">ИТОГО:</td>
        <td style="padding-left: 10px"><?php echo  SHtml::toCashPrice($model->getTotal()) ?></td>
    </tr>
</table>

<table class="gtable">
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Итого: <?php echo  SHtml::toCashPrice($model->getTotal())  ?> руб.</td>
    </tr>
    <tr>
        <td><?php echo ucfirst(SHtml::num2str($model->getTotal())) ?></td>
    </tr>
    <tr>
        <td style="height: 40px">&nbsp;</td>
    </tr>
    <tr>
        <td>Отпуск товара разрешил: _____________________/ Коптелов А.В.</td>
    </tr>
    <tr>
        <td style="height: 30px">&nbsp;</td>
    </tr>
    <tr>
        <td style="padding-left: 230px">М.П.</td>
    </tr>
</table>

<div style="position: absolute;left: 40px;bottom: 40px; width: 60px">
    <?php echo $model->shipping->label?>
    <?php if(((strtotime($model->update_payment_status) - strtotime($model->date)) <= 10800) && $model->payment_status == OrderPaymentStatus::PAID){
        echo "+";
    }?>
</div>