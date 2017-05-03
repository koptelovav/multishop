<?php
foreach ($response['profiles'] as $profile) {
    if ($profile['id'] == $data['from_id'])
        $user = $profile;
}/*
?>
<?php echo CHtml::image($user['photo_50'], $user['screen_name']) ?>

<?php echo SHtml::toHumanDate($data['date']) ?>

<?php echo $user['first_name'].' '.$user['last_name']?>

<?php echo $data['text'] ?>

<?php
if(isset($data['attachments']))
    foreach($data['attachments'] as $attachment){
        if($attachment['type'] == 'photo'){
            echo CHtml::link(
                CHtml::image($attachment['photo']['photo_604']),
                $attachment['photo']['photo_1280'],
                array('rel'=>'gallery'));
        }
    }
*/ ?>



<div id="post120586832_172" class="post wcomments_post">
    <div class="post_table">
        <div class="post_image">
            <a target="_blank" class="post_image" href="//vk.com/<?php echo $user['screen_name'] ?>"><img
                    src="<?php echo $user['photo_50'] ?>" width="50" height="50"></a>
            <?php if ($user['online']): ?>
                <span class="online">Online</span>
            <?php endif ?>
        </div>
        <div class="post_info">
            <div class="wall_text">
                <div class="wall_text_name">
                    <a target="_blank" class="author" href="//vk.com/<?php echo $user['screen_name'] ?>"
                       data-from-id="120586832"><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></a>
                </div>
                <div id="wpt120586832_172">
                    <div class="wall_post_text">
                        <?php echo preg_replace('[\[id\d*:bp-\d*_\d*\|((.?)*)\]]', '$1', $data['text']) ?>
                    </div>

                    <?php if(isset($data['attachments'])): ?>
                    <div class="thumbs">
                        <?php
                        foreach($data['attachments'] as $attachment){
                            if($attachment['type'] == 'photo'){
                                echo CHtml::link(
                                    CHtml::image($attachment['photo']['photo_604']),
                                    $attachment['photo']['photo_1280'],
                                    array('rel'=>'gallery',));
                            }
                        }
                        ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="replies">
                <div class="reply_link_wrap sm" id="wpe_bottom120586832_172">
                    <small><span class="rel_date"><?php echo SHtml::toHumanDate($data['date']) ?></span></small>
                </div>
            </div>
        </div>
    </div>
</div>