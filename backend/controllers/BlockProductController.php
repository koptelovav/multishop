<?php

class BlockProductController extends BackEndController
{
    public $pageTitle = 'Блоки товаров';
    public $controllerModelName = 'BlockProduct';

    public function actions()
    {
        return array(
            'move'=>'backend.extensions.SSortableBehavior.SSortableAction',
        );
    }
}
