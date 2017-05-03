<?php $this->pageTitle = 'Каталог - ' . $this->pageTitle ?>
<?php if ($this->beginCache('catalog_'.Yii::app()->globalSettings->cache_version, array('duration' => 3600))) { ?>

    <div class="section-catalog row">
        <div id="leftCol" class="col-sm-3 col-md-3 col-lg-3">
            <div id="sidebar">
                <div class="sidebar-header">Навигация по каталогу</div>
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
        </div>
        <div class="col-sm-9 col-md-9 col-lg-9">
            <div id="cat-action" class="row">
                <h2>Скидка на песочницы до 100%</h2>
                <div class="cat-items">
                    <?php /*   <div class="col-md-12">
                        <a href="<?= SHtml::crossDomainLink('http://muwu.ru/sale')?>" target="_blank">
                            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/action/banner_muwu.jpg" alt="Скидки до 50% на сайте muwu.ru">
                        </a>
                    </div>
                    <p></p>
                  <div class="col-md-12">
                        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/action/waba_gift.jpg" alt="Скидки до 50% на сайте muwu.ru">
                    </div> */?>
                   <div class="col-md-6">
                        <a href="#cat-set-optima-kinetic-sand">
                            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/action/optima_sale.jpg" alt="Скидка на контейнер-пеосчницу 100%">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#cat-set-premium-kinetic-sand">
                            <img class="img-responsive"  src="<?= Yii::app()->theme->baseUrl ?>/img/action/waba_sale.jpg" alt="Скидка на надувную песочницу WabaFun 50%">
                        </a>
                    </div>

                </div>
            </div>
            <?php foreach (Yii::app()->shop->categories as $category): ?>
                <?php if ($children = $category->children): ?>
                    <?php foreach ($children as $subCategory): ?>
                        <div id="cat-<?= $subCategory->slug ?>" class="row">
                            <h2><?= $subCategory->title ?></h2>
                            <div class="cat-items">
                                <?php foreach ($subCategory->products(array('scopes' => array('in_category'))) as $product): ?>
                                    <?php $this->renderPartial('//products/' . $subCategory->item_template, array('product' => $product)) ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div id="cat-<?= $category->slug ?>" class="row">
                        <h2><?= $category->title ?></h2>
                        <div class="cat-items">
                            <?php foreach ($category->products(array('scopes' => array('in_category'))) as $product): ?>
                                <?php $this->renderPartial('//products/' . $category->item_template, array('product' => $product)) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
    </div>

    <?php $this->endCache();
} ?>
