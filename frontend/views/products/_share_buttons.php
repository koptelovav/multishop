<div class="share">
    <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
    <div class="ya-share2"
         data-bare
         data-services="vkontakte,facebook,odnoklassniki,twitter,gplus,whatsapp"
         data-description="<?= $product->meta_description ?>"
         data-image="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot.$product->image) ?>"></div>
</div>