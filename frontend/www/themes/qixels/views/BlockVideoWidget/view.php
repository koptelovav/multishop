<div class="video-block owl-carousel">
    <?php foreach ($videos as $video): ?>
        <div class="item-video video-block-item" data-merge="1"><a class="owl-video" href="<?= $video->url ?>"></a></div>
    <? endforeach; ?>
</div>