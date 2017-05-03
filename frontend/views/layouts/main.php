<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>
    <meta property="og:image" content="<?php echo $this->ogImage ? $this->ogImage : Yii::app()->request->baseUrl.'/img/androids/android.jpg' ?>">
    <meta property="og:site_name" content="Android-Doll | Коллекционные фигурки android">
    <meta property="og:description" content="Рады предложить Вам интересные, коллекционные игрушки, в виде роботов Android!
Это маленькие яркие, очень милые и забавные колекционные фигурки-роботы!
Каждый из вас найдет фигурку по душе, которая будет характеризовать именно Вас!
Лучший подарок всем, кто пользуется мобильными смартфонами и планшетами с операционной системой Google Android.">
    <meta property="og:type" content="website">

    <meta name="description" content="Рады предложить Вам интересные, коллекционные игрушки, в виде роботов Android!
Это маленькие яркие, очень милые и забавные колекционные фигурки-роботы!
Каждый из вас найдет фигурку по душе, которая будет характеризовать именно Вас!
Лучший подарок всем, кто пользуется мобильными смартфонами и планшетами с операционной системой Google Android.">

    <meta name="keywords" content="коллекционные фигурки android, коллекционирование игрушек, коллекционирование фигурок, игрушки андроид, фигурки андроид, android mini collectibles series 01, android mini collectibles series 0, android mini collectibles series 03">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->pageTitle; ?></title>


    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"
          media="screen"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.countdown.css"
          media="screen"/>

    <script type="text/javascript" src="//vk.com/js/api/openapi.js?98"></script>
    <script type="text/javascript">
        VK.init({apiId: 3820246, onlyWidgets: true});
    </script>

    <?php Yii::app()->clientScript->registerScript('fancy',"
        $('.fancybox').fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
		$('.buy').click(function(){
		    $.ajax({
		        type: 'POST',
		        url: $(this).attr('href'),
		        success: function(data){
		            var count = $(data).find('#cart');
                    $('#cart').text(count.text());
                    $('#flash .inner').text('Андроид добавлен в корзину!')
                    $('#flash').show();
                    setTimeout(function(){
                         $('#flash').hide();
                    },3000);
		        }
		    });

		    return false;
	});

    $(document).on('click','.option',function(){
        var opt = $(this);
        $.ajax({
            type: 'POST',
            url: opt.attr('href'),
            success: function(data){
                var count = $(data).find('#cart');
                $('#cart').text(count.text());
                $('#main').html($(data).find('#main').html());
            }
        });

        return false;
	});
    ", CClientScript::POS_READY)?>
</head>
<body>
<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter21978943 = new Ya.Metrika({id:21978943, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/21978943" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<div id="flash">
    <div class="inner"></div>
</div>

<div id="wrap">

    <div class="navbar">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">android-doll.ru</a>
            <div class="nav-collapse collapse">
                <?php $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Обзор', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Доставка', 'url' => array('/site/page', 'view' => 'shipping')),
                        array('label' => 'Оплата', 'url' => array('/site/page', 'view' => 'payment')),
                        array('label' => 'Контакты', 'url' => array('/site/page', 'view' => 'contact')),
                        array('label' => 'Корзина('.Yii::app()->cart->total('count').')', 'url' => array('/cart/index'), 'linkOptions'=>array('id'=>'cart')),
                    ),
                    'htmlOptions' => array(
                        'class' => 'nav navbar-nav pull-right'
                    )
                )); ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div id="main">
        <div class="container">
            <div class="inner">
                <?= $content; ?>
            </div>
        </div>
    </div>

    <?php
    if (!empty($this->clips['recommend']))
        echo $this->clips['recommend'];
    ?>

    <?php
    if (!empty($this->clips['comments']))
        echo $this->clips['comments'];
    ?>
</div>


<div id="footer">
    <div class="container">
        <div class="inner row">
            <div class="col-lg-12 text-center">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand visible-sm" href="/">android-doll.ru</a>
                            <div class="nav-collapse collapse">
                                <?php $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array('label' => 'Обзор', 'url' => array('/site/page', 'view' => 'about')),
                                        array('label' => 'Доставка', 'url' => array('/site/page', 'view' => 'shipping')),
                                        array('label' => 'Оплата', 'url' => array('/site/page', 'view' => 'payment')),
                                        array('label' => 'Купоны', 'url' => array('/site/page', 'view' => 'coupons')),
                                        array('label' => 'Предзаказ', 'url' => array('/site/page', 'view' => 'reservation')),
                                        array('label' => 'Контакты', 'url' => array('/site/page', 'view' => 'contact')),
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'nav navbar-nav'
                                    )
                                )); ?>
                            </div><!--/.nav-collapse -->
                        </div>
                    </div>
                </div>
                <div class="green">2013 &copy; <a href="/">Android Doll</a> Все права защищены</div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.countdown.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.countdown.init.js"></script>
</body>
</html>