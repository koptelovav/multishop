<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */


$products = $model->getOrderProduct();
?>

<h1><?php echo $model->shipping->label.$model->id ?><?php echo $model->status == 12 ? ' - ДОСЫЛ!' : ''?></h1>
<table class="gtable bordered" id="products">
    <thead>
    <tr style="text-align: center">
        <td width="450">Код / Артикул</td>
        <td width="450">Наименование</td>
        <td width="200">Кол-во</td>
    </tr>
    </thead>
    <?php foreach ($products as $key => $product): ?>
        <tr <?php echo $product['count'] > 1 ? 'style="background-color: #333"' : '' ?>>
            <td style="padding-left: 10px; <?php echo $product['count'] > 1 ? 'color: #FFF' : '' ?>"><?php echo $product['code'].' / '.$product['article'] ?></td>
            <td style="padding-left: 10px; <?php echo $product['count'] > 1 ? 'color: #FFF' : '' ?>"><?php echo $product['title'] ?></td>
            <td style="padding-left: 10px; <?php echo $product['count'] > 1 ? 'color: #FFF' : '' ?>"><?php echo $product['count'] ?></td>
        </tr>
    <?php endforeach ?>

    <?php if(((strtotime($model->update_payment_status) - strtotime($model->date)) <= 10800) && $model->payment_status == OrderPaymentStatus::PAID): ?>
        <tr>
            <td style="text-align: center"><div style="display: inline-block;width: 30px; height: 30px; border: 1px solid #000000"></div></td>
            <td style="padding-left: 10px">Самосвал "Нордик"</td>
            <td style="padding-left: 10px">1</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td style="text-align: center"><div style="display: inline-block;width: 30px; height: 30px; border: 1px solid #000000"></div></td>
        <td style="padding-left: 10px">Пробник "Bubber", Листовка, Магнит</td>
        <td style="padding-left: 10px">1</td>
    </tr>
</table>

<div>
    <h1>Комметарии</h1>
    <?php if($model->comment):?>
        <table>
            <tr>
                <td style="border-right: 1px solid #ccc;padding-right: 10px;">
                    <small>Заказчик</small>
                </td>
                <td style="padding-left: 10px">
                    <?php echo CHtml::encode($model->comment); ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>
    <?php foreach($model->comments as $data): ?>
        <table>
            <tr>
                <td style="border-right: 1px solid #ccc;padding-right: 10px;">
                    <small><?php echo $data->user->name; ?></small>
                </td>
                <td style="padding-left: 10px">
                    <?php echo nl2br($data->text); ?>
                </td>
            </tr>
        </table>
    <?php endforeach; ?>
</div>

