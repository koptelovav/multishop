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
<?php
    $customer = $model->customer;
    $customerAddress = $model->customerAddress;
?>
    <tr>
        <td colspan="2"><h2><?php echo $model->shipping->name?></h2></td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>
    <tr>
        <td><?php echo $customer->getAttributeLabel('name'); ?></td>
        <td><?php echo $customer->name; ?></td>
    </tr>
    <tr>
        <td><?php echo $customer->getAttributeLabel('phone'); ?></td>
        <td><?php echo $customer->phone; ?></td>
    </tr>

        <tr>
            <td><?php echo $customerAddress->getAttributeLabel('address'); ?></td>

            <td>
                <?php echo $customerAddress->area; ?>,
                <?php echo $customerAddress->city; ?>,
                <?php if ($customerAddress->street): ?>
                    <?php echo $customerAddress->getFullCityAddress(); ?>
                <?php endif ?>
            </td>
        </tr>


    <tr>
        <td colspan="2"><hr></td>
    </tr>

    <?php if ($model->comment): ?>
        <tr>
            <td colspan="2"><?php echo $model->comment; ?></td>
        </tr>
    <?php endif; ?>

    <tr>
        <td colspan="2"><hr></td>
    </tr>
</table>



