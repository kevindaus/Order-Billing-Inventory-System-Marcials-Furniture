<?php

/**
 * admin
 * admin
 */



// defined('YII_DEBUG') or define('YII_DEBUG',true);
// defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);



// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';


require_once($yii);
Yii::createWebApplication($config)->run();
