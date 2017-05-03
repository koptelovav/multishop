<div class="col-xs-6 col-md-6 col-lg-3 new-action section">
    <div class="action-content">
        <div class="action-desc">
            <p>
            <?php if(isset($data['link'])): ?>
                <a href="<?= $data['link'] ?>">
            <?php endif;?>
            <img class="img-responsive action-img " src="<?php echo Yii::app()->theme->baseUrl ?>/img/action/<?php echo $data['img']?>" alt=""/>
            <?php if(isset($data['link'])): ?>
                </a>
            <?php endif;?>
                <?php echo $data['text']?>
            </p>
        </div>
    </div>
</div>
