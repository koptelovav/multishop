<div itemscope itemType="https://schema.org/WebPage">
    <section class="null-section">
        <div class="row presentation">
            <div class="col-xs-12">
                <img
                    src="<?= Yii::app()->theme->baseUrl ?>/img/general_photo.jpg"
                    alt="" class="img-responsive">
            </div>
        </div>
    </section>

    <section class="first-section">
        <div class="section-content row">
            <h2 class="text-center">Что такое Qixels (Квикселс)?</h2>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="media">
                    <div class="pull-left">
                        <img class="img-circle media-object"
                             src="<?= Yii::app()->theme->baseUrl ?>/img/icon/girl.jpg">
                    </div>
                    <div class="media-body">
                        <p>
                            Qixels (новинка 2016 года!) это невероятный новый подход к созаднию мозайки!

                            Если Вы впервые на нагем сайте, то такого Вы точно еще не видели (Обязательно посмотрите видео внизу страницы).

                            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/quote_close.png">
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="third-section">
        <h2>Акциии и спецпредложения</h2>
        <?php $this->renderPartial('action') ?>
    </section>

    <section class="second-section">
        <div class="section-content row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="box">
                    <h2>Чем Вас удивит Qixels?</h2>
                    <ul class="marked-list">
                        <li>Абсолютно новый подход к мозаике</li>
                        <li>Развивает моторику и воображение</li>
                        <li>Иновационный метод соединения деталей</li>
                        <li>Уникальные игровые акссеуары</li>
                        <li>Огромное разнообразие наборов</li>
                        <li>Легко играть без помощи взрослых</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>




    <section class="third-section">
        <h2>Каталог товаров</h2>
        <?php $this->renderPartial('_catalog') ?>
    </section>

    <?/*
    <section class="video-section">
        <div class="section-content row">
            <h2>Видеообзоры наших товаров</h2>
            <?php $this->widget('frontend.widgets.BlockVideoWidget', array(
                'identifier' => 'VIDEO_KINETICSAND'
            )) ?>
        </div>
    </section>
*/ ?>
</div>