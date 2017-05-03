<h3>Товары в корзине</h3>

<div id="view-cart">
    <div class="view-cart-header hidden-xs row">
        <div class="col-md-2 col-lg-2">&nbsp;</div>
        <div class="col-md-4 col-lg-4">Название</div>
        <div class="col-md-2 col-lg-2">Цена за штуку</div>
        <div class="col-md-2 col-lg-2">Количество</div>
        <div class="col-md-2 col-lg-2">Сумма</div>
    </div>
    <div class="view-cart-body">
        <?php foreach(Yii::app()->session['client_data']['products'] as $productHash => $data):?>
            <div class="row">
                <div class="col-xs-4 col-md-2 col-lg-2">
                    <?php echo CHtml::link(
                        CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $data['image']), $data['short_title'],array('class'=>'img-responsive')),
                        array('products/view', 'id' => $data['id'])) ?>
                </div>

                <div class="col-xs-8 col-md-4 col-lg-4">
                    <?php echo CHtml::link(
                        $data['title'],
                        array('products/view', 'id' => $data['id']),
                        array('class' => 'product-link')
                    );?>
                    <br>
                    <span class="gray"><?= $data['attributeString']?></span>
                </div>

                <div class="col-xs-2 col-md-2 col-lg-2">
                    <?php echo SHtml::toPrice($data['price']); ?>
                </div>

                <div class="col-xs-3 col-md-2 col-lg-2">
                    <?php
                    $html = CHtml::link('&nbsp', '#', array('class' => 'glyphicon glyphicon-minus cart-sub'));
                    $html .= CHtml::textField('CartForm[cartProducts]['.$productHash.']',$data['count'], array('size'=>2,'class'=>'product-count'));
                    $html .= CHtml::link('&nbsp', '#', array('class' => 'glyphicon glyphicon-plus cart-add'));
                    echo $html;
                    ?>
                </div>
                <div class="col-xs-2 col-md-2 col-lg-2">
                    <?php echo SHtml::toPrice($data['count'] * $data['price']) ?>
                </div>
            </div>
        <?php endforeach?>
        <?php $saving = 0;?>
        <?php foreach($giftDataProvider->getData() as $data):?>
            <div class="row">
                <div class="col-xs-4 col-md-2 col-lg-2">
                    <?php echo CHtml::link(
                        CHtml::image(Yii::app()->image->createUrl('mini', Yii::app()->media->webroot . $data->image)),
                        array('products/view', 'id' => $data->id)
                    );?>
                </div>
                <div class="col-xs-8 col-md-4 col-lg-4">
                    <?php echo $data->short_title?>
                </div>
                <div class="col-xs-2 col-md-2 col-lg-2">
                    <span style="color: #7a0000">Подарок</span>
                </div>
                <div class="col-xs-3 col-md-2 col-lg-2">
                    <?php echo Yii::app()->session['client_data']['gifts'][$data->id] ?>
                </div>
                <div class="col-xs-2 col-md-2 col-lg-2">
                    <?php $saving += $data->price*Yii::app()->session['client_data']['gifts'][$data->id]; ?>
                    <del><?= SHtml::toPrice($data->price) ?></del>
                    <br> <span style="color: #7a0000">Бесплатно</span>
                </div>
            </div>

        <?php endforeach?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-total">
            <tr id="total-product">
                <td>
                    Товаров на сумму
                </td>
                <td class="price">
                    <?php echo SHtml::toPrice($cartForm->getTotalProducts()) ?>
                </td>
            </tr>

            <tr id="shipping">
                <td>
                    Стоимость достаки
                </td>
                <td class="price">
                    <?php if($cartForm->shipping):?>
                        <?php echo SHtml::toPrice($cartForm->getTotalShipping()) ?>
                    <?php else: ?>
                        Способ доставки не выбран
                    <?php endif ?>
                </td>
            </tr>


            <tr id="discount" <?php echo $cartForm->discount ? '' : 'style="display: none;"' ?>>
                <td>
                    Скидка
                </td>
                <td class="price">
                    <?php echo $cartForm->discount ?>%
                </td>
            </tr>

            <?php if($saving):?>
                <tr id="shipping">
                    <td>
                        Экономия
                        <span class="title">В том числе стоимость подарков</span>
                    </td>
                    <td class="price">
                        <?php echo SHtml::toPrice($saving) ?>
                    </td>
                </tr>
            <?php endif; ?>

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

<div class="row">
    <div class="col-lg-9 col-lg-offset-3">
        Внимание! Скидка по промокоду не действует на товары со скидкой.
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="CartForm_promoCode" class="form-group">
            <label class="col-lg-3 control-label" for="CartForm_promoCode ">Промокод</label>
            <div class="col-lg-4">
                <div class="input-group">
                    <?php echo $form->textField($cartForm, 'promoCode', array('class' => 'form-control')); ?>
                    <span class="input-group-btn">
                                <button class="btn btn-primary" id="check_promo">Проверить</button>
                            </span>
                </div>
            </div>
        </div>
    </div>
</div>