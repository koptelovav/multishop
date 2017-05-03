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

    <div class="header-banner-wr hidden-xs">
        <div class="header-banner"></div>
    </div>

    <div class="row user-info">
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
        <div class="section-title">Kinetic Sand <br/> <span>Описание и свойства</span></div>

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <p>
                    Kinetic Sand (новинка 2013 года!) совершенно новый и необычный материал для и игры, учебных
                    процессов
                    так и
                    для терапевтических целей.
                </p>

                <p>
                    Kinetic Sand похож на мокрый пляжный песок, но в то же время он мягкий и пушистый, и течет сквозь
                    пальцы,
                    оставляя при этом руки чистыми и сухими. Kinetic Sand не рассыпается как обычный песок и очень легко
                    собирается даже если попадет на ковер.
                </p>
                <ul>
                    <li>Kinetic Sand состоит на 98% из чистого песка и 2% нетоксичного связующего.</li>
                    <li>Он никогда не сохнет</li>
                    <li>Оставляет все поверхности совершенно чистыми</li>
                    <li>Неблагоприятная среда для размножения бактерий</li>
                    <li>Предназначен для детей 3 +</li>
                    <li>100% оригинальный продукт</li>
                    <li>Изготовлено в Швеции</li>
                </ul>
                <p>
                    Кинетический песок - это инновационный материал для творчества и игр, учебного и познавательного
                    процесса. С
                    его помощью ребенок будет поглощен увлекательной игрой, . Также его можно использовать в
                    терапевтических
                    целях.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6 k-video">
                <iframe width="100%" height="auto"  style="border: 10px solid #c57622"
                        src="//www.youtube.com/embed/i15bTaD2rgM?showinfo=0&controls=0&modestbranding=0&loop=1&playlist=i15bTaD2rgM"
                        frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6 text-right k-video">
                <iframe width="100%" height="auto"   style="border: 10px solid #c57622"
                        src="//www.youtube.com/embed/50_-zqsgDA4?showinfo=0&controls=0&modestbranding=0&loop=1&playlist=50_-zqsgDA4"
                        frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

    </div>
</div>


<div class="container">
    <div class="section-title">Актуальные акции и спецпредложения</div>
<!---->
<!--    <div class="row">-->
<!--        <div class="col-lg-12 text-center">-->
<!--            <a href="--><?//= Yii::app()->createUrl('products/sale') ?><!--">-->
<!--                <img style="display: inline-block !important;" class="img-responsive" src="--><?//= Yii::app()->theme->baseUrl?><!--/img/sale.jpg" alt="Скидка на кинетический песок, Bubber, Магформерс"/>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->


    <?php $action = array(
        'action1' => array(
            'img' => 'delivery.png',
            'text' => 'Скидка на доставку 300 рублей при заказе от 4000 рублей.<br/>
    Ищите товары с оранжевым стикером. На стикере указана скидка на доставку. Размер скидки может составлять до 700 рублей!<br />
    Скидки на доставку не суммируются друг с другом.'
        ),
        'action2' => array(
            'img' => 'nordik.jpg',
            'text' => 'Дарим самосвал «Нордик» при оплате заказа в интрнет-магазине в течении трех часов после оформления заказа <br/>(при сумме заказа от 2000 р.)'
        ),
        'action4' => array(
            'img' => 'skidka_5_protcentov.jpg',
            'text' => 'За каждую покупку в магазине или интернет-магазине мы дарим магнитик с кодом на скидку 5% (можно делиться с друзьями)'
        ),

        'action5' => array(
            'img' => 'lopatka_grabli.jpg',
            'text' => 'Бесплатные лопатка и грабельки. '.CHtml::link('Условия получения читайте далее...', array('news/view','id'=>50))
        ),
    ); ?>

    <div class="row">
        <?php $this->renderPartial('_action', array('data' => $action['action1'])) ?>
        <?php $this->renderPartial('_action', array('data' => $action['action2'])) ?>
    </div>

    <div class="row">
        <?php $this->renderPartial('_action', array('data' => $action['action4'])) ?>
        <?php $this->renderPartial('_action', array('data' => $action['action5'])) ?>
    </div>
</div>

<div class="parallax-section parallax-2">
    <div class="container">
        <div class="section-title">Чем полезен песок?</div>

        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6">
                    <p class="h2">
                        Для мам и пап
                    </p>
                    <p class="bold" style="line-height: 22px">
                        &bull; Надолго занимает ребенка<br/>
                        &bull; Развивает воображение<br/>
                        &bull; Развивает мелкую моторику<br/>
                        &bull; Успокаивает как детей, так и взрослых<br/>
                        &bull; Никаких микробов<br/>
                        &bull; Легко убрать с любой поверхности<br/>
                    </p>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                    <p class="h2">
                        Для сыновей и дочек
                    </p>
                    <p class="bold" style="line-height: 22px">
                        &bull; Песочница дома круглый год<br/>
                        &bull; Весело играть одному и с друзьями<br/>
                        &bull; Такой только у тебя<br/>
                        &bull; Построй замок для своих игрушек<br/>
                        &bull; Легко играть без помощи взрослых<br/>
                        &bull; Никогда не надоедает<br/>
                    </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="section-title"> Кинетический песок, <span>наборы&nbsp;и&nbsp;аксессуары</span></div>
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
                                CHtml::image(Yii::app()->image->createUrl('news', Yii::app()->media->webroot . $news->image), $news->title, array( 'class'=>'img-responsive')),
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
    <div class="section-title">Оплата и доставка<br /><span>C нами удобно!</span></div>
    <?php $this->renderPartial('//site/shipping-delivery') ?>
</div>

<div class="parallax-section parallax-4">
    <div class="container">
        <div class="section-title">Наши контакты</div>
        <?php $this->renderPartial('//satellite/short-contact-sand') ?>
    </div>
</div>

