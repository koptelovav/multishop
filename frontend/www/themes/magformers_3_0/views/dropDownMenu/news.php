<div class="dropdown--section--inside">
    <div class="row">
        <?php foreach (News::getLast(2) as $news): ?>
            <div class="col-xs-6 news-menu--item">
                <?php
                if ($news->image)
                    echo CHtml::link(
                        CHtml::image(Yii::app()->imageApi->createUrl(BambooImage::NEWS, Yii::app()->media->webroot . $news->image), $news->title, ['class' => 'img-responsive']),
                        ['news/view', 'id' => $news->id], ['class' => 'news-menu--item--image']
                    );
                ?>
                <span class="news-menu--item--description">
                    <span class="dropdown--section--title"><?php echo CHtml::link($news->title, array('news/view', 'id' => $news->id), array('class' => 'news-title')); ?></span>
                    <span class="news-menu--item--date"><?= SHtml::toHumanDate($news->created) ?></span>
                    <p><?= $news->short_text ?></p>
                </span>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="<?= Yii::app()->createUrl('news/index') ?>" class="btn btn--blue news-menu--button-read-all">
        <span class="btn--inside">
            <span class="btn--title">Читать все</span>
        </span>
    </a>
</div>