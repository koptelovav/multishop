<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */

?>

<script type="text/javascript">
    window.onload = function(){window.print();}
    window.onfocus = function() { window.close(); }
</script>
<style type="text/css">
    #image{
        width: 210mm;
    }
</style>

<table cellpadding="0" border="0" width="842" style="font-size: 15px; font-family: 'Courier','Courier New">
    <tr>
        <td style="font-weight: bold; text-align: center">ИП Коптелов АВ Санкт-Петербург пр. Испытателей 20 ИНН
            424623808213 8 (812) 981-72-62
        </td>
    </tr>
    <tr>
        <td style="text-align: center">Срок предъявления претензий – 2 недели, при наличии кассового чека.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td style="text-align: center">ТОВАРНЫЙ ЧЕК № <?php echo $model->id ?> от <?php echo date('d.m.Y', strtotime($model->date))?> г.
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="1" width="842"
       style="font-size: 15px;border: 1px solid #000000;border-collapse:collapse">
    <tr style="text-align: center">
        <td width="50">№</td>
        <td width="450">Наименование</td>
        <td width="200">Каталожный номер</td>
        <td width="200">Кол-во</td>
        <td width="200">Цена</td>
        <td width="250">Сумма</td>
    </tr>
    <?php $productTotalPrice = 0 ?>
    <?php foreach ($model->products as $key => $orderProduct): ?>
        <?php
        $product = $orderProduct->product;
        $productTotalPrice += $orderProduct->price * $orderProduct->count;
        ?>
        <tr>
            <td style="text-align: center"><?php echo($key + 1) ?></td>
            <td style="padding-left: 10px"><?php echo $product->short_title ?></td>
            <td style="padding-left: 10px"><?php echo $product->id ?></td>
            <td style="padding-left: 10px"><?php echo $orderProduct->count ?></td>
            <td style="padding-left: 10px"><?php echo SHtml::toCashPrice($orderProduct->getPrice()) ?></td>
            <td style="padding-left: 10px"><?php echo  SHtml::toCashPrice($orderProduct->getPrice() * $orderProduct->count) ?></td>
        </tr>
    <?php endforeach ?>
    <?php foreach ($model->gifts as $key2 => $giftProduct): ?>
        <?php
        $product = $giftProduct->product;
        ?>
        <tr>
            <td style="text-align: center"><?php echo($key + $key2+2) ?></td>
            <td style="padding-left: 10px"><?php echo $product->short_title ?></td>
            <td style="padding-left: 10px"><?php echo $product->id ?></td>
            <td style="padding-left: 10px"><?php echo $giftProduct->count ?></td>
            <td style="padding-left: 10px">0.00</td>
            <td style="padding-left: 10px">0.00</td>
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

<table cellpadding="0" border="0" width="842" style="font-size: 15px; font-family: 'Courier','Courier New">
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
        <td>Отпуск товара разрешил: __________________________________________ / /</td>
    </tr>
    <tr>
        <td style="height: 60px">&nbsp;</td>
    </tr>
    <tr>
        <td style="padding-left: 100px">М.П.</td>
        <td width="200">Кассир:</td>
    </tr>
</table>

<img id="image" src="<?php echo Yii::app()->baseUrl?>/img/cashe_image.jpg" alt=""/>