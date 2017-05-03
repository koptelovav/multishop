<div class="row">
    <div class="col-xs-12 col-md-6 col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <p>Санкт-Петербург, Туристкая 23к2, инетернет-магазин Му!Ву!
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">Телефон:</div>
            <div class="col-lg-9"><b><?php echo Yii::app()->shop->phone ?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-3">ВКонтакте</div>
            <div class="col-lg-9"><b><a href="https://vk.com/koptelovaea" target="_blank">vk.com/koptelovaea</a></b></div>
        </div>
        <div class="row">
            <div class="col-lg-3">Почта</div>
            <div class="col-lg-9"><b><a href="mailto:<?php echo Yii::app()->shop->email ?>"><?php echo  Yii::app()->shop->email ?></a></b></div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-6">
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
        <div id="vk_groups"></div>
        <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 0, width: "350", height: "250", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 57874883);
        </script>
    </div>
</div>