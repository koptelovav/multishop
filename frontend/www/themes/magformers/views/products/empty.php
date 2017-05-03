<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->showHeader = false;
?>

<div class="index-row">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
    
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo Yii::app()->theme->baseUrl?>/img/gallery/slider1.png" alt="...">
            </div>
            <div class="item">
                <img src="<?php echo Yii::app()->theme->baseUrl?>/img/gallery/slider2.png" alt="...">
            </div>
            <div class="item">
                <img src="<?php echo Yii::app()->theme->baseUrl?>/img/gallery/slider3.png" alt="...">
            </div>
        </div>
    
        <!-- Controls -->
    
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        </a>
    </div>
    
    <div class="banner">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/banner.png" alt=""></a>
    </div>
</div>

<div class="block block-color block-red">
    <div class="block-title">Внимание</div>
    <div class="block-content">
        <p>
            Уважаемые покупатели.<br/>
            Сайт находится в разработке. Некоторые ссылки могут быть неактивны.<br/>
            Весь товар в наличии, все цены актуальны!
        </p>
    </div>
</div>

<div class="sm-banners">
    <div class="sm-banner">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/kids/sm_pic2.png" alt=""/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
           1 - 2<br/> года
        </a>
    </div>
    <div class="sm-banner">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/img/kids/sm_pic3.png" alt=""/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
           2 - 3<br/> года
        </a>
    </div>
    <div class="sm-banner">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/img/kids/sm_pic4.png" alt=""/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            3 - 5<br/> лет
        </a>
    </div>
    <div class="sm-banner">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/img/kids/sm_pic5.png" alt=""/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            5 - 7<br/> лет
        </a>
    </div>
    <div class="sm-banner">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/img/kids/sm_pic6.png" alt=""/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            7 - 12<br/> лет
        </a>
    </div>
    <div class="sm-banner">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/img/kids/sm_pic7.png" alt=""/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            12 - 15<br/> лет
        </a>
    </div>

    <div class="sm-banner">
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/img/kids/sm_pic8.png" alt=""/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'adv')) ?>">
            Взрослые дети
        </a>
    </div>
</div>

<div class="block block-color">
    <div class="block-title">Рассказ о новинках Magformers на выставке «Мир детства 2014»</div>
    <div class="block-content">
        <div class="row">
            <div class="col-lg-12">
                <iframe width="100%" height="400" src="//www.youtube.com/embed/Os-eMKQmPvo" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-center">Видеорассказ для родителей</h3>
                <iframe width="100%" height="400" src="//www.youtube.com/embed/brDK9QrpN-k" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6">
                <h3 class="text-center">Видеорассказ для детей</h3>
                <iframe width="100%" height="400" src="//www.youtube.com/embed/27CSEX7nOSg" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<?php /*$this->widget('frontend.widgets.BlockProductWidget', array(
    'identifier' => 'HIT_SALES'
))*/?>


