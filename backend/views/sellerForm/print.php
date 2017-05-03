<?php $total = 0?>
<div style="font-size: 20px">
    <?= date('d.m.Y',strtotime($model->date)) ?>  | <?= $model->user->name ?>
</div>

<table border="1" cellspacing="5" cellpadding="5" bordercollaps style="border-collapse: collapse;">
    <thead>
    <tr>
        <th>Товар</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Скидка</th>
        <th>Итого</th>
        <th>Подарок</th>
        <th>Тип оплаты</th>
    </tr>
    </thead>

    <tbody id="sales">
    <?php foreach($model->sales as $sale): ?>
        <tr style="border-bottom: 1px solid #dddddd">
            <td class="product_title"><?= $sale->product_title ?></td>
            <?php if(Yii::app()->user->checkAccess('admin')):?>
                <td class="total" style="font-weight: bold">
                    <?php
                         $salePrice = $sale->payment_type == 1 ? ($sale->product_price*0.69).'x'.$sale->product_count : $sale->total;
                         $total += $salePrice;
                         echo $salePrice;
                    ?>
                </td>
            <?php endif ?>
            <td class="product_count"><?= $sale->product_count ?></td>
            <td class="product_discount"><?= $sale->discount ?></td>
            <td class="total"><?= $salePrice*$sale->product_count ?></td>

            <td class="gift_title"><?= $sale->gift_title ?></td>
            <td class="payment_type"><?= SellerFormSale::$payment_type[$sale->payment_type] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<div class="row">
    <div class="col-lg-6">
        <div>
            <b>Продано на сумму: </b> <?= SHtml::toPrice($total) ?>
        </div>
    </div>
</div>


