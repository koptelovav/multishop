<?php
    $currentUrl = Yii::app()->controller->id .'/'.Yii::app()->controller->action->id;
    $fullSidebar = array('products/empty','products/index');
?>

<?php if($currentUrl == 'products/index'):?>
<div id="sidebar" class="fixed">
    <a class="sidebar-logo" href="<?= Yii::app()->homeUrl ?>">
        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/logo/logo_xs.png" alt="">
    </a>
    <ul class="nav nav-stacked">
        <li>
            <a href="#cat-action">Акции</a>
        </li>
        <?php foreach (Yii::app()->shop->categories as $category): ?>
            <?php if ($children = $category->children): ?>
                <?php foreach ($children as $subCategory): ?>
                    <li>
                        <a href="#cat-<?= $subCategory->slug ?>"><?= $subCategory->short_title ?></a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>
                    <a href="#cat-<?= $category->slug ?>"><?= $category->short_title ?><?= $category->is_new ? ' <sup style="color:#f70e10;">NEW</sup>' : ''?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
<?php else:?>
    <div id="sidebar" class="simple">
        <a class="sidebar-logo" href="<?= Yii::app()->homeUrl ?>">
            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/logo/logo_xs.png" alt="">
        </a>
    </div>
<?php endif;