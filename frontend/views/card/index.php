<?php
$this->pageTitle = 'Личный кабинет'
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
            <dd><?php echo $card->getDateIssue() ?></dd>
            <dt><?php echo $card->getAttributeLabel('date_activation') ?></dt>
            <dd><?php echo $card->getDateActivation() ?></dd>
        </dl>
    </div>
    <div class="col-lg-6">
        <h2>Личные данные</h2>
        <dl class="dl-horizontal">
            <dt><?php echo $user->getAttributeLabel('lastname');?></dt>
            <dd>
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $user,
                    'attribute' => 'lastname',
                    'url' => $this->createUrl('card/userUpdate'),
                    'placement' => 'right',
                ));
                ?>
            </dd>

            <dt><?php echo $user->getAttributeLabel('firstname');?></dt>
            <dd>
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $user,
                    'attribute' => 'firstname',
                    'url' => $this->createUrl('card/userUpdate'),
                    'placement' => 'right',
                ));
                ?>
            </dd>

            <dt><?php echo $user->getAttributeLabel('patronymic');?></dt>
            <dd>
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $user,
                    'attribute' => 'patronymic',
                    'url' => $this->createUrl('card/userUpdate'),
                    'placement' => 'right',
                ));
                ?>
            </dd>

            <dt><?php echo $user->getAttributeLabel('email');?></dt>
            <dd>
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $user,
                    'attribute' => 'email',
                    'url' => $this->createUrl('card/userUpdate'),
                    'placement' => 'right',
                ));
                ?>
            </dd>

            <dt><?php echo $user->getAttributeLabel('phone');?></dt>
            <dd>
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $user,
                    'attribute' => 'phone',
                    'url' => $this->createUrl('card/userUpdate'),
                    'placement' => 'right',
                ));
                ?>
            </dd>

            <dt>Новый <?php echo $user->getAttributeLabel('password');?></dt>
            <dd>
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'password',
                    'model' => $user,
                    'attribute' => 'password',
                    'url' => $this->createUrl('card/userUpdate'),
                    'placement' => 'right',
                ));
                ?>
            </dd>
        </dl>
    </div>
</div>

<?php if($products): ?>
    <h2>Купленные товары</h2>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'shipping-status-grid',
        'dataProvider' => new CArrayDataProvider($products, array(
                'keyField' => 'product_id',
            )),
        'summaryText' => false,
        'selectableRows'=>100,
        'itemsCssClass' => 'table table-hover table-index',
        'pagerCssClass' => 'text-center',
        'pager'=>array(
            'class'=>'CLinkPager',
            'header'=>false,
            'hiddenPageCssClass'=>'disabled',
            'selectedPageCssClass' => 'active',
            'cssFile' => false,
            'nextPageLabel' => '&raquo;',
            'prevPageLabel' => '&laquo;',
            'htmlOptions' => array(
                'class'=>'pagination'
            )
        ),
        'columns' => array(
            array(
                'name'=>Products::model()->getAttributeLabel('title'),
                'value'=>function($data){
                        return $data->product->title;
                    },
            ),
            array(
                'name'=>Products::model()->getAttributeLabel('price'),
                'value'=>function($data){
                        return $data->product->price;
                    }
            ),

            array(
                'name'=>CardProduct::model()->getAttributeLabel('sum'),
                'value'=>function($data){
                        return $data->getSum();
                    }
            ),
            array(
                'name'=>CardProduct::model()->getAttributeLabel('product_count'),
                'value'=>function($data){
                        return $data->product_count;
                    },
            ),
            array(
                'name'=>Products::model()->getAttributeLabel('credits'),
                'value'=>function($data){
                        return $data->getCredits();
                    }
            ),
        ),
    )); ?>

<?php endif ?>