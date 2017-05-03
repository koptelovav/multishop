<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */

?>

<script type="text/javascript">
    window.onload = function(){window.print();}
/*    window.onfocus = function() { window.close(); }*/
</script>

<style type="text/css">
    #page{
          font-size: 18px;
      }
    .zip{
        font-size: 25px;
        letter-spacing: 10px;
        padding-top: 10mm;
    }

    #sender{
        position: absolute;
        top: 10mm;
        left: 10mm;
    }
    #recipient{
        position: absolute;
        top: 60mm;
        left: 118mm;
    }

    #number{
        position: absolute;
        left: 190mm;
        top: 10mm;
        color: #ccc;
    }
</style>

<div id="page" style="width: 210mm;height: 297mm; display: inline-block">
    <div id="number">
        <?php echo $model->id ?>
    </div>
    <div id="sender" style="width: 88mm;">
        <div class="name">Коптелов Алексей Владленович</div>
        <div class="city">Санкт-Петербург</div>
        <div class="address">Коломяжский проспект, 28/2 - 96</div>
        <div class="zip" style="text-align: right">197341</div>
    </div>
    <div id="recipient" style="width: 88mm;">
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
</div>