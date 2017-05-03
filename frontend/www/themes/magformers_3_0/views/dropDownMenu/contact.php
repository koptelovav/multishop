<div class="row dropdown--section--inside" itemscope itemtype="http://schema.org/LocalBusiness">
    <address>
        <div class="row contact-menu--item-row">
            <div class="col-xs-6">
                <span class="dropdown--section--title">Москва</span>
                <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span itemprop="postalCode">109387</span>,
                    <span itemprop="addressLocality">г. Москва</span>
                    <span itemprop="streetAddress">улица Люблинская 42, оф. 12</span><br/>
                    Телефон: <b><span itemprop="telephone">8 (499) 703-05-09</span></b>
                </p>
                <p>
                    Самовывоз: <b>42 пункта выдачи заказов</b>
                </p>
            </div>
            <div class="col-xs-6">
                <span class="dropdown--section--title">Россия</span>
                <p>
                    Телефон: <b>8 (499) 703-05-09</b><br/>
                    Самовывоз: <b>1000 пунктов выдачи заказов</b>
                </p>
            </div>
        </div>

        <div class="row contact-menu--item-row">
            <div class="col-xs-6">
                <span class="dropdown--section--title">Санкт-Петербург</span>
                <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span itemprop="postalCode">197082</span>,
                    <span itemprop="addressLocality">г. Санкт-Петербург</span>
                    <span itemprop="streetAddress">улица Туристская 23к2, оф. 20-Н</span><br/>
                    Телефон: <b><span itemprop="telephone"><?php echo Yii::app()->shop->phone ?></span></b>
                </p>
                <p>
                    Самовывоз: <b>27 пунктов выдачи заказов</b>
                </p>
            </div>

            <div class="col-xs-6">
                <span class="dropdown--section--title">Дополнительно</span>
                <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    Почта: <a
                        href="mailto:<?php echo Yii::app()->shop->email ?>"><b><?php echo Yii::app()->shop->email ?></b></a><br/>
                    ВКонтакте: <a href="https://vk.com/kineticsand" target="_blank"><b>vk.com/kineticsand</b></a>
                </p>
            </div>
        </div>
    </address>

    <div class="row contact-menu--item-row">
        <div class="col-xs-6">
            <span class="dropdown--section--title">График работы</span>
            <meta itemprop="name" content="ИП Коптелов Алексей Владленович">
            <p>Консультация по товарам / закам - <b><time itemprop="openingHours" datetime="Mo-Fr 10:00−18:00">ПН-ПТ с 10:00 до 20:00 | CБ-ВС выходной</time></b></p>
            <p>Онлайн-консультант - <b>Круглосуточно</b></p>
        </div>
        <div class="col-xs-6">
            <a href="<?= Yii::app()->createUrl('/site/contact') ?>" class="btn btn--blue contact-menu--button-read-all">
                <span class="btn--inside">
                    <span class="btn--title">Подробнее</span>
                </span>
            </a>
        </div>
    </div>
</div>
