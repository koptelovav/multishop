<?php
$this->panelTitle = 'Отслеживание посылок';

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'tracking-grid',
    'dataProvider' => $dataProvider,
    'summaryText' => false,
    'columns' => array(
        array(
            'name' => '№ Трэка',
            'value' => function ($data) {
                return $data['number'];
            }
        ),
        array(
            'name' => 'Описание',
            'value' => function ($data) {
                return $data['description'];
            }
        ),
        array(
            'name' => 'Изменен',
            'value' => function ($data) {
                return $data['date'];
            }
        ),
        array(
            'name' => 'Сообщение',
            'value' => function ($data) {
                return $data['message'];
            }
        ),
        array(
            'name' => 'Вес посылки',
            'value' => function ($data) {
                return $data['weight'];
            }
        )
    ),
));