<div id="gift-preview" class="h2">Подарки</div>
<?php foreach($gifts as $item): ?>
    <div>
        <h4 class="text-center"><?php echo $item->title; ?></h4>
        <img class="img-responsive block" src="<?php echo Yii::app()->image->createUrl( 'thumbnail', Yii::app()->media->webroot.$item->image); ?>" alt="<?= CHtml::encode($item->short_title); ?>"/>
    </div>
<?php endforeach?>