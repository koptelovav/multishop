
<img src="<?php echo Yii::app()->baseUrl?>/img/dels.jpg" alt=""/>
<div id="dels-sender-company">ИП Коптелов Алексей Владленович</div>
<div id="dels-sender-name">Коптелов Алексей Владленович</div>
<div id="dels-sender-phone">+7-960-285-2040</div>
<div id="dels-sender-city">Санкт-Петербург</div>
<div id="dels-sender-country">Россиия</div>
<div id="dels-sender-index">197341</div>
<div id="dels-sender-address">Туристская 23к1, пом. 29-Н</div>

<div id="dels-sender">Коптелов А.В.</div>

<?php $address = $model->customerAddress; ?>

<div id="dels-recipient-name"><?php echo $model->customer->name ?></div>
<div id="dels-recipient-phone"><?php echo $model->customer->phone ?></div>
<div id="dels-recipient-city">Москва</div>
<div id="dels-recipient-country">Россия</div>
<div id="dels-recipient-address"><?php echo $address->getFullCityAddress() ?></div>

<div id="dels-delivery-mode">X</div>
