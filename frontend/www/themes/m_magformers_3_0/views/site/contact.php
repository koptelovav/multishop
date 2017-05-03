<?php
$this->pageTitle = 'Контакты';
?>

<h1>Контакты</h1>
<div class="row" itemscope itemtype="http://schema.org/LocalBusiness">
    <div class="col-xs-12">
        <address>
            <div>
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

            <div>
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

            <div>
                <span class="dropdown--section--title">Россия</span>
                <p>
                    Телефон: <b>8 (499) 703-05-09</b><br/>
                    Самовывоз: <b>1000 пунктов выдачи заказов</b>
                </p>
            </div>


            <div>
                <span class="dropdown--section--title">Дополнительно</span>
                <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    Почта: <a
                        href="mailto:<?php echo Yii::app()->shop->email ?>"><b><?php echo Yii::app()->shop->email ?></b></a><br/>
                    ВКонтакте: <a href="https://vk.com/kineticsand"
                                  target="_blank"><b>vk.com/kineticsand</b></a>
                </p>
            </div>
        </address>

        <div class="row contact-menu--item-row">
            <div class="col-xs-12">
                <span class="dropdown--section--title">График работы</span>
                <p>Консультация по товарам / закам - <b>
                        <time itemprop="openingHours" datetime="Mo-Su 10:00−20:00">Ежедневно с 10:00 до 20:00</time>
                    </b></p>
                <p>Онлайн-консультант - <b>Круглосуточно</b></p>
            </div>
        </div>

        <div class="row contact-menu--item-row">
            <div class="col-xs-12">
                <span class="dropdown--section--title">Реквизиты</span>

                <dl class="dl-horizontal">
                    <dd itemprop="name">ИП Коптелов Алексей Владленович</dd>
                    <dt>ИНН</dt>
                    <dd>424623808213</dd>
                    <dt>ОГРНИП</dt>
                    <dd>313424629000016</dd>
                    <dt>ИНН</dt>
                    <dd>424623808213</dd>
                    <dt>Р/С</dt>
                    <dd>40802810902100009816 в ОАО АКБ "Авангард"</dd>
                    <dt>К/С</dt>
                    <dd>30101810000000000201</dd>
                    <dt>БИК</dt>
                    <dd>044525201</dd>
                </dl>
            </div>
        </div>
    </div>
</div>