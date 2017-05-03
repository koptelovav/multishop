<?php
/* @var $this OrdersController */
/* @var $order Orders */
?>

<?php
if($order->payment->redirect)
    Yii::app()->clientScript->registerScript('paymentRedirect',"
    if(confirm('Перейти к оплате заказа?')){
        window.open('".Yii::app()->createUrl('billing/payment', array('id'=>$order->id))."', '_blank');
        window.focus();
    }
    ",CClientScript::POS_READY);
?>
<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">
            <h1>Ваш заказ №<?php echo $order->id ?> успешно оформлен!</h1>
            <p>
                На вашу почту <?php echo $order->customer->email ?> было выслано письмо с инструкциями.<br />
                В нем содержится информация о заказанных вами товарах, а также ссылки на оплату заказа.<br />
                Наш менеджер свяжется с вами и уточнит детали заказа. <br />
                <?php
                if($order->payment->redirect)
                echo CHtml::link('Перейти к оплате ->',array('billing/payment', 'id' => $order->id), array('id'=>'payment-link', 'target'=>'_blank'))
                ?>
            </p>
        </div>
    </div>
</div>