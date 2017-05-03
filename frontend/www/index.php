<?php
header('Content-Type: text/html; charset=utf-8');
$yii=dirname(__FILE__).'/../../../../framework/yiilite.php';
$configFile = dirname(__FILE__).'/../config/main.php';
require_once($yii);
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

Yii::createWebApplication($configFile)->run();