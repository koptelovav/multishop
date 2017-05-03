<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="col-sm-6 col-md-4 col-lg-4 item" style="<?= $index % 3 == 0 ? 'clear:both' : '' ?>">
    <div class="news-image">
        <?php
        if ($data->image)
            echo CHtml::link(
                CHtml::image(Yii::app()->imageApi->createUrl(BambooImage::NEWS, Yii::app()->media->webroot . $data->image), $data->title),
                array('news/view', 'id' => $data->id)
            );
        ?>
    </div>
        <div class="news-description">
            <div class="title"><?php echo CHtml::link($data->title, array('news/view', 'id' => $data->id), array('class'=>'news-title')); ?></div>
            <div class="news-date"><?= SHtml::toHumanDate($data->created) ?></div>
            <div><?= $data->short_text ?></div>
        </div>
</div>
