<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->layout = '//layouts/common';
$this->breadcrumbs = SHtml::getCategoryBreadcrumbs($category);
$this->firstTitle = $category->title;
$this->secondTitle = $category->second_title;
//$this->thirdTitle = $category->second_title;
$this->bannerUrl = Yii::app()->media->baseUrl.$category->getImage(Image::TYPE_CATEGORY_BANNER);

?>
<?php $this->widget('frontend.widgets.YandexDirectOfferWidget', ['data' => 'category']); ?>
<?php if ($this->beginCache('catalog_'.$category->id.'_'.Yii::app()->theme->name.Yii::app()->globalSettings->cache_version, array('duration' => 3600))) { ?>
<div id="columns">
    <div class="category--title"><?= $category->title ?></div>

    <?php if (isset($this->filter)): ?>
        <div class="filter-wrap">
            <div id="filter" class="filter-list">
                <div class="filter-list--item">
                    <div class="filter-list--general-title">
                        Фильтры:
                    </div>
                </div>

                <?php if ($this->filter['gender']): ?>
                    <div class="filter-list--item">
                        <div class="filter-list--item--title" data-name="gender" data-plural="Пол,Пол: n варианта,Пол: n вариантов">
                            <span class="filter-list--item--title-inside">Пол</span>
                            <span class="filter-list--item--title-clear">x</span>
                        </div>
                        <div class="filter-list--item--content">
                            <div class="filter-list--item--content-inside">
                                <?= CHtml::checkBoxList('filter[gender]', $_GET['filter']['gender'], CHtml::listData($this->filter['gender'], 'id', 'value'), array('data-name' => 'gender', 'class'=>'filter-item')); ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if ($this->filter['size']): ?>
                    <div class="filter-list--item">
                        <div class="filter-list--item--title" data-name="size" data-plural="Размер,n размера,n размеров">
                            <span class="filter-list--item--title-inside">Размер</span>
                            <span class="filter-list--item--title-clear">x</span>
                        </div>
                        <div class="filter-list--item--content">
                            <div class="filter-list--item--content-inside">
                                <?= CHtml::checkBoxList('filter[size]', $_GET['filter']['size'], CHtml::listData($this->filter['size'], 'id', 'value'), array('data-name' => 'size', 'class'=>'filter-item')); ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if ($this->filter['level']): ?>
                    <div class="filter-list--item">
                        <div class="filter-list--item--title" data-name="level" data-plural="Уровень сложности,n уровня сложности,n уровней сложности">
                            <span class="filter-list--item--title-inside">Уровень сложности</span>
                            <span class="filter-list--item--title-clear">x</span>
                        </div>
                        <div class="filter-list--item--content">
                            <div class="filter-list--item--content-inside">
                                <?= CHtml::checkBoxList('filter[level]', $_GET['filter']['level'], CHtml::listData($this->filter['level'], 'id', 'value'), array('data-name' => 'level', 'class'=>'filter-item')); ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if ($this->filter['magformers_tags']): ?>
                    <div class="filter-list--item">
                        <div class="filter-list--item--title" data-name="magformers_tags" data-plural="Тематика,n тематики,n тематик">
                            <span class="filter-list--item--title-inside">Тематика</span>
                            <span class="filter-list--item--title-clear">x</span>
                        </div>
                        <div class="filter-list--item--content">
                            <div class="filter-list--item--content-inside">
                                <?= CHtml::checkBoxList('filter[magformers_tags]', $_GET['filter']['magformers_tags'], CHtml::listData($this->filter['magformers_tags'], 'id', 'value'), array('data-name' => 'magformers_tags', 'class'=>'filter-item')); ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <div class="filter-list--item">
                    <div class="filter-list--item--title" data-name="price" data-label="Цена,Цена: от min до max руб.">
                        <span class="filter-list--item--title-inside">Цена</span>
                        <span class="filter-list--item--title-clear">x</span>
                    </div>

                    <div class="filter-list--item--content filter-price">
                        <div class="filter-list--item--content-inside">
                            от <input type="text" id="filter-min-price" class="filter-price--input" name="filter[min_price]"
                                      value="<?= isset($_GET['filter']['min_price']) ? $_GET['filter']['min_price'] : $this->filter['min_price'] ?>">
                            до
                            <input type="text" id="filter-max-price"  class="filter-price--input" name="filter[max_price]"
                                   value="<?= isset($_GET['filter']['max_price']) ? $_GET['filter']['max_price'] : $this->filter['max_price'] ?>">
                            руб.

                            <div class="filter-price-slider">
                                <input type="text" id="filter-price-slider"
                                       data-slider-min="<?= $this->filter['min_price'] ?>"
                                       data-slider-max="<?= $this->filter['max_price'] ?>"
                                       data-slider-step="1"
                                       data-slider-value="[<?= isset($_GET['filter']['min_price']) ? $_GET['filter']['min_price'] : $this->filter['min_price'] ?>,<?= isset($_GET['filter']['max_price']) ? $_GET['filter']['max_price'] : $this->filter['max_price'] ?>]"
                                       data-slider-orientation="horizontal"
                                       data-slider-selection="after"
                                       data-slider-tooltip="hide"/>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="filter-list--item filter-list--result">
                    <div id="filter-result" class="filter-list--result--title">
                        Найдено наборов: <span></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>


    <?php $this->widget('zii.widgets.CListView', array(
        'id' => 'category-list-view',
        'dataProvider' => $dataProvider,
        'itemView' => '//products/_view',
        'template' => '{items}',
        'itemsCssClass' => 'row products'
    )); ?>
</div>
<div id="overflow"></div>
</div>
<?php $this->endCache();} ?>
