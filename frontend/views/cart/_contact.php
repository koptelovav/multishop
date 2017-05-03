<h4>3. Заполните основную информацию</h4>

<div class="form-group">
    <?php echo $form->labelEx($cartForm, 'name', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-7">
        <?php echo $form->textField($cartForm, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($cartForm, 'phone', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-7">
        <?php
        $this->widget('CMaskedTextField', array(
            'model' => $cartForm,
            'attribute' => 'phone',
            'mask' => '+7-999-999-9999',
            'placeholder' => '*',
            'htmlOptions' => array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($cartForm, 'email', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-7">
        <?php echo $form->textField($cartForm, 'email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 64)); ?>
    </div>
</div>
<div class="form-group">
    <p></p>
</div>

<div class="form-group">
    <?php echo $form->labelEx($cartForm, 'city', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-7">
        <?php echo $form->textField($cartForm, 'city', array('class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($cartForm, 'area', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-7">
        <?php echo $form->textField($cartForm, 'area', array('class' => 'form-control')); ?>
    </div>
</div>

<?php if ($cartForm->shipping != Shipping::GLAVPUNKT_SPB &&
            $cartForm->shipping != Shipping::CDEK_STORE_SHIPPING &&
            $cartForm->shipping != Shipping::CDEK_SPB &&
            $cartForm->shipping != Shipping::GLAVPUNKT_MSK_STORE): ?>
    <div class="form-group">
        <?php echo $form->labelEx($cartForm, 'street', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-7">
            <?php echo $form->textField($cartForm, 'street', array('class' => 'form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($cartForm, 'house', array('class' => 'col-lg-3 control-label')); ?>
        <div class="col-lg-2">
            <?php echo $form->textField($cartForm, 'house', array('class' => 'form-control')); ?>
        </div>
        <?php echo $form->labelEx($cartForm, 'apartment', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-2">
            <?php echo $form->textField($cartForm, 'apartment', array('class' => 'form-control')); ?>
        </div>
    </div>
<?php endif; ?>

<div class="form-group">
    <?php echo $form->labelEx($cartForm, 'comment', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-7">
        <?php echo $form->textArea($cartForm, 'comment', array('class' => 'form-control', 'rows' => 5)); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-3">
        <div class="checkbox">
            <label style="font-weight:bold">
                <?php echo $form->checkBox($cartForm, 'subscribe'); ?> Хочу получать информацию о скидках и акциях
                магазина (смс, email)
            </label>
        </div>
    </div>
</div>

<?php if($text = $cartForm->getShippingModel()->send_no_call): ?>
<h4>4. Необходим ли звонок менеджера?</h4>
<div class="form-group">
    <div class="col-lg-offset-3">
        <div class="checkbox">
            <label style="font-weight:bold">
                <?php
                $accountStatus = array(CartForm::SEND_NO_CALL=>$text, CartForm::SEND_BEFORE_CALL=>'Да, у меня остались вопросы по заказу.');
                echo $form->radioButtonList($cartForm,'send_no_call',$accountStatus,array('separator'=>'<br/>'));
                ?>
            </label>
        </div>
    </div>
</div>
<?php else: ?>
    <?php  $cartForm->send_no_call = CartForm::SEND_BEFORE_CALL?>
<?php endif;?>