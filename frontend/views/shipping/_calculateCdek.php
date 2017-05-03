<?php
$courierPrice = $data[38]['price'];
$storePrice = $data[37]['price'];
?>
<div class="cdek-shipping">
    <?php if (!$courierPrice && !$storePrice):?>
    <p>
        Для Вашего города доступны только экспресс тарифы. Для уточнения стоимости обратитесь к нашим менеджерам
    </p>
    <?php else: ?>
    <p>
        <?php if($courierPrice): ?>
             <b>Достака курьером до двери:</b>  <?= SHtml::toPrice($courierPrice) ?>*<br/>
        <?php endif; ?>

        <?php if($storePrice): ?>
            <b>Достака до пункта самовывоза:</b>  <?= SHtml::toPrice($storePrice) ?>*
        <?php endif; ?>
    </p>

    <p class="cdek-shipping-note">
       <i>* Стоимость доставки расчитана при весе посылки в 3кг. Для точного расчта доставки положите необходимые товары в корзину, перейдите в корзину и выберите необходимый тип достаки.</i>
    </p>
    <?php endif; ?>
</div>