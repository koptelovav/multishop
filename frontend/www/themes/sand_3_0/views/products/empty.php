<div itemscope itemType="https://schema.org/WebPage">
    <section class="landing-section first-section">
        <div class="section-content row">
            <span class="landing-section--title">Что такое Kinetic Sand?</span>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="media">
                    <div class="pull-left">
                        <img class="img-circle media-object"
                             src="<?= Yii::app()->theme->baseUrl ?>/img/icon/girl.jpg">
                    </div>
                    <div class="media-body">
                        <p>
                            Kinetic Sand (новинка 2013 года!) совершенно новый и необычный материал для и игры,
                            учебных
                            процессов
                            так и
                            для терапевтических целей.

                            Kinetic Sand похож на мокрый пляжный песок, но в то же время он мягкий и пушистый, и
                            течет
                            сквозь
                            пальцы,
                            оставляя при этом руки чистыми и сухими. Kinetic Sand не рассыпается как обычный песок и
                            очень
                            легко
                            собирается даже если попадет на ковер.

                            Кинетический песок - это инновационный материал для творчества и игр, учебного и
                            познавательного
                            процесса. Купить кинетический песок в Москве и Санкт-Петербурге Вы можете в нашем интернет-магазине. А также заказать доставку по всей России!
                            С
                                его помощью ребенок будет поглощен увлекательной игрой. Также его можно использовать в
                            терапевтических
                            целях.
                            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/quote_close.png">
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="landing-section third-section">
        <span class="landing-section--title">Самые популярные товары</span>
        <?php $this->widget('frontend.widgets.BlockProductWidget', array(
            'identifier' => 'KINETIK_HIT',
        ))?>
    </section>



    <section class="landing-section third-section">
        <span class="landing-section--title">Актуальные акции и спецпредложения</span>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-xs-12">
                <a href="/megasale">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/img/megasale.jpg" class="img-responsive" alt="">
                </a>
            </div>
        </div>

        <?php $this->renderPartial('action') ?>
    </section>

    <section class="second-section">
        <div class="section-content row">
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
    </section>

    <section class="landing-section third-section">
        <span class="landing-section--title">Каталог товаров</span>
        <?php $this->renderPartial('_catalog') ?>
    </section>


    <section class="landing-section video-section">
        <div class="section-content row">
            <span class="landing-section--title">Видеообзоры наших товаров</span>
            <?php $this->widget('frontend.widgets.BlockVideoWidget', array(
                'identifier' => 'VIDEO_KINETICSAND'
            )) ?>
        </div>
    </section>
</div>