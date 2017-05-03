<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */

?>

<style type="text/css">
    #page{
          font-size: 18px;
      }
    .zip{
        font-size: 25px;
        letter-spacing: 10px;
        padding-top: 10mm;
    }

    #sender-label{
        position: absolute;
        top: 10mm;
        left: 10mm;
        font-size: 18px;
    }
    #recipient{
        position: absolute;
        top: 60mm;
        right: 30px;
        display: block;
        width: 85mm;
        font-size: 18px;
    }

    #number{
        position: absolute;
        left: 190mm;
        top: 10mm;
        color: #ccc;
    }
</style>

    <div id="number">
        <?php echo $model->id ?>
    </div>
    <div id="sender-label" style="width: 88mm;">
        <div class="name">Коптелов Алексей Владленович</div>
        <div class="city">Санкт-Петербург</div>
        <div class="address">Коломяжский проспект, 28/2 - 96</div>
        <div class="zip" style="text-align: right">197341</div>
    </div>
    <?php
    $customer = $model->customer;
    $customerAddress = $customer->address
    ?>
    <div id="recipient">
        <div class="name"><?php echo $customer->name ?></div>
        <?php if($customerAddress->area != $customerAddress->city): ?>
            <div class="region">
                <?php echo $customerAddress->area ?>
            </div>
        <?php endif ?>
        <div class="city">
            <?php echo $customerAddress->city ?>
        </div>
        <div class="address">
            <?php echo $customerAddress->address ?>
        </div>
        <div class="zip" style="text-align: right">
            <?php echo $customerAddress->zip ?>
        </div>
    </div>
