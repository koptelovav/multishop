<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */

?>

<script type="text/javascript">
    window.onload = function(){window.print();}
    window.onfocus = function() { window.close(); }
</script>

<style type="text/css">
    #box-label tr td:last-child{
        font-weight: bold;
    }
</style>

<table id="box-label">
    <tr>
        <td><?php echo $model->getAttributeLabel('id'); ?></td>
        <td><?php echo $model->id; ?></td>
    </tr>
    <?php if ($model->comment): ?>
        <tr>
            <td><?php echo $model->getAttributeLabel('comment'); ?></td>
            <td><?php echo $model->comment; ?></td>
        </tr>
    <?php endif; ?>

    <?php if ($model->payment_status != OrderPaymentStatus::PAID): ?>
        <tr>
            <td>Наложенный платеж</td>
            <td><?php echo $model->getTotal() ; ?> р.</td>
        </tr>
    <?php endif; ?>

    <tr>
        <td><hr></td>
        <td><hr></td>
    </tr>

    <tr>
        <td><?php echo $customer->getAttributeLabel('name'); ?></td>
        <td><?php echo $customer->name; ?></td>
    </tr>
    <tr>
        <td><?php echo $customer->getAttributeLabel('phone'); ?></td>
        <td><?php echo $customer->phone; ?></td>
    </tr>
    <?php if (!is_null($customerAddress)): ?>
        <?php if ($customerAddress->address): ?>
            <tr>
                <td><?php echo $customerAddress->getAttributeLabel('address'); ?></td>
                <td><?php echo $customerAddress->address; ?></td>
            </tr>
        <?php endif ?>
    <?php endif ?>
</table>

<hr />