<?php $action = array(
    'action1' => array(
        'title' => 'Доставка',
        'img' => 'shipping.jpg',
        'text' => 'Скидка на доставку 300 рублей при заказе от 5000 рублей *<br/>
    * Бесплатна по Санкт-Петербургу и всего 100 рублей по Москве'
    ),
    'action2' => array(
        'title' => 'Опалата',
        'img' => 'nordik.jpg',
        'text' => 'Дарим машинку «Нордик» при оплате заказа в течении трех часов после оформления заказа <br/>(при сумме заказа от 2500 р.)'
    ),
   /* 'action4' => array(
        'title' => 'Скидка на песок',
        'img' => 'kinetic_action.jpg',
        'text' => 'Скидка 10% + подарок к кинетическому песку до 31.10.2016г. '. CHtml::link('Подробнее...', array('products/sale'))
    ),
    'action5' => array(
        'title' => 'Скидка на наборы',
        'img' => 'optima_action.jpg',
        'text' => 'Скидка 10% на наборы с кинетическим песком до 31.10.2016г. '. CHtml::link('Подробнее...', array('products/sale'))
    )*/

    'action6' => array(
        'title' => 'Опалата',
        'img' => 'sale_mini.jpg',
        'text' => 'Скидки на кинетический песок, аксессуары и песончицы ',
        'link' => Yii::app()->createUrl('products/sale')
    ),
); ?>
<?php /*
<div class="row">
    <div class="col-xs-12">
        <a href="/sale">
            <img class="img-responsive action-img " src="<?php echo Yii::app()->theme->baseUrl ?>/img/action/sand_mega_sale.jpg" alt=""/>
        </a>
    </div>
</div>
*/?>

<div class="row">
    <?php $this->renderPartial('_action', array('data' => $action['action1'])) ?>
    <?php $this->renderPartial('_action', array('data' => $action['action2'])) ?>
    <?php $this->renderPartial('_action', array('data' => $action['action6'])) ?>
<!--    --><?php //$this->renderPartial('_action', array('data' => $action['action4'])) ?>
<!--    --><?php //$this->renderPartial('_action', array('data' => $action['action5'])) ?>
</div>