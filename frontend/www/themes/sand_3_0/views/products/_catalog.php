<div class="cat-list row">
    <?php foreach (Yii::app()->shop->categories as $category): ?>
        <?php /*if ($children = $category->children): ?>
            <?php foreach ($children as $subCategory): ?>
                <div class="col-xs-6 col-lg-4">
                    <a href="<?= Yii::app()->createUrl('category/view',array('cid'=>$subCategory->id)) ?>">

                        <img class="img-responsive"
                             src="<?php echo Yii::app()->imageApi->createUrl(BambooImage::CATEGORY_ICON, Yii::app()->media->webroot . $subCategory->icon) ?>"/>
                        <span><?= $subCategory->short_title ?></span>

                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: */?>
            <div class="col-xs-6 col-lg-4">
                <a href="<?= Yii::app()->createUrl('category/view',array('cid'=>$category->id)) ?>">
                    <img class="img-responsive"
                         src="<?php echo Yii::app()->imageApi->createUrl(BambooImage::CATEGORY_ICON, Yii::app()->media->webroot . $category->icon) ?>"/>
                    <span><?= $category->short_title ?></span>
                </a>
            </div>
        <?php /*endif;*/ ?>
    <?php endforeach; ?>
</div>
