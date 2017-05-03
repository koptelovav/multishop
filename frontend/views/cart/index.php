<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
/* @var $cartForm CartForm */
?>

<h1>Корзина</h1>
<div id="cart-form">
    <div id="big-preloader"></div>
    <?php if ($cartForm->products): ?>

        <?php

        /* @var $form CActiveForm*/

        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'orders-form',
            'enableAjaxValidation' => false,
            'action' => Yii::app()->createUrl('orders/create'),
            'htmlOptions' => array(
                "class" => "form-horizontal simple-text"
            )
        )); ?>


        <?php $this->renderPartial('_summary', array(
            'form' => $form,
            'dataProvider'=>$dataProvider,
            'giftDataProvider'=>$giftDataProvider,
            'total' => $total,
            'cartForm' => $cartForm,
            'shippingDiscount' => $shippingDiscount
        ))?>

        <div id="alert-cart" class="alert alert-danger"></div>

        <div style="color: #ac2925;font-weight: bold">
            <?php echo $form->errorSummary($cartForm); ?>
        </div>

    <h3>Оформление заказа</h3>

    <p class="jivo-online-btn">
        Есть вопрос по стоимости и срокам доставки или по офрмлению заказа? Мы ответим Вам в течение 20 секунд!
        <span class="jivo-btn jivo-online-btn jivo-btn-light" onclick="jivo_api.open();" style="font-family: Arial, Arial;font-size: 14px;background-color: #9C27B0;border-radius: 0px;-moz-border-radius: 0px;-webkit-border-radius: 0px;height: 29px;line-height: 29px;padding: 0 14px 0 14px;font-weight: normal;font-style: normal">Задать вопрос</span>
        <span class="jivo-btn jivo-offline-btn jivo-btn-light" onclick="jivo_api.open();" style="font-family: Arial, Arial;font-size: 14px;background-color: #9C27B0;border-radius: 0px;-moz-border-radius: 0px;-webkit-border-radius: 0px;height: 29px;line-height: 29px;padding: 0 14px 0 14px;display: none;font-weight: normal;font-style: normal">Задать вопрос</span>
    </p>


        <div class="row">
            <div class="col-lg-8">
                <?php $this->renderPartial('_shipping', array(
                    'form' => $form,
                    'shippingDiscount'=>$shippingDiscount,
                    'cartForm'=>$cartForm
                ))?>

                <?php $this->renderPartial('_payment', array(
                    'form' => $form,
                    'cartForm'=>$cartForm
                ))?>

                <?php if($cartForm->payment && $cartForm->shipping):?>
                    <?php $this->renderPartial('_contact', array(
                        'form' => $form,
                        'cartForm'=>$cartForm
                    ))?>
                <?php endif; ?>

        </div>

        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6 text-left">
                <a class="btn btn-danger btn-lg btn--blue" href="<?= Yii::app()->homeUrl ?>">
                     <span class="btn--inside">
                    Отмена
                          </span>
                </a>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6 text-right">
                <button type="submit" class="btn btn-danger btn-lg" href="<?= Yii::app()->createUrl('orders/create') ?>">
                  <span class="btn--inside">
                    Оформить
                      </span>
                </button>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    <?php else: ?>
        Корзина пуста
    <?php endif; ?>
</div>
