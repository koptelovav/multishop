<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $customer Customers */
/* @var $customerAddress CustomerAddress */
?>



<tr id="f<?php echo $model->id?>" class="fast-view">
    <td colspan="4">
        <dl class="dl-horizontal">
            <dt><?php echo $customer->getAttributeLabel('phone'); ?></dt>
            <dd><?php echo $customer->phone ?></dd>

            <dt><?php echo $customer->getAttributeLabel('email'); ?></dt>
            <dd><?php echo $customer->email ?></dd>
        </dl>
    </td>
    <td colspan="3">
        <dl class="dl-horizontal">
            <?php if (!is_null($customerAddress)): ?>
                <dt><?php echo $customerAddress->getAttributeLabel('zip'); ?></dt>
                <dd><?php echo $customerAddress->zip ?></dd>

                <dt><?php echo $customerAddress->getAttributeLabel('city'); ?></dt>
                <dd><?php echo $customerAddress->city ?></dd>


                <dt><?php echo $customerAddress->getAttributeLabel('area'); ?></dt>
                <dd><?php echo $customerAddress->area ?></dd>

                <dt><?php echo $customerAddress->getAttributeLabel('street'); ?></dt>
                <dd><?php echo $customerAddress->address ?></dd>
            <?php endif ?>
        </dl>
    </td>
    <td colspan="2">&nbsp;</td>
</tr>








