<?php
$this->pageTitle = 'Отзывы о кинетическом песке';
?>

<h1><?php echo $this->pageTitle ?></h1>
<p>
<h3>Данные отзывы взяты с нашей группы вконтакте. Вы можете: <br/></h3>
<a class="btn" href="//vk.com/kineticsand" target="_blank">Перейти в группу</a>
<a class="btn" href="//vk.com/topic-57874883_29726682" target="_blank">Оставить отзыв</a>
<a class="btn" href="//vk.com/topic-57874883_28992480" target="_blank">Задать вопрос в группе</a>
</p>
<div class="wcomments_page" id="wcomments_page">
    <div class="wcomments_head clear_fix">
        <div id="wcomments_count"
             class="fl_l"><?php echo $response['count'] . ' ' . SHtml::morph($response['count'], 'комментарий', 'комментария', 'комментариев') ?> </div>
    </div>
    <div id="wcomments_posts_wrap">
        <div id="wcomments_posts" class="wcomments_posts wall_module no_post_click">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'summaryText' => false,
                'itemView' => '_vk',   // refers to the partial view named '_post'
                'viewData' => array(
                    'response' => $response
                ),
                'ajaxUpdate' => false
            ));
            ?>
        </div>
    </div>
</div>
<?php $this->widget('CLinkPager', array(
    'pages' => $pages,
)) ?>

<script>
    $(function () {
        $('.thumbs').montage({
            fixedHeight: 150
        });
    });

</script>