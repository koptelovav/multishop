<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>
    <meta name="viewport" content="user-scalable=no" />
    <title><?php echo $this->pageTitle; ?></title>

    <?php
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap.min.css');
    $cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/whhg.css');
    $cs->registerCoreScript('jquery');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.cookie.js');
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/main.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap.min.js');
    Yii::app()->shop->registerTemplateCss();
    ?>
</head>
<body>
<a href="#" id="overlay"></a>
<div id="wrap">
    <nav class="navbar navbar-moby" role="navigation">
        <div class="row">
            <?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                    array('label' => '', 'url' => array('/orders/index'), 'itemOptions'=>array('class'=>'col-xs-4 col-lg-4'), 'linkOptions'=>array('class'=>'icon-th-list')),
                    array('label' => '', 'url' => array('/orders/index', 'Orders'=>array('tags'=>array(1,2))), 'itemOptions'=>array('class'=>'col-xs-4 col-lg-4'), 'linkOptions'=>array('class'=>'icon-phonebook')),
                    array('label' => '', 'url' => array('/orders/picker'), 'itemOptions'=>array('class'=>'col-xs-4 col-lg-4'), 'linkOptions'=>array('class'=>'icon-shoebox')),
                ),
                'htmlOptions' => array(
                    'class' => 'nav navbar-nav'
                ),
                'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
            )); ?>
        </div>
    </nav>

    <div id="main">
        <div class="container-fluid">
        <?= $content; ?>
        </div>
    </div>
</div>
</body>
</html>