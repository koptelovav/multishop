<?php $action = array(
    'action1' => array(
        'title' => '1 + 1 = скидка',
        'img' => '1_1.jpg',
        'text' => 'Скидка 10% (1200 рублей) при покупке двух Hatchimals'
    ),
    'action2' => array(
        'title' => 'Доставка',
        'img' => 'shipping.jpg',
        'text' => 'Бесплатная доставка по Москве и Санкт-Петербургу<br/>По России от 100 рублей'
    ),
    'action3' => array(
        'title' => 'Репост',
        'img' => 'repost.jpg',
        'text' => 'Дополнительный бонус<br/>за вступление в группу вконтакте и репост'
    ),
); ?>

<div class="row">
    <?php $this->renderPartial('_action', array('data' => $action['action1'])) ?>
    <?php $this->renderPartial('_action', array('data' => $action['action2'])) ?>
    <?php $this->renderPartial('_action', array('data' => $action['action3'])) ?>
</div>