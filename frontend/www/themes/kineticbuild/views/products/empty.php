<?php $this->layout = '//layouts/common' ?>
<div class="container">
    <div class="flag flag-first">
        Официальный представитель торговой марки Kinetic Sand
    </div>
    <div class="flag-wrapper" style="display: none">
        <div class="phone hidden-xs">
            <span>Санкт-Петербург</span> 8 (812) 309-06-80
        </div>
        <div class="phone hidden-xs">
            <span>Москва</span> 8 (499) 703-05-09
        </div>
        <div class="callback visible-lg">
            <a href="<?php echo Yii::app()->createUrl('callback/create') ?>" class="callback-button">Заказать звонок</a>
        </div>
    </div>

    <!--Данное изображение является собственоость kineticsand.ru, любое использование без указания ссылки на сайт будет приследоваться по закону-->

    <div class="row user-info" style="display: none">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'faq', '#' => 'can-order')) ?>">
            <div class="col-xs-3 user-info-col icon-can-order">
                <div class="user-info-description hidden-xs">
                    <p class="p-title">Как оформить заказ</p>

                    <p class="p-desc">Подробная инструкция</p>
                </div>

                <div class="user-info-description-mobile visible-xs">
                    <p class="p-title">Заказ</p>
                </div>
            </div>
        </a>

        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'faq', '#' => 'payment')) ?>">
            <div class="col-xs-3 user-info-col icon-payment">
                <div class="user-info-description hidden-xs">
                    <p class="p-title">Как оплатить товар</p>

                    <p class="p-desc">Способы оплаты</p>
                </div>

                <div class="user-info-description-mobile visible-xs">
                    <p class="p-title">Оплата</p>
                </div>
            </div>
        </a>

        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'faq', '#' => 'shipping')) ?>">
            <div class="col-xs-3 user-info-col icon-shipping">
                <div class="user-info-description-mobile hidden-xs">
                    <p class="p-title">Доставка</p>

                    <p class="p-desc">Способы и сроки доставки</p>
                </div>

                <div class="user-info-description-mobile visible-xs">
                    <p class="p-title">Доставка</p>
                </div>
            </div>
        </a>

        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'faq', '#' => 'protected')) ?>">
            <div class="col-xs-3 user-info-col icon-protected">
                <div class="user-info-description hidden-xs">
                    <p class="p-title">Гарантии магазина</p>

                    <p class="p-desc">Возврат и замена товара</p>
                </div>

                <div class="user-info-description-mobile visible-xs">
                    <p class="p-title">Гарантии</p>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="parallax-section parallax-1">
    <div class="container">
        <div class="section-title"><img src="<?= Yii::app()->theme->baseUrl ?>/img/kinetic_sand_logo_mini.png" alt=""><br/> <span>Описание и свойства</span></div>

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <p>
                    KineticsandBuild – Новая формула кинетического песка, благодаря которой кинетический песок не течет, а растягивается. Из такого песка получаются прочные постройки и его приятно мять в руках. Он идеально подходит для использования с формочками, а благодаря повышенному содержанию силикона в смеси, постройки держатся долго. KineticsandBuild – идеальный песок для моделирования.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6 k-video">
                <iframe width="100%" height="auto" style="border: 10px solid #643f98"
                        src="//www.youtube.com/embed/3c1JekvIPuI?showinfo=0&controls=0&modestbranding=0&loop=1&playlist=i15bTaD2rgM"
                        frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6 text-right k-video">
                <iframe width="100%" height="auto" style="border: 10px solid #643f98"
                        src="//www.youtube.com/embed/O5rm2nfCmRY?showinfo=0&controls=0&modestbranding=0&loop=1&playlist=50_-zqsgDA4"
                        frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

    </div>
</div>


<div class="parallax-section parallax-2">
    <div class="container">
        <div class="section-title">Чем полезен песок?</div>

        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <p class="h2">
                    Свойства Kinetic Sand Build
                </p>
                <p class="bold" style="line-height: 22px">
                    &bull; Никогда не сохнет<br/>
                    &bull; Растягивается и держит форму<br/>
                    &bull; Не пачкает поверхности<br/>
                    &bull; Нравится детям от 4-х лет.<br/>
                    &bull; Изготовлен в Швеции<br/>
                    &bull; Абсолютно безопасен в составе только песок и силикон.<br/>
                </p>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <p class="h2">
                    Чем полезен песок для моделирования
                </p>
                <p class="bold" style="line-height: 22px">
                    &bull; Надолго занимает ребенка<br/>
                    &bull; развивает мелкую моторику<br/>
                    &bull; легко убрать с любой поверхности<br/>
                    &bull; абсолютно безопасен даже при проглатывании<br/>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php $this->renderPartial('_catalog') ?>
</div>


<?php /*
<div class="page-divider">
    <div class="divider"></div>
    <div class="flag-wrapper">
        <div class="flag">
            Гарантии
        </div>
        <div class="flag-info">
            C нами безопасно!
        </div>
    </div>
</div>
 */ ?>


<div class="parallax-section parallax-3">
    <div class="container">
        <div class="section-title">Интересные статьи <span>о&nbsp;кинетическом песке</span></div>
        <?php
        $newsArray = array(
            News::model()->findByPk(42),
            News::model()->findByPk(47),
            News::model()->findByPk(27));
        ?>
        <div class="row">
            <?php foreach ($newsArray as $news): ?>
                <div class="col-xs-12 col-md-12 col-lg-4">
                    <div class="general-new">
                        <div class="general-new-title">
                            <?php
                            echo CHtml::link($news->title, array('news/view', 'id' => $news->id));
                            ?>
                        </div>
                        <div class="general-new-image">
                            <?php
                            echo CHtml::link(
                                CHtml::image(Yii::app()->image->createUrl('news', Yii::app()->media->webroot . $news->image), $news->title, array('class' => 'img-responsive')),
                                array('news/view', 'id' => $news->id)
                            );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
</div>


<div class="container">
    <div class="section-title">Оплата и доставка<br/><span>C нами удобно!</span></div>
    <?php $this->renderPartial('//site/shipping-delivery') ?>
</div>

<div class="parallax-section parallax-4">
    <div class="container">
        <div class="section-title">Наши контакты</div>
        <?php $this->renderPartial('//satellite/short-contact-sand') ?>
    </div>
</div>

