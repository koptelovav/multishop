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
            <h2 class="text-center">Кто такие Hatchimals (Хетчималс)?</h2>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="media">
                    <div class="pull-left">
                        <img class="img-circle media-object"
                             src="<?= Yii::app()->theme->baseUrl ?>/img/icon/girl.jpg">
                    </div>
                    <div class="media-body">
                        <p>
                            Ваш ребенок просит завести питомца, но по каким-то причинам вы не можете этого сделать? Не
                            беда! Порадуйте малыша новым, почти настоящим и живым другом – интерактивной игрушкой
                            Hatchimals (Хетчималс).
                        <p>
                        </p>
                            Hatchimals – это не просто зверек на батарейках. При должном уходе и заботе из
                            20-сантиметрового яйца вылупится дружелюбный неуклюжий непоседа Пингвиненок или смелый и
                            энергичный Дракоша. Причем нельзя угадать, какого цвета будет ваш питомец: розовым или
                            зеленым, а может фиолетовым? Каким он вырастет – тоже неизвестно. Его воспитание ляжет на
                            плечи маленького хозяина игрушки. <?= SHtml::newsLink(66, 'Читать далее...', array('style'=>'color:#fff')) ?>
                            <img src="<?= Yii::app()->theme->baseUrl ?>/img/icon/quote_close.png">
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="second-section">
        <div class="section-content row">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="box">
                    <h2>Что подарит Вам Hatchimals?</h2>
                    <ul class="marked-list">
                        <li>Надолго занимает ребенка</li>
                        <li>Учит заботе и любви</li>
                        <li>Опыт по уходу за детьми</li>
                        <li>Качественная игрушка</li>
                        <li>Новинка 2016 года</li>
                        <li>Hatchimals - иновация</li>
                        <li>Легко играть без помощи взрослых</li>
                    </ul>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">
                <img src="<?= Yii::app()->theme->baseUrl ?>/img/twohatch.jpg">
            </div>
        </div>
    </section>

    <section class="third-section">
        <h2>Акциии и спецпредложения</h2>
        <?php $this->renderPartial('action') ?>
    </section>

    <section class="third-section">
        <h2>Каталог товаров</h2>
        <?php $this->renderPartial('_catalog') ?>
    </section>

    <? /*
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