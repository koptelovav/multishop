<?php if(count($items)): ?>
    <?php $this->widget('zii.widgets.CMenu', array(
        'items' => array(
            array('label' => 'Каталог', 'url' => Yii::app()->homeUrl, 'linkOptions'=>array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'),'itemOptions'=>array('class'=>'dropdown'),'items' => $items)
        ),
        'activateParents'=>true,
        'linkLabelWrapper'=>'span',
        'htmlOptions' => $options,
        'submenuHtmlOptions' => array(
            'class' =>'dropdown-menu multi-level',
        )
    )); ?>
<?php endif ?>