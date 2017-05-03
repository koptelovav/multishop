<div id="set-order-tag" class="row">
    <?php foreach (OrderTag::model()->findAll() as $tag): ?>
        <div class="col-xs-4">
            <a class="icon-<?php echo $tag->img?> <?php echo OrderTag::issetTag($tag->id, Yii::app()->request->getParam('id',0)) ? 'active' : '' ?>" data-href="<?php echo Yii::app()->createUrl('orderTag/switchTag',array('tag_id'=>$tag->id, 'order_id'=>Yii::app()->request->getParam('id',0)))?>"></a>
        </div>
    <?php endforeach?>
</div>