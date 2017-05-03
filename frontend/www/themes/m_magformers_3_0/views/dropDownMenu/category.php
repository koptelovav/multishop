<ul class="category-menu--list">
    <?php foreach (Yii::app()->shop->categories as $category): ?>
        <li class="category-menu--item">
            <a href="<?= Yii::app()->createUrl('category/view', ['cid' => $category->id]) ?>"
               class="category-menu--item--content">
                <img src="<?= Yii::app()->media->baseUrl . $category->icon ?>" class="category-menu--item--image" alt="">
                <span class="category-menu--item--content--inside">
                    <span class="category-menu--item--title"><?= $category->short_title ?></span>
                    <span class="category-menu--item--desc"><?= $category->second_title ?></span>
                </span>
            </a>
        </li>
    <?php endforeach; ?>
    <li class="category-menu--item">
        <a href="/sale" class="category-menu--item--content">
            <img src="<?= Yii::app()->theme->baseUrl ?>/img/menu/saleicon.jpg" class="category-menu--item--image" alt="">
            <span class="category-menu--item--content--inside">
                <span class="category-menu--item--title">Акции</span>
                <span class="category-menu--item--desc">Сезонные скидки и акции. Успейте купить Магофрмерс по лучшей цене</span>
            </span>
        </a>
    </li>
</ul>