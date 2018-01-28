<?php
/**
 * admin
 * admin
 */
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// change the following paths if necessary
$autoload = dirname(__FILE__).'/protected/vendor/autoload.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$yii=dirname(__FILE__).'/../yii/framework/yii.php';


define('DOMPDF_ENABLE_AUTOLOAD', false);

require_once $autoload;
require_once dirname(__FILE__).'/protected/vendor/dompdf/dompdf/dompdf_config.inc.php';
require_once($yii);
Yii::createWebApplication($config)->run();
