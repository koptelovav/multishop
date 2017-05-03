<?php
/* @var $this UserController */
/* @var $model User */
?>

<div class="panel-body">
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'id',
    'login',
    'password',
    'email',
    'autologin',
    'registration_date',
    'last_login',
    'active',
    'track',
    'partner',
    'email_verified',
        ),
    )); ?>
</div>
