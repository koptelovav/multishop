<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('core', 'User'); ?>
        <div class="control pull-right">
            <?= CHtml::link(Yii::t('core','Add'), $this->createUrl('form'), array('class'=>'btn btn-primary btn-xs'));?>
            <?= CHtml::link(Yii::t('core','Delete'), $this->createUrl('delete'), array('class'=>'btn btn-danger btn-xs btn-delete'));?>
        </div>
    </div>
    <div class="panel-body">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'user-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
        		'id',
		'login',
		'password',
		'email',
		'autologin',
		'registration_date',
		/*
		'last_login',
		'active',
		'track',
		'partner',
		'email_verified',
		*/
            array(
                'class'=>'CButtonColumn',
                    'buttons'=>array (
                            'view'=>array(
                            'label'=>false,
                            'imageUrl'=>false,
                            'options'=>array( 'class'=>'glyphicon glyphicon-eye-open' ),
                        ),
                        'update'=>array(
                            'label'=>false,
                            'imageUrl'=>false,
                            'url'=> function($data){ return $this->createUrl("form",array("id"=>$data->id)); },
                            'options'=>array( 'class'=>'glyphicon glyphicon-pencil' ),
                        ),
                        'delete'=>array(
                            'label'=>false,
                            'imageUrl'=>false,
                            'options'=>array( 'class'=>'glyphicon glyphicon-remove' ),
                        ),
                    ),
                    'htmlOptions'=>array(
                        'width'=>'70px'
                    )
                ),
            ),
        )); ?>
    </div>
</div>
