<?php if($cartForm->shipping):?>
    <h4>2. Выберите тип оплаты</h4>
    <span class="radio-container">
        <?php echo CHtml::radiobuttonlist('CartForm[payment]',$cartForm->payment, CHtml::listData($cartForm->getPayment(),'id','user_name'))?>
    </span>
<?php endif; ?>