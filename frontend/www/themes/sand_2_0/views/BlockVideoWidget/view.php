<div class="video-block owl-carousel">
    <?php foreach ($videos as $video): ?>
        <div class="item video-block-item">
            <?=  SHtml::popupImage($video->name, $video->image, $video->url, SHtml::IMAGE_VIDEO_BLOCK) ?>
        </div>
    <? endforeach; ?>
</div>
