<?php

class BlockVideoController extends BackEndController
{
    public $pageTitle = 'Виджет видеороликов';
    public $controllerModelName = 'BlockVideo';

    public function actions()
    {
        return array(
            'move'=>'backend.extensions.SSortableBehavior.SSortableAction',
        );
    }
}
