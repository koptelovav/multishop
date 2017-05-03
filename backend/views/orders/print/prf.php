<?php
    /* @var $model Orders*/
?>
<style type="text/css">
    *{
        font-weight: bold;
        font-size: 14px;
    }
    img{
        width: 130mm;
    }

    .index{
        letter-spacing: 10px
    }

    #sender,
    #recipient1,
    #recipient2,
    #price1,
    #price2,
    #order{
        position: absolute;
    }
    #sender{
        top: 298px;
        left: 49px;
        line-height: 20px;
    }

    #sender .passport1 > div,
    #sender .index,
    #sender .city,
    #recipient1 .index,
    #recipient1 .city,
    #recipient2 .index,
    #recipient2 .city{
        display: inline-block;
    }

    #sender .address{padding-left: 47px;}
    #sender .street{margin-left: -40px}
    #sender .name{padding-left: 5px;}
    #sender .passport{padding-top: 35px;}
    #sender .passport1 .name{padding-left: 83px;}
    #sender .passport1 .number1{padding-left: 40px;}
    #sender .passport1 .number2{padding-left: 26px;}
    #sender .passport1 .data{padding-left: 42px;}
    #sender .passport1 .data span{padding-left: 26px;}
    #sender .passport2 {padding-top: 5px;padding-left: 10px}

    #recipient1{
        top: 219px;
        left: 46px;
    }

    #order{
        top: 22px;
        left: 450px;
    }

    #recipient2{
        top: 578px;
        left: 50px;
    }

    #recipient1 .name{padding-left: 48px;}
    #recipient1 .index{padding-left: 48px;}
    #recipient1 .address,#recipient1 .area{padding-top: 4px;padding-left: 10px}

    #recipient2 .name{padding-left: 48px;}
    #recipient2 .index{padding-left: 48px;}
    #recipient2 .address{padding-top: 4px;padding-left: 10px}

    #price1{
        top: 179px;
        left: 197px;
    }

    #price2{
        top: 558px;
        left: 142px;
    }

</style>
<script type="text/javascript">
    window.onload = function(){window.print();}
    window.onfocus = function() { window.close(); }
</script>
<img src="<?php echo Yii::app()->baseUrl?>/img/prf1.jpg" alt=""/>


<div id="sender">
    <div class="address">
        <div class="name">Коптелова Алексея Владленовича</div>
        <div class="index">197341</div>
        <div class="city">Санкт-Петербург,</div>
        <div class="street">Коломяжский проспект д. 28, корп. 2, кв. 96</div>
    </div>

    <div class="passport">
        <div class="passport1">
            <div class="name">паспорт</div>
            <div class="number1">3220</div>
            <div class="number2">901887</div>
            <div class="data">28.10 <span>10</span></div>
        </div>
        <div class="passport2">
            ОУФМС России по Кемеровской области в Яшкинском районе
        </div>
    </div>
</div>

<?php $address = $model->customerAddress; ?>
<div id="recipient1">
    <div class="name"><?php echo $model->customer->name ?></div>
    <div class="index"><?php echo $address->zip ?></div>
    <div class="city"><?php echo $address->city ?>,</div>
    <div class="area"><?php echo $address->area ?>,</div>
    <div class="address"><?php echo $address->address ?></div>
</div>

<div id="recipient2">
    <div class="name"><?php echo $model->customer->name ?></div>
    <div class="index"><?php echo $address->zip ?></div>
    <div class="city"><?php echo $address->city ?>, <?php echo $address->area ?>,</div>
    <div class="address"><?php echo $address->address ?></div>
</div>

<div id="price1">б/о</div>
<div id="price2">б/о</div>
<div id="order"><?php echo $model->id ?></div