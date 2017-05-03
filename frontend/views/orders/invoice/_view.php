<div id="invoice">
<p><span>ИП Коптелов Алексей Владленович</span><br></p>

<table class="invoice_preview_account">
    <tbody>
    <tr>
        <td><span>ИНН</span> 424623808213</td>
        <td><span>ОГРНИП</span> 313424629000016</td>
        <td rowspan="2"><span>Расчетный счет</span></td>
        <td rowspan="2">40802810902100009816</td>
    </tr>
    <tr>
        <td colspan="2"><span>Получатель</span><br>ИП Коптелов Алексей Владленович</td>
    </tr>
    <tr>
        <td colspan="2" rowspan="2"><span>Банк получателя</span><br>ПАО АКБ «АВАНГАРД»</td>
        <td><span>БИК</span></td>
        <td>044525201</td>
    </tr>
    <tr>
        <td><span>Корр. счет</span></td>
        <td>30101810000000000201</td>
    </tr>
    </tbody>
</table>

<h3>
    Счет №<?php echo $order->id ?>
    от <?php echo date('d.m.Y', strtotime($order->date))?> г.</h3>
<table class="payers">
    <tbody>
    <tr>
        <td><span>Плательщик</span></td>
        <td><?php echo $order->customer->name ?></td>
    </tr>
    <tr>
        <td><span>Получатель</span></td>
        <td>Индивидуальный Предприниматель Коптелов Алексей Владленович</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    </tbody>
</table>
<table class="invoice_preview_items">
    <thead>
    <tr>
        <td class="number">№</td>
        <td>Наименование товара</td>
        <td class="number">Количество</td>
        <td class="unit">Единицы</td>
        <td class="number">Цена</td>
        <td class="number">Сумма</td>
    </tr>
    </thead>
    <tbody id="invoice_body">
    <?php $productTotalPrice = 0 ?>
    <?php foreach ($order->products as $key => $orderProduct): ?>
        <?php
        $product = $orderProduct->product;
        $productTotalPrice += $orderProduct->price * $orderProduct->count;
        ?>
        <tr>
            <td><?php echo($key + 1) ?></td>
            <td><?php echo ($product->article ? $product->article.' - ' : '').$product->title ?></td>
            <td><?php echo $orderProduct->count ?></td>
            <td><?php echo $product->unit ?></td>
            <td><?php echo SHtml::toCashPrice($orderProduct->getPrice()) ?></td>
            <td><?php echo SHtml::toCashPrice($orderProduct->getPrice() * $orderProduct->count) ?></td>
        </tr>
    <?php endforeach ?>
    <?php if(($order->shipping_price) > 0):?>
        <tr>
            <td><?php echo($key + 2) ?></td>
            <td>Доставка | <?= $order->shipping->customer_name ?></td>
            <td>x</td>
            <td>x</td>
            <td><?php echo SHtml::toCashPrice($order->shipping_price) ?></td>
            <td><?php echo SHtml::toCashPrice($order->shipping_price) ?></td>
        </tr>
    <?php endif ?>
    </tbody>
    <tbody>
    <tr class="amount">
        <td colspan="5">Итого</td>
        <td class="number" id="amount_without_nds"><?php echo SHtml::toCashPrice($order->getTotal()) ?></td>
    </tr>
    <tr class="amount">
        <td colspan="5">Налог (НДС)</td>
        <td class="number" id="amount_nds">—</td>
    </tr>
    <tr class="amount">
        <td colspan="5" class="amount">Всего к оплате</td>
        <td class="number bold"><span id="invoice_amount"><?php echo SHtml::toCashPrice($order->getTotal()) ?> руб.</span>
        </td>
    </tr>
    </tbody>
</table>
<p>
    Всего на сумму
    <span id="total_amount"><?php echo SHtml::toCashPrice($order->getTotal())?> руб.<br>
            <?php echo ucfirst(SHtml::num2str($order->getTotal())) ?></span>
</p>
</div>

<div>
    <img style="padding-top: 20px; width: 780px" src="<?= Yii::app()->baseUrl ?>/images/sign.jpg" alt="">
</div>