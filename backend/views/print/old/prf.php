<?php
    /* @var $model Orders*/
?>

<img src="<?php echo Yii::app()->baseUrl?>/img/prf1.jpg" alt=""/>


<div id="sender">
    <div id="sender-address">
        <div id="sender-name">Коптелов Алексей Владленович</div>
        <span id="sender-index">197341</span>
        <span id="sender-city">Санкт-Петербург,</span>
        <div id="sender-street">Коломяжский проспект д. 28, корп. 2, кв. 96</div>
    </div>

    <div id="sender-passport">
        <div class="passport1">
            <span id="sender-passport-name">паспорт</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span id="sender-passport-number1">3220</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span id="sender-passport-number2">901887</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span id="sender-passport-data">28.10
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span>10</span></div>
        </div>
        <div id="sender-passport2">
            ОУФМС России по Кемеровской области в Яшкинском районе
        </div>
    </div>
</div>

<?php $address = $model->customerAddress; ?>
<div id="recipient1">
    <div id="recipient1-name"><?php echo $model->customer->name ?></div>
    <div id="recipient1-row-2">
        <span id="recipient1-index"><?php echo $address->zip ?></span>
        <span id="recipient1-city"><?php echo $address->city ?>,</span>
    </div>


    <div id="recipient1-area"><?php echo $address->area ?>,</div>
    <div id="recipient1-address"><?php echo $address->address ?></div>
</div>

<div id="recipient2">
    <div id="recipient2-name"><?php echo $model->customer->name ?></div>
    <div id="recipient1-row-2">
        <span id="recipient2-index"><?php echo $address->zip ?></span>
        <span id="recipient2-city"><?php echo $address->city ?>,</span>
    </div>
    <div id="recipient2-address"><?php echo $address->address ?></div>
</div>

<div id="price1">б/о</div>
<div id="price2">б/о</div>
<div id="order"><?php echo $model->id ?></div>