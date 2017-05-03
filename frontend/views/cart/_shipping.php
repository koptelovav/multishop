<?php if ($shippingDiscount): ?>
    <p style="color: #7a0000">На ваш заказ распространяется скидка на доставку в
        размере <?php echo SHtml::toPrice($shippingDiscount) ?>. Стоимость доставки указана с учетом скидки.</p>
<?php endif; ?>

    <div class="item-container">
        <h4>1. Выберите способ доставки</h4>

        <div class="locked-container-hidden">
        <span class="radio-container">
            <?php echo CHtml::radiobuttonlist('CartForm[shippingType]', $cartForm->shippingType, array(
                Shipping::TYPE_SPB => 'Доставка и самовывоз в Санкт-Петербурге',
                Shipping::TYPE_MSC => 'Доставка и самовывоз в Москве',
                Shipping::TYPE_MO => 'Доставка по Московской области',
                Shipping::TYPE_RUS => 'Доставка по России'
            ), array('data-container' => '#shipping-type-container')) ?>
        </span>
        </div>
    </div>

<?php switch ($cartForm->shippingType): ?>
<?php case Shipping::TYPE_MSC: ?>
        <h4>1.1 Уточните тип доставки</h4>
        <div class="radio-container row-striped">
            <div class="row shipping-row">
                <div class="col-xs-12 col-lg-7">
                    <input id="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_MSK ?>"
                           value="<?php echo Shipping::GLAVPUNKT_MSK ?>" type="radio"
                           name="CartForm[shipping]" <?php echo $cartForm->shipping == Shipping::GLAVPUNKT_MSK ? 'checked="checked"' : '' ?>>
                    <label for="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_MSK ?>">
                        Доставка курьером (в прделах МКАД)
                    </label>
                </div>
                <div class="col-xs-6 col-lg-2">
                    1-2 рабочих дня
                </div>
                <div class="col-xs-6 col-lg-3 price">
                    <?php echo SHtml::toPrice($cartForm->shippingVariants[34]['price']) ?>
                </div>
            </div>

            <div class="row shipping-row">
                <div class="col-xs-12 col-lg-7">
                    <input id="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_MSK_STORE ?>"
                           value="<?php echo Shipping::GLAVPUNKT_MSK_STORE ?>" type="radio"
                           name="CartForm[shipping]" <?php echo $cartForm->shipping == Shipping::GLAVPUNKT_MSK_STORE ? 'checked="checked"' : '' ?>>
                    <label for="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_MSK_STORE ?>">
                        Самовывоз из пункта выдачи заказов
                    </label>
                </div>
                <div class="col-xs-6 col-lg-2">
                    1-2 рабочих дня
                </div>
                <div class="col-xs-6 col-lg-3 price">
                    <?php echo SHtml::toPrice($cartForm->shippingVariants[56]['price']) ?>
                </div>
            </div>
        </div>
        <?php break ?>

    <?php case Shipping::TYPE_SPB: ?>
        <h4>1.1 Уточните тип доставки</h4>
        <div class="radio-container row-striped">
            <div class="row shipping-row">
                <div class="col-xs-12 col-sm-7">
                    <input id="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_SPB ?>"
                           value="<?php echo Shipping::GLAVPUNKT_SPB ?>" type="radio"
                           name="CartForm[shipping]" <?php echo $cartForm->shipping == Shipping::GLAVPUNKT_SPB ? 'checked="checked"' : '' ?>>
                    <label for="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_SPB ?>">
                        Самовывоз из пункта выдачи заказов
                    </label>
                </div>
                <div class="col-xs-6 col-sm-2">
                    1-2 рабочих дня
                </div>
                <div class="col-xs-6 col-sm-3 price">
                    <?php echo SHtml::toPrice($cartForm->shippingVariants[35]['price']) ?>
                </div>
            </div>

            <div class="row shipping-row">
                <div class="col-xs-12 col-sm-7">
                    <input id="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_SPB_COURIER ?>"
                           value="<?php echo Shipping::GLAVPUNKT_SPB_COURIER ?>" type="radio"
                           name="CartForm[shipping]" <?php echo $cartForm->shipping == Shipping::GLAVPUNKT_SPB_COURIER ? 'checked="checked"' : '' ?>>
                    <label for="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_SPB_COURIER ?>">
                        Доставка курьером (в пределах КАД)
                    </label>
                </div>
                <div class="col-xs-6 col-sm-2">
                    1-2 рабочих дня
                </div>
                <div class="col-xs-6 col-sm-3 price">
                    <?php echo SHtml::toPrice($cartForm->shippingVariants[31]['price']) ?>
                </div>
            </div>

            <div class="row shipping-row">
                <div class="col-xs-12 col-sm-7">
                    <input id="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_SPB_COURIER_LO ?>"
                           value="<?php echo Shipping::GLAVPUNKT_SPB_COURIER_LO ?>" type="radio"
                           name="CartForm[shipping]" <?php echo $cartForm->shipping == Shipping::GLAVPUNKT_SPB_COURIER_LO ? 'checked="checked"' : '' ?>>
                    <label for="CartForm_shipping_<?php echo Shipping::GLAVPUNKT_SPB_COURIER_LO ?>">
                        Доставка курьером (за пределы КАД)
                    </label>
                </div>
                <div class="col-xs-6 col-sm-2">
                    1-2 рабочих дня
                </div>
                <div class="col-xs-6 col-sm-3 price">
                    <?php echo SHtml::toPrice($cartForm->shippingVariants[32]['price']) ?>
                </div>
            </div>
        </div>
        <?php break ?>

    <?php case Shipping::TYPE_RUS: ?>
    <?php case Shipping::TYPE_MO: ?>
        <h4>1.1. Введите Ваш индекс и нажмите на синию кнопку "рассчитать" для расчета доставки</h4>
        <p>
            Свой индекс можно узнать здесь <a href="http://ruspostindex.ru/" target="_blank">http://ruspostindex.ru/</a>
        </p>
        <div id="CartForm_shipping" class="form-group">
            <?php echo $form->labelEx($cartForm, 'zip', array('class' => 'col-lg-3 control-label')); ?>
            <div class="col-lg-4">
                <div class="input-group">
                    <?php echo $form->textField($cartForm, 'zip', array('class' => 'form-control')); ?>
                    <span class="input-group-btn">
                                    <button class="btn btn--small btn--blue" id="shipping_calculate">
                                        <span class="btn--inside">Рассчитать</span>
                                    </button>
                                </span>
                </div>
            </div>
        </div>

        <?php if (!empty($cartForm->shippingVariants)): ?>
            <div class="radio-container">
                <div class="row">
                    <div class="col-lg-1">&nbsp;</div>
                    <div class="col-lg-5">Название</div>
                    <div class="col-lg-3">Сроки доставки</div>
                    <div class="col-lg-3">Стоимость</div>
                </div>
                <?php foreach ($cartForm->getShipping() as $shipping): ?>
                    <div class="row shipping-row"
                         id="s_code_<?php echo $shipping->edost_code ?>" <?php echo isset($cartForm->shippingVariants[$shipping->edost_code]) ? '' : 'style="display:none"' ?>>
                        <div class="col-xs-1 col-lg-1">
                            <input id="CartForm_shipping_<?php echo $shipping->id ?>"
                                   value="<?php echo $shipping->id ?>" type="radio"
                                   name="CartForm[shipping]" <?php echo $cartForm->shipping == $shipping->id ? 'checked="checked"' : '' ?>>
                        </div>
                        <div class="col-lg-5">
                            <label for="CartForm_shipping_<?php echo $shipping->id ?>">
                                <?php echo $shipping->name ?>
                            </label>
                        </div>
                        <div class="col-lg-3 text-right">
                            <?php echo $shipping->times; ?>
                        </div>
                        <div class="col-lg-3 text-right price">
                            <?php echo SHtml::toPrice($shipping->price); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php break ?>
    <?php endswitch ?>

<?php switch ($cartForm->shipping): ?>
<?php case Shipping::CDEK_STORE_SHIPPING: ?>
        <h4>1.1. Выберите пункт самовывоза</h4>
        <div class="row radio-container">
            <div class="col-lg-9">
                <?php foreach ($cartForm->pvzList as $pvz): ?>
                    <?php if ($pvz['code'] != 'SPB4'): ?>
                        <div class="row shipping-row">
                            <div class="col-lg-1">
                                <input id="CartForm_shipping_<?php echo $pvz['code'] ?>"
                                       value="<?php echo $pvz['code'] ?>" type="radio"
                                       name="CartForm[pvz]" <?php echo $pvz['code'] == $cartForm->pvz ? 'checked="checked"' : '' ?>>
                            </div>
                            <div class="col-lg-11">
                                <label for="CartForm_shipping_<?php echo $pvz['code'] ?>">
                                    <?php echo $pvz['name'] ?> | <?php echo $pvz['address'] ?>
                                </label>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
        <?php break ?>

    <?php case Shipping::GLAVPUNKT_MSK_STORE: ?>
        <h4>1.1. Выберите пункт самовывоза</h4>
        <div class="radio-container row-striped">
            <?php foreach (Yii::app()->glavpunkt->punkts(false) as $pvz): ?>
                <div class="row">
                    <div class="col-xs-12">
                        <label for="CartForm_shipping_<?php echo $pvz['code'] ?>">
                        <input id="CartForm_shipping_<?php echo $pvz['code'] ?>" value="<?php echo $pvz['code'] ?>"
                               type="radio"
                               name="CartForm[pvz]" <?php echo $pvz['code'] == $cartForm->pvz ? 'checked="checked"' : '' ?>>
                            <?php echo $pvz['name'] ?> | <?php echo $pvz['address'] ?>
                        </label>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <?php break ?>

    <?php case Shipping::GLAVPUNKT_SPB: ?>
        <h4>1.1. Выберите пункт самовывоза</h4>
        <div class="radio-container row-striped">
                <?php foreach (Yii::app()->glavpunkt->punkts() as $pvz): ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="CartForm_shipping_<?php echo $pvz['code'] ?>">
                            <input id="CartForm_shipping_<?php echo $pvz['code'] ?>" value="<?php echo $pvz['code'] ?>"
                                   type="radio"
                                   name="CartForm[pvz]" <?php echo $pvz['code'] == $cartForm->pvz ? 'checked="checked"' : '' ?>>

                                <?php echo $pvz['name'] ?> | <?php echo $pvz['address'] ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach ?>
        </div>
        <?php break ?>
    <?php endswitch ?>