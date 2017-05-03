<div class="shipping-payment-menu dropdown--section--inside row">
    <div class="col-xs-6 shipping-menu">
        <a href="<?= Yii::app()->createUrl('/site/page', ['view' => 'shipping']) ?>" class="dropdown--section--link dropdown--section--large-link dropdown--section--link-title">
            Курьерская доставка и самовывоз в Москве
        </a>
        <ul class="dropdown--section--list">
            <li>
                Срок доставки 1-2 рабочих дня
            </li>
            <li>
                Беспллатная доставка при заказе от 1500 рублей
            </li>
            <li>
                Самовывоз: 42 пунктов выдачи заказов
            </li>
        </ul>

        <a href="<?= Yii::app()->createUrl('/site/page', ['view' => 'shipping']) ?>" class="dropdown--section--link dropdown--section--large-link dropdown--section--link-title">
            Курьерская доставка и самовывоз в Санкт-Петербурге
        </a>
        <ul class="dropdown--section--list">
            <li>
                Срок доставки 1-2 рабочих дня
            </li>
            <li>
                Беспллатная доставка при заказе от 1500 рублей
            </li>
            <li>
                Самовывоз: 27 пунктов выдачи заказов
            </li>
        </ul>

        <a href="<?= Yii::app()->createUrl('/site/page', ['view' => 'shipping_payment']) ?>" class="dropdown--section--link dropdown--section--large-link dropdown--section--link-title">
            Доставка по России
        </a>
        <ul class="dropdown--section--list">
            <li>
                Срок доставки заказа 4-12 дней (Зависит от способа доставки)
            </li>
            <li>
                Беспллатная доставка почтой России при заказе от 1500 рублей
            </li>
            <li>
                Самовывоз: 1270 пунктов выдачи закзов по всей России
            </li>
        </ul>
    </div>
    <div class="col-xs-offset-1 col-xs-5 payment-menu">
        <a href="<?= Yii::app()->createUrl('/site/page', ['view' => 'payment']) ?>" class="dropdown--section--link dropdown--section--large-link dropdown--section--link-title">
            Оплата
        </a>
        <ul class="dropdown--section--list">
            <li>
                <b>Наличными при получении:</b> при курьерской доставке и самовывозе в Москве и Санкт-Петербурге<br>
            </li>
            <li>
                Онлайн-оплата в нашем интернет-магазине: <b>банковской картой, электронными деньгами, по счету в банке</b>
            </li>
        </ul>
    </div>

    <a href="<?= Yii::app()->createUrl('/site/page', ['view' => 'shipping']) ?>" class="btn btn--blue shipping-payment-menu--button-read-more">
        <span class="btn--inside">
            <span class="btn--title">Подробнее</span>
        </span>
    </a>
</div>
