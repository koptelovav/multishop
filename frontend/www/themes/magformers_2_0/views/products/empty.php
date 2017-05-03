<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Каталог';
?>
<section class="main-page-item">
    <div class="h1 category-title">Актуальные акции и спецпредложения!</div>
    <div class="action row">
        <div class="item-action col-md-4">
            <a href="/page/shipping">
                <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/action/action_1.jpg' ?>"
                     alt="Бесплтаная доставка Магформерс по Москве и Санкт-Петербургу">
            </a>
        </div>
        <div class="item-action col-md-4">
            <a href="/sale">
                <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/action/action_4.jpg' ?>"
                     alt="Скидка на маформерс карнавал 20%">
            </a>
        </div>
        <div class="item-action col-md-4">
            <a href="/products">
                <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/action/action_3.jpg' ?>"
                     alt="Дарим детали магформерс">
            </a>
        </div>
    </div>
</section>


<section class="main-page-item">
    <div class="h1 category-title">Хиты продаж!</div>
    <div id="columns">
        <div id="category-list-view" itemtype="http://schema.org/ItemList" itemscope>
            <?php $this->widget('frontend.widgets.BlockProductWidget', array(
                'identifier' => 'MAGFORMERS_HIT',
            )) ?>
        </div>
    </div>
</section>

<section class="main-page-item">
    <div class="h1 category-title">Наши преимущества!</div>
    <div class="advantages row">
        <div class="advantages-item col-xs-12 col-md-3">
            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_1.jpg' ?>"
                 alt="Настоящие фотографии магформерс">
            <p>
                Мы делаем <b>качественные фото товаров</b>, что бы вы видели что покупаете:<br>
                - только <b>настоящие фото</b> коробок и построек<br>
                - только <b>проверенная информация</b> о наборах.
            </p>
        </div>
        <div class="advantages-item col-xs-12 col-md-3">
            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_2.jpg' ?>"
                 alt="Настоящие фотографии магформерс">
            <p>
                Мы настоящие <b>эксперты Магформерс</b>, хорошо знаем каждую позицию в нашем каталоге и без труда сможем
                подобрать набор, который нужен именно вам. <br>
                Напишите нам в <b>онлайн-консультант</b>, мы всегда на связи.
            </p>
        </div>
        <div class="advantages-item col-xs-12 col-md-3">
            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_3.jpg' ?>"
                 alt="Настоящие фотографии магформерс">
            <p>
                <b>Бесплатная доставка</b> до двери по Моске и Санкт-Петербургу! <br>
                42 пункта выдачи Москве и 27 пунктов в Санкт-Петербруге! <br>
                Доставка 1-2 рабоих дня!
            </p>
        </div>
        <div class="advantages-item col-xs-12 col-md-3">
            <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_4.jpg' ?>"
                 alt="Настоящие фотографии магформерс">
            <p>
                <b>100% оригинальный магнитный конструктор магформерс</b><br>
                <b>Прямые поставки</b> с завода только от оффициального дистрибьютера! <b>Никаких подделок и аналогов!</b><br>
                Уникальные <b>скидки и акции</b>.
            </p>
        </div>
    </div>
</section>

<section class="main-page-item text-center">
    <a class="super-button" href="/products">Перейти в каталог</a>
</section>