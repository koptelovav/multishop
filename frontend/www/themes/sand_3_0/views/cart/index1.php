<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
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

        <h3>Товары в корзине</h3>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'view-cart',
            'itemsCssClass' => 'table table-hover products-table',
            'dataProvider' => $dataProvider,
            'summaryText' => false,
            'emptyText' => 'Вы не выбрали ни одного товара',
            'template' => '{items}',
            'rowCssClassExpression'=>'"{$data->id}pr"',
            'columns' => array(
              /*  array(
                    'type' => 'raw',
                    'value' => function ($data) {
                        return CHtml::link('&nbsp', array('cart/delete', 'id' => $data->id), array('class' => 'glyphicon glyphicon-remove', 'data-modificator' => 'cart', 'data-event'=>'recalculation'));
                    },
                    'htmlOptions' => array(
                        'width' => '60'
                    )
                ),*/

                array(
                    'type' => 'html',
                    'value' => function ($data) {
                        return CHtml::link(
                            CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $data->image)),
                            array('products/view', 'id' => $data->id)
                        );
                    },
                    'htmlOptions' => array(
                        'width' => '60'
                    )
                ),
                array(
                    'type' => 'html',
                    'name' => 'Название',
                    'value' => function ($data) {
                        return CHtml::link(
                            $data->short_title,
                            array('products/view', 'id' => $data->id),
                            array('class' => 'product-link')
                        );
                    }
                ),

                array(
                    'name' => 'Цена за штуку',
                    'value' => function ($data) {
                        return SHtml::toPrice($data->currentPrice);
                    },
                ),

                array(
                    'name' => 'Количество',
                    'type' => 'raw',
                    'value' => function ($data) {
                        $html = CHtml::link('&nbsp', '#', array('class' => 'glyphicon glyphicon-minus cart-sub'));
                        $html .= CHtml::textField('CartForm[cartProducts]['.$data->id.']',Yii::app()->session['client_data']['products'][$data->id]['count'], array('size'=>2,'class'=>'product-count'));
                        $html .= CHtml::link('&nbsp', '#', array('class' => 'glyphicon glyphicon-plus cart-add'));
                        return $html;
                    },
                ),

                array(
                    'name' => 'Сумма',
                    'value' => function ($data) {
                        return SHtml::toPrice(Yii::app()->session['client_data']['products'][$data->id]['count'] * $data->currentPrice);
                    },
                ),
            )
        )); ?>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-total">
                    <tr id="total-product">
                        <td>
                            Товар
                        </td>
                        <td class="price">
                            <?php echo SHtml::toPrice($cartForm->getTotalProducts()) ?>
                        </td>
                    </tr>
                    <tr id="shipping" <?php echo $cartForm->shipping ? '' : 'style="display: none;"' ?>>
                        <td>
                            Доставка
                            <span class="title"><?php echo $cartForm->currentShipping['name'] ?></span>
                        </td>
                        <td class="price">
                            <?php echo SHtml::toPrice($cartForm->getTotalShipping()) ?>
                        </td>
                    </tr>
                    <tr id='total'>
                        <td>
                            Итого
                        </td>
                        <td class="price">
                            <?php echo SHtml::toPrice($cartForm->getTotal()) ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if(!empty($cartForm->gifts)):?>
            <h3>Подарки</h3>

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'view-cart',
                'itemsCssClass' => 'table table-hover products-table',
                'dataProvider' => $giftDataProvider,
                'summaryText' => false,
                'emptyText' => 'Вы не выбрали ни одного товара',
                'template' => '{items}',
                'rowCssClassExpression'=>'"{$data->id}pr"',
                'columns' => array(
                    array(
                        'type' => 'html',
                        'value' => function ($data) {
                            return CHtml::link(
                                CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $data->image)),
                                array('products/view', 'id' => $data->id)
                            );
                        },
                        'htmlOptions' => array(
                            'width' => '60'
                        )
                    ),
                    array(
                        'type' => 'html',
                        'name' => 'Название',
                        'value' => function ($data) {
                            return $data->short_title;
                        }
                    ),

                    array(
                        'name' => 'Количество',
                        'type' => 'raw',
                        'value' => function ($data) {
                            return Yii::app()->session['client_data']['gifts'][$data->id];
                        },
                    ),
                )
            )); ?>
        <?php endif ?>
        <div id="alert-cart" class="alert alert-danger">

        </div>

        <div style="color: #ac2925;font-weight: bold">
            <?php echo $form->errorSummary($cartForm); ?>
        </div>

        <h3>Долго оформлять или ничего не понятно? Мы все сделаем за Вас! <a href="<?php echo Yii::app()->createUrl('callback/create')?>" class="callback-button">Заказать звонок</a></h3>

        <h3>Оформление заказа</h3>

        <div class="row">
            <div class="col-xs-8">

                <h4>1. Выберите тип доставки</h4>
                <span class="radio-container">
                    <?php echo CHtml::radiobuttonlist('CartForm[shippingType]', $cartForm->shippingType,array(
                        Shipping::PICKUP_SHIPPING => 'Самовывоз',
                        Shipping::COURIER_SHIPPING => 'Доставка по Санкт-Петербургу',
                        Shipping::COURIER_LO_SHIPPING => 'Доставка по Ленинградской области',
                        Shipping::CALCULATE_SHIPPING => 'Доставка по России'
                    ))?>
                </span>
                <div <?php echo ($cartForm->shipping && $cartForm->shippingType != Shipping::POST_SHIPPING) ? '' : 'style="display: none;"' ?>>
                    <b><i>Стоимость доставки: <?php echo SHtml::toPrice($cartForm->getTotalShipping()) ?></i></b>
                </div>


                <?php if($cartForm->shippingType == Shipping::CALCULATE_SHIPPING):?>
                <h4>1.1 Введите Ваш индекс и нажмите на синию кнопку "рассчитать" для расчета доставки</h4>
                    <p>
                        Свой индекс можно узнать здесь <a href="http://ruspostindex.ru/" target="_blank">http://ruspostindex.ru/</a>
                    </p>
                    <div id="CartForm_shipping" class="form-group">
                        <?php echo $form->labelEx($cartForm, 'zip', array('class' => 'col-xs-3 control-label')); ?>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <?php echo $form->textField($cartForm, 'zip', array('class' => 'form-control')); ?>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="shipping_calculate">Рассчитать</button>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($cartForm->shippingType == Shipping::CALCULATE_SHIPPING && !empty($cartForm->shippingVariants)):?>
                    <span class="radio-container">
                        <?php foreach ($cartForm->getShipping() as $shipping): ?>
                            <div class="row shipping-row" id="s_code_<?php echo $shipping->edost_code?>" <?php echo isset($cartForm->shippingVariants[$shipping->edost_code]) ?'': 'style="display:none"'?>>
                                <div class="col-xs-6">
                                    <input id="CartForm_shipping_<?php echo $shipping->id ?>" value="<?php echo $shipping->id ?>" type="radio"
                                           name="CartForm[shipping]" <?php echo $cartForm->shipping == $shipping->id ?'checked="checked"':''?>>
                                    <label for="CartForm_shipping_<?php echo $shipping->id ?>">
                                        <?php echo $shipping->name ?>
                                    </label>
                                </div>
                                <div class="col-xs-3 text-right price">
                                    <?php echo SHtml::toPrice($shipping->price); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </span>
                <?php endif; ?>

                <?php if($cartForm->shipping):?>
                    <h4>2. Выберите тип оплаты</h4>
                    <span class="radio-container">
                        <?php echo CHtml::radiobuttonlist('CartForm[payment]',$cartForm->payment, CHtml::listData($cartForm->getPayment(),'id','name'))?>

                    </span>
                <?php endif; ?>


                <div <?php echo $cartForm->payment ? '' : 'style="display: none"'?>>
                <h4>3. Заполните основную информацию</h4>

                <div class="form-group">
                    <?php echo $form->labelEx($cartForm, 'name', array('class' => 'col-xs-3 control-label')); ?>
                    <div class="col-xs-7">
                        <?php echo $form->textField($cartForm, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($cartForm, 'phone', array('class' => 'col-xs-3 control-label')); ?>
                    <div class="col-xs-7">
                        <?php
                        $this->widget('CMaskedTextField', array(
                            'model' => $cartForm,
                            'attribute' => 'phone',
                            'mask' => '+7-999-999-9999',
                            'placeholder' => '*',
                            'htmlOptions' => array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)
                        ));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($cartForm, 'email', array('class' => 'col-xs-3 control-label')); ?>
                    <div class="col-xs-7">
                        <?php echo $form->textField($cartForm, 'email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 64)); ?>
                    </div>
                </div>
                <div class="form-group">
                <p></p>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($cartForm, 'city', array('class' => 'col-xs-3 control-label')); ?>
                    <div class="col-xs-7">
                        <?php echo $form->textField($cartForm, 'city', array('class' => 'form-control')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($cartForm, 'area', array('class' => 'col-xs-3 control-label')); ?>
                    <div class="col-xs-7">
                        <?php echo $form->textField($cartForm, 'area', array('class' => 'form-control')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($cartForm, 'address', array('class' => 'col-xs-3 control-label')); ?>
                    <div class="col-xs-7">
                        <?php echo $form->textField($cartForm, 'address', array('class' => 'form-control', 'empty'=>' ==Выберите регион==')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($cartForm, 'comment', array('class' => 'col-xs-3 control-label')); ?>
                    <div class="col-xs-7">
                        <?php echo $form->textArea($cartForm, 'comment', array('class' => 'form-control', 'rows' => 5)); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 text-left">
                <a class="btn btn-danger btn-lg" href="<?= Yii::app()->homeUrl ?>">
                    &larr; Отмена
                </a>
            </div>
            <div class="col-xs-6 text-right">
                <button type="submit" class="btn btn-danger btn-lg" href="<?= Yii::app()->createUrl('orders/create') ?>">
                    Оформить &rarr;
                </button>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    <?php else: ?>
        Корзина пуста
    <?php endif; ?>
</div>
