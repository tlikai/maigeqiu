<?php

$yii=dirname(__FILE__).'../../framework/yii.php';
$config=dirname(__FILE__).'../../app1/protected/config/app2.php';

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

Yii::createWebApplication($config)->run();
