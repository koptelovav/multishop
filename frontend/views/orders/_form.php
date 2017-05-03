<?php
$regions = array(
    ''=>'==Выберите регион==',
    1020=>"Санкт-Петербург",
    1019=>"Москва",
    2220=>"Алтайский край",
    2226=>"Амурская область",
    2227=>"Архангельская область",
    2228=>"Астраханская область",
    2281=>"Байконур",
    2229=>"Белгородская область",
    2230=>"Брянская область",
    2231=>"Владимирская область",
    2232=>"Волгоградская область",
    2233=>"Вологодская область",
    2234=>"Воронежская область",
    2275=>"Еврейская АО",
    2273=>"Забайкальский край",
    2235=>"Ивановская область",
    2236=>"Иркутская область",
    2205=>"Кабардино-Балкарская Республика",
    2237=>"Калининградская область",
    2238=>"Калужская область",
    2239=>"Камчатский край",
    2207=>"Карачаево-Черкесская Республика",
    2240=>"Кемеровская область",
    2241=>"Кировская область",
    2242=>"Костромская область",
    2221=>"Краснодарский край",
    2222=>"Красноярский край",
    2243=>"Курганская область",
    2244=>"Курская область",
    2245=>"Ленинградская область",
    2246=>"Липецкая область",
    2247=>"Магаданская область",
    2248=>"Московская область",
    2249=>"Мурманская область",
    2276=>"Ненецкий АО",
    2250=>"Нижегородская область",
    2251=>"Новгородская область",
    2252=>"Новосибирская область",
    2253=>"Омская область",
    2254=>"Оренбургская область",
    2255=>"Орловская область",
    2256=>"Пензенская область",
    2257=>"Пермский край",
    2223=>"Приморский край",
    2258=>"Псковская область",
    2199=>"Республика Адыгея",
    2202=>"Республика Алтай",
    2200=>"Республика Башкортостан",
    2201=>"Республика Бурятия",
    2203=>"Республика Дагестан",
    2204=>"Республика Ингушетия",
    2206=>"Республика Калмыкия",
    2208=>"Республика Карелия",
    2209=>"Республика Коми",
    2282=>"Республика Крым",
    2210=>"Республика Марий Эл",
    2211=>"Республика Мордовия",
    2212=>"Республика Саха (Якутия)",
    2213=>"Республика Северная Осетия - Алания",
    2214=>"Республика Татарстан",
    2215=>"Республика Тыва",
    2217=>"Республика Хакасия",
    2259=>"Ростовская область",
    2260=>"Рязанская область",
    2261=>"Самарская область",
    2262=>"Саратовская область",
    2263=>"Сахалинская область",
    2264=>"Свердловская область",
    2265=>"Смоленская область",
    2224=>"Ставропольский край",
    2266=>"Тамбовская область",
    2267=>"Тверская область",
    2268=>"Томская область",
    2269=>"Тульская область",
    2270=>"Тюменская область",
    2216=>"Удмуртская Республика",
    2271=>"Ульяновская область",
    2225=>"Хабаровский край",
    2277=>"Ханты-Мансийский АО",
    2272=>"Челябинская область",
    2218=>"Чеченская Республика",
    2219=>"Чувашская Республика",
    2278=>"Чукотский АО",
    2279=>"Ямало-Ненецкий АО",
    2274=>"Ярославская область");

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'orders-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        "class" => "form-horizontal simple-text"
    )
)); ?>

    <div style="color: #ac2925;font-weight: bold">
        <?php echo $form->errorSummary(array($customer, $order, $customerAddress)); ?>
    </div>

<div class="row">
    <div class="col-lg-6">
        <h4>Основная информация</h4>

        <div class="form-group">
            <?php echo $form->labelEx($customer, 'name', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php echo $form->textField($customer, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($customer, 'phone', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $customer,
                    'attribute' => 'phone',
                    'mask' => '+7-999-999-9999',
                    'placeholder' => '*',
                    'htmlOptions' => array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($customer, 'email', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php echo $form->textField($customer, 'email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 64)); ?>
            </div>
        </div>

        <h4>Адрес</h4>

        <div class="form-group">
            <?php echo $form->label($customerAddress, 'city', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php echo $form->textField($customerAddress, 'city', array('class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->label($customerAddress, 'area', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php echo $form->dropDownList($customerAddress, 'area', $regions, array('class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->label($customerAddress, 'zip', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php echo $form->textField($customerAddress, 'zip', array('class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->label($customerAddress, 'street', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php echo $form->textField($customerAddress, 'street', array('class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($order, 'comment', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-7">
                <?php echo $form->textArea($order, 'comment', array('class' => 'form-control', 'rows' => 5)); ?>
            </div>
        </div>




    </div>
    <div class="col-lg-6">
        <?php if(is_array($orderShipping)): ?>
            <h4>Доставка</h4>

            <h4>Оплаты</h4>

            <div id="payment-row" class="form-group">

                <div class="col-lg-12">
                <span id="Order_payment_id">
                <?php foreach ($order->shipping->payments as $key => $payment): ?>
                    <input id="Orders_payment_id_<?php echo $key ?>" value="<?php echo $payment->id ?>" type="radio"
                           name="Orders[payment_id]">
                    <label for="Orders_payment_id_<?php echo $key ?>">
                        <?php echo $payment->name ?>
                        <?php if ($payment->id == 4): ?>
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/payment.png" alt=""/>
                        <?php endif ?>
                    </label>
                    <br>
                <?php endforeach; ?>
            </span>
                </div>
            </div>
        <?php else: ?>
            <h4>Доставка и оплата</h4>

            <div class="row">
                <div class="col-lg-12">Введите Ваш адрес для получения полной информации по доставке и оплате</div>
            </div>
        <?php endif ?>



        <h4>Новости и акции</h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($customer, 'subscribe'); ?> Подписаться на рассылку новостей от
                        магазина <?php echo Yii::app()->shop->name ?> (BambooGroup)?
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-lg-6 text-left">
            <a class="btn btn-danger btn-lg" href="<?= Yii::app()->homeUrl ?>">
                &larr; Отмена
            </a>
        </div>
        <div class="col-lg-6 text-right">
            <button type="submit" class="btn btn-danger btn-lg" href="<?= Yii::app()->createUrl('orders/create') ?>">
                Оформить &rarr;
            </button>
        </div>
    </div>

<?php $this->endWidget(); ?>