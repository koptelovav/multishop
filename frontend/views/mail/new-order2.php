<?php
/* @var $order Orders */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=600, target-densitydpi=device-dpi">
</head>
<body style="background: none rgb(216, 216, 216);">
<table style="border: 2px dashed #<?= Yii::app()->shop->email_template->color_1 ?>; width: 600px; margin: 0px auto; min-height: 50px; transform: scale(1); zoom: 1; color: rgb(96, 128, 166); background: none rgb(255, 255, 255);">
    <tbody>
    <tr>
        <td style="width: 600px; margin: 0px auto; min-height: 50px; transform: scale(1); zoom: 1; color: rgb(96, 128, 166); background: none rgb(255, 255, 255);">
            <div>
                <table style="border-collapse: collapse; background: none rgb(255, 255, 255);" border="0"
                       cellpadding="0"
                       cellspacing="0" width="100%" bgcolor="#ffffff">
                    <tbody>
                    <tr>
                        <td style="padding:6px;">
                            <img
                                src="http:<?= Yii::app()->media->baseUrl . Yii::app()->shop->email_template->header_banner ?>"
                                alt=""
                                style="display: block; width: 100%;"
                                data-url="http:<?= Yii::app()->media->baseUrl . Yii::app()->shop->email_template->header_banner ?>">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table border="0" cellspacing="0" cellpadding="0" width="100%"
                       style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;">
                    <tbody>
                    <tr>
                        <td align="center" style="padding:6px;">
                            <table border="0" cellpadding="0" cellspacing="0" class="column_table" width="100%"
                                   align="left"
                                   style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;">
                                <tbody>
                                <tr align="center">
                                    <td style="padding:12px 0 25px 0">
                        <span style="display:inline-block">
                            <a href="<?= Yii::app()->createAbsoluteUrl('site/page', array('view' => 'faq')) ?>"
                               class="btn-primary edit"
                               target="_blank"
                               style="font-family:Arial,sans-serif;color:#ffffff;background-color:#<?= Yii::app()->shop->email_template->color_1 ?>;border-color:#<?= Yii::app()->shop->email_template->color_1 ?>;border-style:solid;border-width:8px 20px;font-size:16px;line-height:1.5em;border-radius:6px;display:inline-block;margin-bottom:10px;margin-right:10px;font-weight:normal;text-align:center;text-decoration:none;vertical-align:middle;cursor:pointer;background-image:none;white-space:nowrap;">
                                вопрос-ответ
                            </a></span>

                        <span style="display:inline-block">
                            <a href="<?= Yii::app()->createAbsoluteUrl('site/page', array('view' => 'faq')) ?>"
                               class="btn-primary edit"
                               target="_blank"
                               style="font-family:Arial,sans-serif;color:#ffffff;background-color:#<?= Yii::app()->shop->email_template->color_2 ?>;border-color:#<?= Yii::app()->shop->email_template->color_2 ?>;border-style:solid;border-width:8px 20px;font-size:16px;line-height:1.5em;border-radius:6px;display:inline-block;margin-bottom:10px;margin-right:10px;font-weight:normal;text-align:center;text-decoration:none;vertical-align:middle;cursor:pointer;background-image:none;white-space:nowrap;">
                                отправка заказа
                            </a></span>

                        <span style="display:inline-block">
                            <a href="<?= Yii::app()->createAbsoluteUrl('site/page', array('view' => 'faq')) ?>"
                               class="btn-primary edit"
                               target="_blank"
                               style="font-family:Arial,sans-serif;color:#ffffff;background-color:#<?= Yii::app()->shop->email_template->color_3 ?>;border-color:#<?= Yii::app()->shop->email_template->color_3 ?>;border-style:solid;border-width:8px 20px;font-size:16px;line-height:1.5em;border-radius:6px;display:inline-block;margin-bottom:10px;margin-right:10px;font-weight:normal;text-align:center;text-decoration:none;vertical-align:middle;cursor:pointer;background-image:none;white-space:nowrap;">
                                отследить заказ
                            </a></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table style="border-collapse: collapse; background: none rgb(255, 255, 255); color: #333333" border="0"
                       cellpadding="0"
                       cellspacing="0" width="100%" bgcolor="#ffffff">
                    <tbody>
                    <tr>
                        <td style="padding:6px;">
                            <h2 style="font-size:18px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                Номер Вашего заказа - <?= $order->id ?><br>
                            </h2>
                            <h4 style="font-size:15px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                Вы заказали:<br>
                            </h4>
                            <p style="font-size:13px;padding:10px 0;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                <?php foreach ($order->products as $orderProduct): ?>
                                    <?= $orderProduct->product->short_title ?></b> x <?= $orderProduct->count ?> шт. = <?= $orderProduct->price ?> руб.
                                    <br/>
                                <?php endforeach ?>
                                Доставка =  <?= $order->shipping_price ?> руб.<br/>


                            </p>
                            <h4 style="font-size:15px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                Итого: <?= $order->total ?> руб.
                            </h4>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:6px;">
                            <h2 style="font-size:18px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                Способ доставки:
                            </h2>
                            <h4 style="font-size:15px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                <?= $order->shipping->name ?>
                            </h4>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:6px;">
                            <?php
                                $payment = $order->payment;
                            ?>
                            <h2 style="font-size:18px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                               Способ оплаты:
                            </h2>
                            <h4 style="font-size:15px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                               <?= $payment->name?>
                            </h4>
                            <?php if($payment->id != 1 && $payment->id != 3):?>
                            <p style="font-size:13px;padding:10px 0;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                Для оплаты заказа перейдите по ссылке <a href="<?php echo Yii::app()->createAbsoluteUrl('billing/payment',array('id'=>$order->id))?>"><?php echo Yii::app()->createAbsoluteUrl('billing/payment',array('id'=>$order->id))?></a>
                            </p>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:6px;">
                            <p>
                                Если остались вопросы по заказу, Вы можете задать их ответом на это письмо или позвонив по телефону 8(812)309-06-80
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <div class="column full sep" style="background: none rgb(255, 255, 255);">
                    <table border="0" cellspacing="0" cellpadding="0" width="100%"
                           style="border-collapse: collapse; background: none rgb(255, 255, 255);" bgcolor="#ffffff">
                        <tbody>
                        <tr>
                            <td style="padding:6px">
                                <div class="hr"
                                     style="border-top-width:1px;border-top-color:#999999;border-top-style:solid;margin-top:20px;margin-bottom:20px;width:100%;height:0"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
            $templateProducts = Yii::app()->shop->email_template->products;
            if(count($templateProducts)):
            ?>
            <div>
                <table style="border-collapse: collapse; background: none rgb(255, 255, 255);" border="0"
                       cellpadding="0"
                       cellspacing="0" width="100%" bgcolor="#ffffff">
                    <tbody>
                    <tr>
                        <td style="padding:6px;">
                            <h2 style="font-size:18px;margin:0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;text-align: center; color: #333">
                                Посмотрите также
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px;">
                            <?php foreach($templateProducts as $product): ?>
                            <table class="column_table"
                                   style="border-collapse: collapse; background: none rgb(255, 255, 255);"
                                   align="left" border="0" cellpadding="0" cellspacing="0" width="33.3%"
                                   bgcolor="#ffffff">
                                <tbody>
                                <tr>
                                    <td style="padding:0 5px">
                                        <a href="<?= $product->url ?>" target="_blank">
                                            <img src="http:<?= Yii::app()->media->baseUrl . $product->image ?>"
                                                 alt=""
                                                 style="width:100%;">
                                        </a>
                                        <br>
                                        <h4 style="font-size:14px;margin:10px 0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                            <a style="text-decoration: none; color: #333333" target="_blank" href="<?= $product->url ?>">
                                                <?= $product->title ?>
                                            </a>
                                            <br>
                                        </h4>
                                        <p style="font-size:13px;margin:10px 0;line-height:1.5em;font-family:Arial, sans-serif;font-style:normal;">
                                            <?= $product->description ?>
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
            <div>
                <table style="border-collapse:collapse;background: rgb(255, 255, 255);" bgcolor="#5A6165" border="0"
                       cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                    <tr>
                        <td style="padding: 0px 10px 20px;">
                            <p style="padding:0;margin:0;color:#434343;font-size:12px;">
                                * Вы получили это сообщение, поскольку ваш адрес был указан при оформлении заказа в
                                интренет-магазине <a
                                    href="http://<?= Yii::app()->shop->get('domain') ?>"><?= Yii::app()->shop->get('name') ?></a>,
                                если вы не совершали этих действий, просто проигнорируйте это письмо. <br>
                                Данное письмо рассылается автоматически.
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>