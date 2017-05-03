<div class="comment">
    <span class="date"><?= SHtml::toHumanDate($data->date) ?></span>  <span class="name"><?= $data->user_name ?></span>
    <span class="rateit rateit-mini" data-rateit-readonly="1" data-rateit-value="<?= $data->rating / 2 ?>" data-rateit-starwidth="16" data-rateit-starheight="16"></span>
    <div class="content">
        <?= $data->text ?>
    </div>
</div>