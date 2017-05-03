<?php
/* @var $this CardController*/

$this->pageTitle = 'Карта №'.$card->number;
?>

<div class="row">
    <div class="col-lg-6">
        <h2>Данные карты</h2>

        <dl class="dl-horizontal">
            <dt><?php echo $card->getAttributeLabel('number') ?></dt>
            <dd><?php echo $card->number?></dd>
            <dt><?php echo $card->getAttributeLabel('credits') ?></dt>
            <dd><?php echo $card->getCredits() ?></dd>
            <dt><?php echo $card->getAttributeLabel('date_issue') ?></dt>
            <dd><?php echo SHtml::toHumanDate($card->date_issue) ?></dd>
        </dl>
    </div>
    <div class="col-lg-6">
        <h2>Личные данные</h2>
        <dl class="dl-horizontal">
            <dt><?php echo $card->getAttributeLabel('buyer') ?></dt>
            <dd><?php echo $card->buyer?></dd>
            <dt><?php echo $card->getAttributeLabel('phone') ?></dt>
            <dd><?php echo $card->phone?></dd>
            <dt><?php echo $card->getAttributeLabel('email') ?></dt>
            <dd><?php echo $card->email?></dd>
            <dt><?php echo $card->getAttributeLabel('subscribe') ?></dt>
            <dd><?php echo $card->subscribe ? 'Подписан' : 'Не подписан'?></dd>
        </dl>
    </div>
</div>

<h2>Купленные товары</h2>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'card-product-grid',
        'dataProvider' => new CArrayDataProvider($products, array(
                'keyField' => 'product_id',
            )),
        'summaryText' => false,
        'columns' => array(
            array(
                'name'=>CardProduct::model()->getAttributeLabel('date'),
                'value'=>'SHtml::toHumanDate($data->date)'
            ),
            array(
                'name'=>Products::model()->getAttributeLabel('title'),
                'value'=>function($data){
                        return $data->product->title;
                    },
                'footer'=>CHtml::dropDownList('product_id','',Products::getTree(),array(
                        'data-card-id' => Yii::app()->request->getParam('id'),
                        'empty'=>''
                    ))
            ),
            array(
                'name'=>Products::model()->getAttributeLabel('price'),
                'value'=>'$data->product_price'
            ),

            array(
                'name'=>CardProduct::model()->getAttributeLabel('discount'),
                'value'=>'$data->discount',
                'footer' => CHtml::textField('product_discount','',array('size'=>'2'))
            ),

            array(
                'name'=>CardProduct::model()->getAttributeLabel('product_count'),
                'value'=>function($data){
                        return $data->product_count;
                    },
                'footer' => CHtml::textField('product_count','',array('size'=>'2'))
            ),

            array(
                'name'=>CardProduct::model()->getAttributeLabel('sum'),
                'value'=>function($data){
                        return $data->getSum();
                    }
            ),

            array(
                'name'=>Products::model()->getAttributeLabel('credits'),
                'value'=>function($data){
                        return $data->getCredits();
                    }
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{delete}',

                'buttons' => array(
                    'delete' => array(
                        'label' => false,
                        'imageUrl' => false,
                        'options' => array('class' => 'glyphicon glyphicon-remove'),
                        'url'=> function($data){
                                return Yii::app()->createUrl('card/deleteProduct',array('cid'=> Yii::app()->request->getParam('id'),'pid'=>$data->product_id));
                            }
                    ),
                ),
                'htmlOptions' => array(
                    'width' => '20px'
                ),
                'footer' => CHtml::link('добавить', $this->createUrl('addProduct') ,array('id'=>'add-card-product','class' => 'btn btn-primary btn-xs', 'name' => 'create'))
            ),
        ),
    )); ?>

