<!DOCTYPE html>
<html>
<head>
    <?php
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/menu.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/non-responsive.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/product.css');
    $this->renderPartial('//satellite/head');
    ?>
</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">(function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter21978943 = new Ya.Metrika({id: 21978943, webvisor: true, clickmap: true, trackLinks: true, accurateTrackBounce: true});
            } catch (e) {
            }
        });
        var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
            n.parentNode.insertBefore(s, n);
        };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");</script>
<noscript>
    <div><img src="//mc.yandex.ru/watch/21978943" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<div id="flash">
    <div class="inner"></div>
</div>

<?php $this->renderPartial('//satellite/muwu-menu')?>
<div class="container">
    <div id="header">
        <div class="mymagformers navbar-header">
            <a class="navbar-brand" href="/">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/logo-magformers.png" alt="Мой магформерс"/>
            </a>
        </div>

        <div class="header-menu">
            <?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                    array('label' => 'Главная', 'url' => Yii::app()->homeUrl, 'itemOptions'=>array('class'=>'blue')),
                    array('label' => 'Каталог', 'url' => array('/products/index'), 'itemOptions'=>array('class'=>'red')),
                    array('label' => 'Контакты', 'url' => array('/site/contact'), 'itemOptions'=>array('class'=>'green')),
                    array('label' => 'Доставка', 'url' => array('/site/page', 'view' => 'shipping'), 'itemOptions'=>array('class'=>'yellow')),
                    array('label' => 'Оплата', 'url' => array('/site/page', 'view' => 'payment'), 'itemOptions'=>array('class'=>'red')),
                    array('label' => 'Новости', 'url' => array('/news/index'), 'itemOptions'=>array('class'=>'green')),
                    array('label' => 'Корзина('.Cart::countHtml().')', 'url' => array('/cart/index'), 'itemOptions'=>array('class'=>'pull-right yellow')),
//                        array('label' => 'Карта сайта', 'url' => array('/site/page', 'view' => 'payment')),
                ),
                'encodeLabel' => false,
                'linkLabelWrapper'=>'span',
            )); ?>
        </div>
        <div class="top-row">
            <?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                    array('label' => 'Элементы Magformers', 'url' => array('/site/page', 'view' => 'elements')),
                    array('label' => 'Развитие навыков', 'url' => array('/site/page', 'view' => 'skills')),
                    array('label' => 'Безопасность', 'url' => array('/site/page', 'view' => 'safety')),
                    array('label' => 'Для всех возрастов','url' => array('/site/page', 'view' => 'adv')),
                    array('label' => 'Награды Magformers','url' => array('/site/page', 'view' => 'awards')),
                ),
                'htmlOptions' => array(
                    'class'=>'links'
                ),
                'linkLabelWrapper'=>'span',
            )); ?>
        </div>
    </div>

    <div id="main">
        <?= $content; ?>
    </div>

    <div id="footer">
        <div class="block-copy">
            <?php echo date('Y') ?> &copy; <a href="http://bamboogroup">BambooGroup</a> Все права защищены
            <span class="pull-right"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/payment.png') ?></span>
        </div>
        <div class="footer-content">
            <div class="footer-col">
                <h4>Информация</h4>
                <ul>
                    <li><?php echo CHtml::link('О магазине', array('/site/page', 'view' => 'about'))?></li>
                    <li><a href="#">Сервис</a></li>
                    <li><a href="#">Безопасность</a></li>
                    <li><a href="#">О магазине</a></li>
                    <li><a href="#">Поиск</a></li>
                    <li><a href="#">Заказ и возврат</a></li>
                    <li><?php echo CHtml::link('Обратная связь', array('/site/contact'))?></li>
                </ul>

            </div>
            <div class="footer-col">
                <h4>Оплата и доставка</h4>
                <ul>
                    <li><?php echo CHtml::link('Оплата', array('/site/page', 'view' => 'payment'))?></li>
                    <li><?php echo CHtml::link('Доставка', array('/site/page', 'view' => 'shipping'))?></li>
                    <li><a href="#">Безопасная покупка</a></li>
                    <li><a href="#">Доставка и возврат</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Наш магазин</h4>
                <p>Санкт-Петербург<br/> ТРК "Модный променад", Комендантский пр., д. 9, к. 2, лит. A<br/>
                    Ежедневно с 10:00 до 22:00</p>
                <h4>Контакты</h4>

                <div class="row">
                    <div class="col-md-9 col-lg-9"><b><?php echo Yii::app()->shop->phone ?></b></div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-lg-9"><b><a href="mailto:<?php echo Yii::app()->shop->email ?>"><?php echo Yii::app()->shop->email ?></a></b></div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3">Скайп:</div>
                    <div class="col-md-9 col-lg-9"><b><a href="skype:ekaterina_koptelova">ekaterina_koptelova</a></b></div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3">ВК:</div>
                    <div class="col-md-9 col-lg-9"><b><a href="https://vk.com/koptelovaea" target="_blank">vk.com/koptelovaea</a></b></div>
                </div>


            </div>
            <div class="footer-col">
                <h4>Мы ВКонтакте</h4>
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
                <div id="vk_groups"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 0, width: "340", height: "120", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 57320319);
                </script>
            </div>
        </div>
    </div>
</div>




</body>
</html>