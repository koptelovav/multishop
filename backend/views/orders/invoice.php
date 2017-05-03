<style type="text/css">
    table{
        width: 780px;
        border-collapse: collapse;
    }
    #invoice_body td,
    .amount td.number,
    .invoice_preview_items thead td,
    .invoice_preview_account td {
        border: 1px solid #ccc;
        padding: 3px;
        vertical-align: bottom;
    }

    .amount{
        text-align: right;
    }

    .amount td:first-child{
        padding-right: 10px;
    }
</style>

<p><span style="font-weight: bold;">ИП Коптелов Алексей Владленович</span><br></p>

<table class="invoice_preview_account">
    <tbody>
    <tr>
        <td style="width: 25%;"><span>ИНН</span> 424623808213</td>
        <td style="width: 25%;"><span>ОГРНИП</span> 313424629000016</td>
        <td style="width: 25%;" rowspan="2"><span>Расчетный счет</span></td>
        <td style="width: 25%;" rowspan="2">40802810902100009816</td>
    </tr>
    <tr>
        <td colspan="2"><span>Получатель</span><br>ИП Коптелов Алексей Владленович</td>
    </tr>
    <tr>
        <td colspan="2" rowspan="2"><span>Банк получателя</span><br>ОАО АКБ "Авангард"</td>
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
    от <?php echo date('d') ?>
    марта <?php echo date('Y') ?> г.</h3>
<table class="payers">
    <tbody>
    <tr>
        <td style="width: 135px;"><span>Плательщик</span></td>
        <td><?php echo $order->customer->name ?></td>
    </tr>
    <tr>
        <td><span>Получатель</span></td>
        <td>ИП Коптелов Алексей Владленович</td>
    </tr>
    <tr>
        <td><span>Основание платежа:</span></td>
        <td>Оплата по договору № 16/09-2016</td>
    </tr>
    </tbody>
</table>
<table class="invoice_preview_items">
    <thead>
    <tr>
        <td class="number" style="width: 5%;">№</td>
        <td style="width: 47%;">Наименование товара</td>
        <td class="number" style="width: 10%;">Количество</td>
        <td class="number" style="width: 15%;">Цена</td>
        <td class="number" style="width: 15%;">Сумма</td>
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
            <td style="text-align: center"><?php echo($key + 1) ?></td>
            <td style="padding-left: 10px"><?php echo $product->short_title ?></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->count ?></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->price ?>.00</td>
            <td style="padding-left: 10px"><?php echo $orderProduct->price * $orderProduct->count ?>.00</td>
        </tr>
    <?php endforeach ?>
    <?php if($order->shipping_price):?>
        <tr>
            <td style="text-align: center"><?php echo($key + 2) ?></td>
            <td style="padding-left: 10px">Доставка</td>
            <td style="padding-left: 10px">1</td>
            <td style="padding-left: 10px"><?php echo $order->shipping_price ?>.00</td>
            <td style="padding-left: 10px"><?php echo $order->shipping_price ?>.00</td>
        </tr>
    <?php endif ?>
    </tbody>
    <tbody>
    <tr class="amount">
        <td colspan="4">Итого</td>
        <td class="number" id="amount_without_nds"><?php echo $order->getTotal() ?>.00</td>
    </tr>
    <tr class="amount">
        <td colspan="4">Налог (НДС)</td>
        <td class="number" id="amount_nds">—</td>
    </tr>
    <tr class="amount">
        <td colspan="4" class="amount">Всего к оплате</td>
        <td class="number bold"><span id="invoice_amount"><?php echo $order->getTotal() ?>.00 руб.</span>
        </td>
    </tr>
    </tbody>
</table>
<p style="margin-bottom: 3em;">
    Всего на сумму
    <span id="total_amount"><?php echo $order->getTotal() ?>.00 руб.<br><span
        style="font-weight: bold;"><?php echo ucfirst(SHtml::num2str($order->getTotal() )) ?></span></p>
