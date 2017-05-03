<?php $this->beginContent('//layouts/general'); ?>


    <div class="container">
        <div class="row">
                <div id="sidebar" class="col-xs-2 sidebar-column">
                    <div class="sidebar-category--list sticky-column">
                        <span class="sidebar--title">Каталог</span>

                        <?php foreach (Yii::app()->shop->categories as $category): ?>
                            <div class="sidebar-category--item">
                                <a href="<?= Yii::app()->createUrl('category/view', ['cid' => $category->id]) ?>"
                                   class="sidebar-category--item--content">
                                    <img src="<?= Yii::app()->media->baseUrl . $category->icon ?>"
                                         class="sidebar-category--item--image" alt="">
                                    <span class="sidebar-category--item--content--inside">
                                        <span class="sidebar-category--item--title"><?= $category->short_title ?></span>
                                        <span class="sidebar-category--item--desc"><?= $category->second_title ?></span>
                                    </span>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        <div class="sidebar-category--item">
                            <a href="/sale" class="sidebar-category--item--content">
                                <img src="<?= Yii::app()->theme->baseUrl ?>/img/menu/saleicon.jpg"
                                     class="sidebar-category--item--image" alt="">
                                <span class="sidebar-category--item--content--inside">
                                    <span class="sidebar-category--item--title">Акции</span>
                                    <span class="sidebar-category--item--desc">Сезонные скидки и акции. Успейте купить Магофрмерс по лучшей цене</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="main" class="col-xs-10 main-column">
                    <?php echo $content; ?>
                </div>
        </div>
    </div>


<?php $this->endContent(); ?>
