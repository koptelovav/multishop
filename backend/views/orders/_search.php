<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'orders-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
    )
));
?>

    <fieldset>
        <table>
            <tr>
                <td>
                    <?php echo $form->label($order, 'id', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($order, 'id', array('class' => 'form-control', 'size' => 4, 'maxlength' => 128)); ?>
                </td>
                <td>
                    <?php echo $form->label($order, 'status', array('class' => 'control-label')); ?>
                    <?php echo $form->dropDownList($order, 'status', CHtml::listData(OrderStatus::model()->findAll(), 'id', 'name'), array('class' => 'form-control','empty'=>'')); ?>
                </td>
                <td>
                    <?php echo $form->label($order, 'payment_status', array('class' => 'control-label')); ?>
                    <?php echo $form->dropDownList($order, 'payment_status', CHtml::listData(OrderPaymentStatus::model()->findAll(), 'id', 'name'), array('class' => 'form-control','empty'=>'')); ?>
                </td>
                <td>
                    <?php echo $form->label($order, 'shipping_id', array('class' => 'control-label')); ?>
                    <?php echo $form->dropDownList($order, 'shipping_id', CHtml::listData(Shipping::model()->findAll(), 'id', 'name'), array('class' => 'form-control','empty'=>'')); ?>
                </td>
            </tr>
        </table>

        <hr/>

        <table>
            <tr>
                <td>
                    <?php echo $form->label($order, 'formed_date', array('class' => 'control-label')); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'model' => $order,
                        'attribute' => 'formed_date',
                        // additional javascript options for the date picker plugin
                        'options'=>array(
                            'dateFormat' => 'yy-mm-dd',
                            'showAnim'=>'fold',
                        ),
                        'htmlOptions'=>array(
                            'style'=>'height:20px;'
                        ),
                    ));

                    ?>
                </td>

                <td>
                    <?php echo $form->label($order, 'update_payment_status', array('class' => 'control-label')); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'model' => $order,
                        'attribute' => 'update_payment_status',
                        // additional javascript options for the date picker plugin
                        'options'=>array(
                            'dateFormat' => 'yy-mm-dd',
                            'showAnim'=>'fold',
                        ),
                        'htmlOptions'=>array(
                            'style'=>'height:20px;'
                        ),
                    ));

                    ?>
                </td>
            </tr>
        </table>

        <hr/>

        <table>
            <tr>
                <td>
                    <?php echo $form->label($customer, 'name', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($customer, 'name', array('class' => 'form-control', 'size' => 30, 'maxlength' => 128)); ?>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <?php echo $form->label($customer, 'phone', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($customer, 'phone', array('class' => 'form-control', 'size' => 20, 'maxlength' => 128)); ?>
                </td>
                <td>
                    <?php echo $form->label($customer, 'email', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($customer, 'email', array('class' => 'form-control', 'size' => 20, 'maxlength' => 128)); ?>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <?php echo $form->label($customerAddress, 'city', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($customerAddress, 'city', array('class' => 'form-control', 'size' => 20, 'maxlength' => 128)); ?>
                </td>
                <td>
                    <?php echo $form->label($customerAddress, 'street', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($customerAddress, 'street', array('class' => 'form-control', 'size' => 20, 'maxlength' => 128)); ?>
                </td>
            </tr>
        </table>

        <hr/>
        <table class="search-tag">
            <tr>
                <td>
                    <div id="find-order-by-tag">
                        <?php foreach (OrderTag::model()->findAll() as $tag): ?>
                            <?php echo CHtml::checkBox('Orders[tags][]',in_array($tag->id, $_GET['Orders']['tags'] ?$_GET['Orders']['tags'] :array() ),array('id'=> $tag->id,'value'=> $tag->id))?>
                            <label for="tag_<?php echo $tag->id?>">
                                <i class="icon-<?php echo $tag->img?>"> <?php echo $tag->label?></i>
                            </label>
                            |
                        <?php endforeach?>
                    </div>
                </td>
            </tr>
        </table>




            <?php echo CHtml::submitButton('Искать',array('class'=>'btn btn-primary btn-sm'))?>
    </fieldset>
<?php $this->endWidget(); ?>