<div class="row">
    <?php foreach ($model->images as $image): ?>
        <div class="col-xs-4 col-md-4 col-lg-3">
            <a class="fancybox" rel="gallery" title="<?= $image->title?>" href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot.$image->url) ?>">
                <img class="img-responsive" alt="<?= $image->alt ?>" src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_GALLERY, Yii::app()->media->webroot.$image->url) ?>"/>
            </a>
        </div>
    <?php endforeach; ?>
</div>
