<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress customerAddress */

?>

<style type="text/css">
    #box-label tr td:last-child{
        font-weight: bold;
    }
</style>

<table id="box-label" width="100%">
    <tr>
        <td width="30%"><?php echo $model->getAttributeLabel('id'); ?></td>
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
        <td colspan="2"><hr></td>
    </tr>
<?php
    $customer = $model->customer;
    $customerAddress = $model->customerAddress;
?>
    <tr>
        <td><?php echo $customer->getAttributeLabel('name'); ?></td>
        <td><?php echo $customer->name; ?></td>
    </tr>
    <tr>
        <td><?php echo $customer->getAttributeLabel('phone'); ?></td>
        <td><?php echo $customer->phone; ?></td>
    </tr>
    <?php if ($customerAddress->street): ?>
        <tr>
            <td><?php echo $customerAddress->getAttributeLabel('address'); ?></td>
            <td><?php echo $customerAddress->getFullCityAddress(); ?></td>
        </tr>
    <?php endif ?>

    <tr>
        <td colspan="2"><hr></td>
    </tr>

    <tr>
        <td>Дата и время</td>
        <td>
            <?php echo $model->getAdditionalFieldByName('shipping_date')->value;?> | <?php echo $model->getAdditionalFieldByName('shipping_time')->value;?>
        </td>
    </tr>
</table>



