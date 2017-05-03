<div class="row">
    <?php foreach ($gallery->albums as $album): ?>
        <div class="col-xs-4 col-md-4 col-lg-3">
            <a title="<?= $album->title?>" href="<?= Yii::app()->createUrl('gallery/viewAlbum',array('id'=>$album->id))?>">
                <img class="img-responsive" alt="<?= $album->short_title ?>" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$album->image) ?>"/>
            </a>
        </div>
    <?php endforeach; ?>
</div>