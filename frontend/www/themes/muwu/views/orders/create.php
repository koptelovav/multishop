<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->layout = '//layouts/column2';
$this->pageTitle = 'Офомление заказа';
$this->leftBlock = 'SALE_PRODUCTS';
$this->breadcrumbs = array('Офомление заказа');

?>

<?php if ($total['count']): ?>
    <div class="block">
        <div class="block block-color">
            <h1 class="block-header">Ваш заказ</h1>
        </div>

        <?php $this->renderPartial('_order', array(
            'products'=>$products
        ))?>

        <div class="block block-color">
            <h1 class="block-header">Оформление заказа</h1>
        </div>

        <?php $this->renderPartial('_form', array(
            'customer'=>$customer,
            'customerAddress'=>$customerAddress,
            'order'=>$order
        ))?>
    </div>
<?php endif; ?>
