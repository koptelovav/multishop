<?php
/* @var $order Orders */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=320, target-densitydpi=device-dpi">
</head>
<body>
    Здравствуйте.<br>
    Заказ No.<?php echo $order->id ?>. Трэк-номер для отслеживания посылки: <?php echo $order->track ?><br>
    Доставку выполняет: <?php echo $order->shipping->customer_name ?><br>
    Для отслеживания заказа перейдите по ссылке: <?php echo $order->shipping->tracking_link ?><br>
    <hr>

    C уважением, BambooGroup<br>
    8 (812) 981-72-62
<body>
</html>