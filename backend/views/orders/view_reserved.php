<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress CustomerAddress */
/* @var $customerEntityInfo CustomerEntityInfo */

$this->buttonCurrentTemplate = '{copy} {return}';
$this->pageTitle = $model->id;
$this->panelTitle = 'Заказ <b>No.' . $model->id . '</b> ';
$widgetID = 'main';
?>


<?php
Yii::app()->clientScript->registerScript('update-order', "
        $('.update-drop-down').change(function(){
            $.ajax({
                type: 'POST',
                url: '" . $this->createUrl('update', array('id' => $model->id)) . "',
                data: $(this).attr('name')+'='+$(this).val()
            });
        });
    ", CClientScript::POS_READY);

?>

<div class="row">
    <div class="col-lg-12 text-right">
        <?php $this->renderPartial('//orderTag/_set_panel') ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <fieldset>
            <legend>Детали заказа No.<?php echo $model->id ?></legend>
            <dl class="dl-horizontal">
                <dt><?php echo $model->getAttributeLabel('shop_id'); ?></dt>
                <dd><?php echo $model->shop->name; ?></dd>
                <dt>Оформлен</dt>
                <dd><?php echo date('d.m.Y H:i', strtotime($model->date)); ?></dd>
                <?php if ($model->update_payment_status): ?>
                    <dt>Оплачен</dt>
                    <dd><?php echo date('d.m.Y H:i', strtotime($model->update_payment_status)); ?></dd>
                <?php endif ?>
                <?php if ($model->formed_date): ?>
                    <dt>Сформирован</dt>
                    <dd><?php echo date('d.m.Y H:i', strtotime($model->formed_date)); ?></dd>
                <?php endif ?>

                <dt><?php echo $model->getAttributeLabel('priority'); ?></dt>
                <dd><?php echo $model->priority ?></dd>

                <dt>Статус заказа</dt>
                <dd><?php echo $model->orderStatus->name ?></dd>

                <dt>Статус оплаты</dt>
                <dd><?php echo $model->paymentStatus->name ?></dd>
            </dl>
        </fieldset>
        <fieldset>
            <legend>Доставка и оплата</legend>
            <dl class="dl-horizontal">
                <dt><?php echo $model->getAttributeLabel('shipping_id'); ?></dt>
                <dd><?php echo $model->shipping->name ?></dd>

                <dt><?php echo $model->getAttributeLabel('payment_id'); ?></dt>
                <dd><?php echo $model->payment->name ?></dd>

                <?php $this->renderPartial('_view_additional_field', array(
                    'model' => $model,
                    'fieldName' => 'shipping_date'
                )); ?>
                <?php $this->renderPartial('_view_additional_field', array(
                    'model' => $model,
                    'fieldName' => 'shipping_time'
                )); ?>
                <dt><?php echo $model->getAttributeLabel('track'); ?></dt>
                <dd>
                    <?php
                    $this->widget('editable.EditableField', array(
                        'model' => $model,
                        'attribute' => 'track',
                        'url' => $this->createUrl('orders/orderEditableServerUpdate', array('model' => get_class($model))),
                    ));
                    ?>
                    <span class="glyphicon glyphicon-send send-track" data-order="<?php echo $model->id ?>"></span>
                </dd>
                <dt><?php echo $model->getAttributeLabel('weight'); ?> / кг</dt>
                <dd><?php echo $model->getWeight('kg'); ?></dd>
            </dl>
        </fieldset>

        <fieldset>
            <legend>Стоимость</legend>
            <dl class="dl-horizontal">
                <?php if ($model->promo_code): ?>
                    <dt><?php echo $model->getAttributeLabel('promo_code'); ?></dt>
                    <dd><?php echo $model->promo_code; ?></dd>
                <?php endif; ?>


                <dt><?php echo $model->getAttributeLabel('shipping_price'); ?></dt>
                <dd><?php echo $model->shipping_price; ?></dd>

                <dt><?php echo $model->getAttributeLabel('product_price'); ?></dt>
                <dd><?php echo $model->productsSum; ?></dd>


                <?php if ($model->promo_code): ?>
                    <dt><?php echo $model->getAttributeLabel('discount'); ?></dt>
                    <dd><?php echo $model->discount; ?></dd>
                <?php endif; ?>


                <dt><?php echo $model->getAttributeLabel('total_price'); ?></dt>
                <dd><?php echo $model->total; ?></dd>

                <?php if($cashOnDelivery = $model->getAdditionalFieldByName('cash_on_delivery') && $cashOnDelivery->value): ?>
                    <?php $field = $model->getAdditionalFieldByName('cash_on_delivery') ?>
                    <dt><?php echo $field->params->title; ?></dt>
                    <dd> <?php echo $cashOnDelivery->value ?></dd>
                <?php endif ?>

            </dl>
        </fieldset>
    </div>

    <div class="col-lg-4">
        <fieldset>
            <legend>Данные покупателя</legend>
            <dl class="dl-horizontal">
                <dt><?php echo $customer->getAttributeLabel('name'); ?></dt>
                <dd><?php echo $customer->name; ?></dd>


                <dt><?php echo $customer->getAttributeLabel('phone'); ?></dt>
                <dd><?php echo SHtml::phone($customer->phone); ?></dd>


                <dt><?php echo $customer->getAttributeLabel('email'); ?></dt>
                <dd><?php echo $customer->email; ?></dd>
            </dl>
        </fieldset>
        <fieldset>
            <legend>Адрес</legend>
            <dl class="dl-horizontal">
                <?php if (!is_null($customerAddress)): ?>
                    <dt><?php echo $customerAddress->getAttributeLabel('zip'); ?></dt>
                    <dd><?php echo $customerAddress->zip; ?></dd>

                    <dt><?php echo $customerAddress->getAttributeLabel('city'); ?></dt>
                    <dd><?php echo $customerAddress->city; ?></dd>

                    <dt><?php echo $customerAddress->getAttributeLabel('area'); ?></dt>
                    <dd><?php echo $customerAddress->area; ?></dd>

                    <?php if ($customerAddress->address): ?>
                        <dt><?php echo $customerAddress->getAttributeLabel('street'); ?></dt>
                        <dd><?php echo $customerAddress->address; ?></dd>
                    <?php elseif ($customerAddress->street): ?>
                        <dt><?php echo $customerAddress->getAttributeLabel('street'); ?></dt>
                        <dd><?php echo $customerAddress->street; ?>,<?php echo $customerAddress->house; ?>
                            - <?php echo $apartment->street; ?></dd>

                    <?php elseif ($model->shipping_id == Shipping::CDEK_SPB ||
                        $model->shipping_id == Shipping::MSC_STORE_SHIPPING ||
                        $model->shipping_id == Shipping::CDEK_STORE_SHIPPING
                    ): ?>
                        <dt><?php echo $customerAddress->getAttributeLabel('pvz_name'); ?></dt>
                        <dd><?php echo Yii::app()->CDEKApi->getPVZList($customerAddress->zip)[$customerAddress->pvz]['name']; ?></dd>
                    <?php endif; ?>
                <?php endif ?>

                <dt><?php echo $model->getAttributeLabel('comment'); ?></dt>
                <dd><?php echo $model->comment; ?></dd>

                <?php $customerOrders = $model->customer->getAllOrders(); ?>
                <?php if (count($customerOrders) > 1): ?>
                    <h4>Заказы клиента</h4>
                    <dl>
                        <?php foreach ($customerOrders as $key => $item) {
                            echo '<dt>' . ($key + 1) . ')</dt>';
                            echo '<dd>' . CHtml::link('Заказ №' . $item->id, array('orders/view', 'id' => $item->id), array('target' => '_blank')) . '</dd>';
                        }
                        ?>
                    </dl>
                <?php endif; ?>
            </dl>
        </fieldset>

        <?php if (!is_null($customerEntityInfo)): ?>
        <fieldset>
            <legend>Реквизиты</legend>
            <dl class="dl-horizontal">
                <dt><?php echo $customerEntityInfo->getAttributeLabel('name'); ?></dt>
                <dd><?php echo $customerEntityInfo->name; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('director'); ?></dt>
                <dd><?php echo $customerEntityInfo->director; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('director_short'); ?></dt>
                <dd><?php echo $customerEntityInfo->director_short; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('ogrn'); ?></dt>
                <dd><?php echo $customerEntityInfo->ogrn; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('inn'); ?></dt>
                <dd><?php echo $customerEntityInfo->inn; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('kpp'); ?></dt>
                <dd><?php echo $customerEntityInfo->kpp; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('okpo'); ?></dt>
                <dd><?php echo $customerEntityInfo->okpo; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('address'); ?></dt>
                <dd><?php echo $customerEntityInfo->address; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('phone'); ?></dt>
                <dd><?php echo $customerEntityInfo->phone; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('rs'); ?></dt>
                <dd><?php echo $customerEntityInfo->rs; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('bank'); ?></dt>
                <dd><?php echo $customerEntityInfo->bank; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('bik'); ?></dt>
                <dd><?php echo $customerEntityInfo->bik; ?></dd>

                <dt><?php echo $customerEntityInfo->getAttributeLabel('ks'); ?></dt>
                <dd><?php echo $customerEntityInfo->ks; ?></dd>
            </dl>
        </fieldset>
        <?php endif; ?>
    </div>

    <div class="col-lg-4">
        <fieldset>
            <legend>Товары</legend>
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'order-product-grid',
                'dataProvider' => new CArrayDataProvider($model->products, array(
                    'keyField' => 'product_id',
                    'pagination' => array(
                        'pageSize' => 100,
                    ),

                )),
                'summaryText' => false,
                'htmlOptions' => array(
                    'class' => 'order-product-grid'
                ),
                'columns' => array(
                    array(
                        'value' => function ($data) {
                            return $data->product->title;
                        },
                    ),

                    array(
                        'value' => function ($data) {
                            echo $data->count;

                        },
                    ),
                    array(
                        //                'name'=>Products::model()->getAttributeLabel('price'),
                        'value' => '$data->price',
                    ),
                ),
            )); ?>
        </fieldset>
        <fieldset>
            <legend>Комплектация</legend>
            <table class="gtable bordered" id="products">
                <?php foreach ($model->getOrderProduct() as $key => $product): ?>
                    <tr>
                        <td style="padding-left: 10px"><?php echo $product['title'] ?></td>
                        <td style="padding-left: 10px"><?php echo $product['count'] ?></td>
                    </tr>
                <?php endforeach ?>

                <?php if (((strtotime($model->update_payment_status) - strtotime($model->date)) <= 10800) && $model->payment_status == OrderPaymentStatus::PAID): ?>
                    <tr>
                        <td style="padding-left: 10px">Самосвал "Нордик"</td>
                        <td style="padding-left: 10px">1</td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td style="padding-left: 10px">Пробник "Bubber", Листовка, Магнит</td>
                    <td style="padding-left: 10px">1</td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>

<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-comment" data-toggle="tab">Комментарии (<?php echo $model->commentsCount ?>)</a>
    </li>
    <?php if (Yii::app()->user->checkAccess('backend.Print.*')): ?>
        <li><a href="#tab-print" data-toggle="tab">На печать</a></li>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('backend.Orders.Invoice')): ?>
        <li><a href="#tab-payment" data-toggle="tab">Платежи</a></li>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('backend.Orders.SandSms')): ?>
        <li><a href="#tab-sms" data-toggle="tab">Смс</a></li>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('backend.Orders.SandMail')): ?>
        <li><a href="#tab-mail" data-toggle="tab">Письмо</a></li>
    <?php endif; ?>

    <li><a href="#tab-history" data-toggle="tab">История</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="tab-comment">
        <div class="col-lg-12">
            <?php $this->widget('zii.widgets.CListView', array(
                'id' => 'order-comments',
                'dataProvider' => new CArrayDataProvider($model->comments),
                'itemView' => '//orderComment/_view',
                'emptyText' => false,
                'summaryText' => false
            )); ?>

            <?php $this->renderPartial('//orderComment/_form', array('model' => new OrderComment, 'order' => $model)) ?>
        </div>
    </div>
    <div class="tab-pane" id="tab-expenses">
        <div class="col-lg-12">
            <?php $this->renderPartial('//orderExpenses/_form', array('model' => new OrderExpenses, 'order' => $model)) ?>

            <?php $this->widget('zii.widgets.CListView', array(
                'id' => 'order-expenses',
                'dataProvider' => new CArrayDataProvider($model->expenses),
                'itemView' => '//orderExpenses/_view',
                'emptyText' => false,
                'summaryText' => false
            )); ?>
        </div>
    </div>

    <?php if (Yii::app()->user->checkAccess('backend.Print.*')): ?>
        <div class="tab-pane" id="tab-print">
            <div class="col-lg-12">
                <a href="<?php echo $this->createUrl('print', array('id' => $model->id, 'type' => 'box_label')) ?>"
                   target="_blank">Адрес
                    на коробку</a>
            </div>
            <div class="col-lg-12">
                <a href="<?php echo Yii::app()->createUrl('print/allOrderDocuments', array('Orders[id]' => $model->id)) ?>"
                   target="_blank">Бланки заказа</a>
            </div>
            <div class="col-lg-12">
                <a href="<?php echo Yii::app()->createUrl('orders/entityDocuments', array('id' => $model->id)) ?>"
                   target="_blank">Товарная накладная</a>
            </div>
            <div class="col-lg-12">
                <a href="<?php echo Yii::app()->createUrl('orders/entityInvoice', array('id' => $model->id)) ?>"
                   target="_blank">Счет-фактура</a>
            </div>
            <div class="col-lg-12">
                <a href="<?php echo Yii::app()->createUrl('orders/entityContract', array('id' => $model->id)) ?>"
                   target="_blank">Договор поставки</a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('backend.Orders.Invoice')): ?>
        <div class="tab-pane" id="tab-payment">
            <div class="col-lg-12">
                <?php echo 'http://' . Shop::model()->findByPk($model->shop_id)->domain . Yii::app()->createUrl('billing/payment', array('id' => $model->id)) ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('backend.Orders.SandMail')): ?>
        <div class="tab-pane" id="tab-mail">
            <div class="col-lg-12">
                <?php $this->renderPartial('_mail_form', array('order' => $model)) ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('backend.Orders.SendSms')): ?>
        <div class="tab-pane" id="tab-sms">
            <div class="col-lg-12">
                <?php $this->renderPartial('_sms_form', array('order' => $model)) ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="tab-pane" id="tab-history">
        <div class="col-lg-12 order-history">
            <?php foreach (OrderLog::getOrderHistory($model->id) as $record): ?>
                <div class="record">
                    <span class="user"><?php echo User::model()->findByPk($record->user_id)->login ?></span> |
                    <span class="date"><?php echo SHtml::toHumanDate($record->date) ?></span>
                    <span class="description"><?php echo $record->description ?></span>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>