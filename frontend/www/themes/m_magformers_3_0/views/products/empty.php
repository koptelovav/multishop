<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Каталог';
?>

<section class="main-page--item section--actions">
    <div class="section--head">
        <div class="section--title">Актуальные акции и спецпредложения</div>
        <div class="section--desc">Выбирайте то, что действительно для Вас выгодно</div>
    </div>
    <div class="actions-list action-list--slick-carousel">
        <div class="action item">
            <a href="/page/shipping">
            <span class="action--image">
                 <img src="<?= Yii::app()->theme->baseUrl . '/img/action/action_1.jpg' ?>"
                      class="img-responsive" alt="Бесплтаная доставка Магформерс по Москве и Санкт-Петербургу">
            </span>
                <span class="action--title">Бесплатная доставка</span>
                <span class="action--desc">По всей территории России</span>
            </a>
        </div>
        <div class="action item">
            <a href="/sale">
            <span class="action--image">
                 <img src="<?= Yii::app()->theme->baseUrl . '/img/action/action_4.jpg' ?>"
                      class="img-responsive" alt="Скидка на маформерс 10%">
            </span>
                <span class="action--title">Сезонные скидки</span>
                <span class="action--desc">Скидка 10% на наборы Магформерс</span>
            </a>
        </div>
        <div class="action item">
            <a href="/all-products">
            <span class="action--image">
                 <img src="<?= Yii::app()->theme->baseUrl . '/img/action/action_3.jpg' ?>"
                      class="img-responsive" alt="Дарим детали магформерс">
            </span>
                <span class="action--title">Приятные подарки</span>
                <span class="action--desc">Дарим дополнительные детали к наборам</span>
            </a>
        </div>
    </div>
</section>

<? /*<section class="main-page-item">
    <div class="h1 category-title">Хиты продаж!</div>
    <div id="columns">
        <div id="category-list-view" itemtype="http://schema.org/ItemList" itemscope>
            <?php $this->widget('frontend.widgets.BlockProductWidget', array(
                'identifier' => 'MAGFORMERS_HIT',
            )) ?>
        </div>
    </div>
</section> */ ?>
<section class="main-page-item section--advantage">
    <div class="section--head">
        <div class="section--title">Наши преимущества</div>
        <div class="section--desc">Что Вы получите, если выберите наш интернет-магазин</div>
    </div>
    <div class="advantages-list advantage-list--slick-carousel">
        <div class="advantage item">
            <div class="advantage--inside">
                <span class="advantage--image">
                    <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_1.jpg' ?>"
                         alt="Настоящие фотографии магформерс">
                </span>
                <span class="advantage--content">
                    <span class="advantage--title">Качественный контент</span>
                    <span class="advantage--desc">
                        <ul>
                            <li>Оригинальные статьи о Магформерс</li>
                            <li>Актуальные новости о факты о мире Магформерс</li>
                            <li>Настоящие фото коробок и построек</li>
                            <li>Проверенная информация о наборах</li>
                        </ul>
                    </span>
                </span>
            </div>
        </div>

        <div class="advantage item">
            <div class="advantage--inside">
            <span class="advantage--image">
                <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_2.jpg' ?>"
                     alt="Грамотная консультация магформерс">
            </span>
                <span class="advantage--title">Грамотная консультация</span>
                <span class="advantage--desc">
                <ul>
                    <li>Подобем набор, который нужен именно Вам.</li>
                    <li>Онлайн-консультант всегда на связи и готов Вам помочь</li>
                    <li>Наши специалисты - эксперты Магформерс</li>
                    <li>Отлично знаем каждый набор в нашем каталоге</li>
                </ul>
            </span>
            </div>
        </div>

        <div class="advantage item">
            <div class="advantage--inside">
            <span class="advantage--image">
                <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_3.jpg' ?>"
                     alt="Удобная доставка магформерс">
            </span>
                <span class="advantage--title">Удобная доставка</span>
                <span class="advantage--desc">
                <ul>
                    <li>Бесплатная доставка по всей России от 1500 рублей</li>
                    <li>42 пункта выдачи Москве в шаговой доступности от метро</li>
                    <li>27 пунктов в С-Петербруге в шаговой доступности от метро</li>
                    <li>Более 1000 пунктов выдачи по всей России</li>
                </ul>
            </span>
            </div>
        </div>

        <div class="advantage item">
            <div class="advantage--inside">
            <span class="advantage--image">
                <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl . '/img/landing/landing_4.jpg' ?>"
                     alt="Высокое качество магформерс">
            </span>
                <span class="advantage--title">Высокое качество</span>
                <span class="advantage--desc">
                <ul>
                    <li>100% оригинальный конструктор магформерс</li>
                    <li>Прямые поставки с завода только от дистрибьютера</li>
                    <li>Абсолютно безопасен для Вашего ребенка</li>
                    <li>Никаких подделок и аналогов</li>
                </ul>
            </span>
            </div>
        </div>
    </div>
</section>
<? /*
<section class="main-page-item section--advantage">
    <div class="section--head">
        <div class="section--title">Ваши приумущества</div>
        <div class="section--desc">Что Вы получите, если выберите наш интернет-магазин</div>
    </div>
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
                <b>Прямые поставки</b> с завода только от оффициального дистрибьютера! <b>Никаких подделок и
                    аналогов!</b><br>
                Уникальные <b>скидки и акции</b>.
            </p>
        </div>
    </div>
</section>
 */ ?>

<section class="main-page-item text-center">
    <a href="/all-products" class="btn">
        <span class="btn--inside">
            <span class="btn--title">Перейти в каталог</span>
        </span>
    </a>
</section>