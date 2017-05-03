<?php foreach($gifts as $item): ?>
    <a href="<?php echo SHtml::productUrl($data); ?>#gift-preview" class="gift-preview">
        <img class="img-responsive gift-image" src="<?php echo Yii::app()->image->createUrl( 'mini', Yii::app()->media->webroot.$item->image); ?>" alt="<?= CHtml::encode($item->short_title); ?>"/>
    </a>
    <a href="<?php echo SHtml::productUrl($data); ?>#gift-preview" class="gift-label">
        подарок
    </a>
<?php endforeach?>