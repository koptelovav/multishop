<div id="set-order-tag">
    <?php foreach (OrderTag::model()->findAll() as $tag): ?>
        <?if ($tag->id != OrderTag::RESERV || ($tag->id == OrderTag::RESERV && Yii::app()->user->checkAccess('admin'))): ?>
            <i class="icon-<?php echo $tag->img?> <?php echo OrderTag::issetTag($tag->id, Yii::app()->request->getParam('id',0)) ? 'active' : '' ?>" data-href="<?php echo Yii::app()->createUrl('orderTag/switchTag',array('tag_id'=>$tag->id, 'order_id'=>Yii::app()->request->getParam('id',0)))?>"></i>
        <?php endif ?>
    <?php endforeach?>
</div>