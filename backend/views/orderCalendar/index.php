<h2><?php echo $month ?></h2>
<div id="calendar">
    <?php foreach ($days as $dayNumber=>$data): ?>
        <div class="day">
            <div class="day-number"><?php echo $dayNumber ?></div>
            <?php foreach ($data as $order): ?>
                <div class="order">
                    <?php echo Chtml::link($order->id, array('orders/view','id'=>$order->id), array('target'=>'_blank')) ?>
                </div>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>
