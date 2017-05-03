<div class="cat-list row">
    <?php foreach (Yii::app()->shop->categories as $category): ?>
        <?php if ($children = $category->children): ?>
            <?php foreach ($children as $subCategory): ?>
                <div class="col-xs-6 col-md-6 col-lg-4">
                    <a href="/products/#cat-<?= $subCategory->slug ?>">
                         <span><?= $subCategory->short_title ?></span>
                        <img class="img-responsive"
                             src="<?php echo Yii::app()->imageApi->createUrl(BambooImage::CATEGORY_ICON, Yii::app()->media->webroot . $subCategory->icon) ?>"/>

                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-xs-6 col-md-6 col-lg-4">
                <a href="/products/#cat-<?= $category->slug ?>">
                    <span><?= $category->short_title ?></span>
                    <img class="img-responsive"
                         src="<?php echo Yii::app()->imageApi->createUrl(BambooImage::CATEGORY_ICON, Yii::app()->media->webroot . $category->icon) ?>"/>
                </a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
