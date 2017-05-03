<?php $this->layout = '//layouts/common' ?>

<div itemscope itemType="https://schema.org/WebPage">
<div class="container">
    <div class="phones">
        <div>
            <div class="phone hidden-xs">
                <span>Санкт-Петербург</span> 8 (812) 309-06-80
            </div>
        </div>
        <div>
            <div class="phone hidden-xs">
                <span>Москва</span> 8 (499) 703-05-09
            </div>
        </div>
        <div>
        <div class="callback visible-lg">
            ПН-ПТ с 10:00 до 20:00
        </div>
        </div>
    </div>
</div>
<header>
    <div class="container">
        <div class="official"></div>
        <div class="logo"></div>
        <div class="play"></div>
    </div>


    <div class="video_widget">
        <video id="headerVideo" autoplay loop muted>
            <source src="<?= Yii::app()->theme->baseUrl ?>/video/intro.webm" type="video/webm">
            <source src="<?= Yii::app()->theme->baseUrl ?>/video/intro.ogg" type="video/ogg">
            <source src="<?= Yii::app()->theme->baseUrl ?>/video/intro.mp4" type="video/mp4">
        </video>
    </div>
</header>

<div class="icons">
    <div class="row">
        <div class="col-xs-6 col-md-2 col-lg-2">
            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/original.png" alt="">
            <div class="desc">Оригинальный продукт <br> Произведено в Швеции</div>
        </div>
        <div class="col-xs-6 col-md-2 col-lg-2">
            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/not_dry.png" alt="">
            <div class="desc">Никогда не сохнет<br> Оставляет поверхности чистыми</div>
        </div>
        <div class="col-xs-6 col-md-2 col-lg-2">
            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/microbes.png" alt="">
            <div class="desc">Неблагоприятная среда для размножения бактерий</div>
        </div>
        <div class="col-xs-6 col-md-2 col-lg-2">
            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/molecula.png" alt="">
            <div class="desc">Kinetic Sand состоит на 98% из чистого песка и 2% нетоксичного связующего.</div>
        </div>
        <div class="col-xs-6 col-md-2 col-lg-2">
            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/mozg.png" alt="">
            <div class="desc">Развивает творческое мышление</div>
        </div>
        <div class="col-xs-6 col-md-2 col-lg-2">
            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/thvetok.png" alt="">
            <div class="desc">Гипоаллергенен. Абсолютно безопасен для вашего ребенка</div>
        </div>
    </div>
</div>

<section class="first-section">
    <div class="container">
        <h2 class="text-center">Что такое Kinetic Sand?</h2>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="media">
                    <div class="pull-left">
                        <img class="img-circle media-object" src="<?= Yii::app()->theme->baseUrl ?>/img/icon/girl.jpg">
                    </div>
                    <div class="media-body">
                        <p>
                            Kinetic Sand (новинка 2013 года!) совершенно новый и необычный материал для и игры, учебных
                            процессов
                            так и
                            для терапевтических целей.
                        </p>

                        <p>
                            Kinetic Sand похож на мокрый пляжный песок, но в то же время он мягкий и пушистый, и течет
                            сквозь
                            пальцы,
                            оставляя при этом руки чистыми и сухими. Kinetic Sand не рассыпается как обычный песок и
                            очень
                            легко
                            собирается даже если попадет на ковер.
                        </p>

                        <p>
                            Кинетический песок - это инновационный материал для творчества и игр, учебного и
                            познавательного
                            процесса. С
                            его помощью ребенок будет поглощен увлекательной игрой. Также его можно использовать в
                            терапевтических
                            целях.
                            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/quote_close.png">
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center">Разновидности</h2>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="compare-logo">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/img/nav/kinetic.jpg" alt="">
                </div>
                <p class="text-justify">
                    Kinetic sand – Кинетический песок (Натуральный песок + 2% силикона)<br>
                    Оригинальный кинетический песок обладает целым набором удивительных свойств – он слипается и рассыпается, держит форму и течет сквозь пальцы. Его пушистая консистенция не оставит равнодушным ни детей, ни взрослых. Идеальный материал для организации домашней песочницы. Произведен в Швеции.
                </p>
                <ul>
                    <li>Течет сквозь пальцы</li>
                    <li>Развивает моторику рук</li>
                    <li>На ощупь как мокрый песок</li>
                    <li>Никогда не высыхает</li>
                    <li> Можно играть с года жизни (под присмотром взрослых)</li>
                </ul>
                <iframe width="100%" src="https://www.youtube.com/embed/Ln9YTcwgnWs" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="compare-logo">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/img/nav/skwooshi.jpg" alt="">
                </div>
                <p class="text-justify">
                    Skwooshi – Тесто для лепки (Кинетический песок смешан с жвачкой для рук)<br>
                    Абсолютная новинка из Швеции. Удивительный материал для лепки для тех кому надоело обычное тесто или пластилин. В этом тесте соединены свойства кинетического песка и жвачки для рук. Он растягивается, он слипается, он держит форму, он отскакивает при ударе и никогда не высыхает.
                </p>
                <ul>
                    <li>Подходит детям с трех лет</li>
                    <li>Мягкий и пластичный</li>
                    <li>Растягивается</li>
                    <li>Хорошо держит форму</li>
                    <li>Очень красивые наборы и качественные аксессуары</li>
                </ul>
                <iframe width="100%" src="https://www.youtube.com/embed/8puBk751_q0" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="compare-logo">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/img/nav/build.jpg" alt="">
                </div>
                <p class="text-justify">
                    Kinetic sand BUILD – Масса для лепки (На основе кинетического песка)<br>
                    Теперь песок не течет, а растягивается. Благодаря новым свойствам Вы можете строить очень прочные конструкции и детали для будущих зданий. Масса плотная, и растягивается как паутинка. Хорошо подойдет взрослым и детям с пяти лет, так как требуется прилагать усилие для лепки. Продукт произведен в Швеции.
                </p>
                <ul>
                    <li>Растягивается</li>
                    <li>Можно строить высокие и прочные строения</li>
                    <li>Никогда не высыхает</li>
                    <li>Отличный антистресс, приятно мять в руках</li>
                </ul>
                <br>
                <iframe width="100%" src="https://www.youtube.com/embed/leWJzgC1UGs" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

<section class="second-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="box">
                    <h2>Чем полезен песок?</h2>
                    <ul class="marked-list">
                        <li>Надолго занимает ребенка</li>
                        <li>Развивает воображение и мелкую моторику</li>
                        <li>Успокаивает как детей, так и взрослых</li>
                        <li>Песочница дома круглый год</li>
                        <li>Весело играть одному и с друзьями</li>
                        <li>Построй замок для своих игрушек</li>
                        <li>Легко играть без помощи взрослых</li>
                        <li>Никогда не надоедает</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="third-section">
    <div class="container">
        <h2>Актуальные акции и спецпредложения</h2>
        <?php $action = array(
            'action1' => array(
                'title'=>'Доставка',
                'img' => 'shipping.jpg',
                'text' => 'Скидка на доставку 300 рублей при заказе от 4000 рублей *<br/>
        * Бесплатна по Санкт-Петербургу и всего 100 рублей по Москве'
            ),
            'action2' => array(
                'title'=>'Опалата',
                'img' => 'nordik.jpg',
                'text' => 'Дарим машинку «Нордик» при оплате заказа в течении трех часов после оформления заказа <br/>(при сумме заказа от 2500 р.)'
            ),
            'action4' => array(
                'title'=>'Скидки',
                'img' => 'sale.jpg',
                'text' => 'За каждую покупку в интернет-магазине мы дарим магнитик с кодом на скидку 5% (скидкой можно делиться с друзьями)'
            ),

            'action5' => array(
                'title'=>'Репосты',
                'img' => 'lopatka.jpg',
                'text' => 'Бесплатные лопатка и грабельки за репост вокнтакте<br>' . CHtml::link('Условия получения читайте далее...', array('news/view', 'id' => 50))
            ),
        ); ?>

        <div class="row">
            <?php $this->renderPartial('_action', array('data' => $action['action1'])) ?>
            <?php $this->renderPartial('_action', array('data' => $action['action2'])) ?>
            <?php $this->renderPartial('_action', array('data' => $action['action4'])) ?>
            <?php $this->renderPartial('_action', array('data' => $action['action5'])) ?>
        </div>

    </div>
</section>


<section class="third-section">
    <div class="container">
        <h2>Видеообзоры наших товаров</h2>
        <?php $this->widget('frontend.widgets.BlockVideoWidget', array(
            'identifier' => 'VIDEO_KINETICSAND'
        )) ?>
    </div>
</section>



<section class="fourth-section">
<div class="container">
    <h2> Кинетический песок, наборы&nbsp;и&nbsp;аксессуары</h2>

    <?php $this->renderPartial('_catalog') ?>
</div>
</section>

