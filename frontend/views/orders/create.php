<?php
/* @var $this OrdersController */
/* @var $model Orders */
?>

<?php if ($total['count']): ?>
    <div id="products">
        <h1>Вы заказали</h1>

        <?php $this->renderPartial('_order', array(
            'products'=>$products
        ))?>

        <div class="block block-color">
            <h1 class="block-header">Оформление заказа</h1>
        </div>


    </div>
<?php endif; ?>
