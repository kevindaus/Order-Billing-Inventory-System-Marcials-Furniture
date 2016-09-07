<?php

// uncomment the following to define a path alias
Yii::setPathOfAlias('uploadedImage',dirname(__FILE__).'/../../themes/abound/uploads');
Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yii-chartjs');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Order Billing Inventory System Marcials Furniture',
    'theme' => 'abound',
    'preload' => array('log'),
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.forms.*',
        'application.components.*',
        'bootstrap.helpers.TbHtml',
        'bootstrap.helpers.TbArray',
        'bootstrap.behaviors.TbWidget',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.libs.invoice.*',
        'application.libs.products.*',
        'application.libs.dashboard.*',
    ),
    'modules' => array(
        'user'=>array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            'hash' => 'md5',
            'sendActivationMail' => true,
            'loginNotActiv' => false,
            'activeAfterRegister' => false,
            'autoLogin' => true,
            'registrationUrl' => array('/user/registration'),
            'recoveryUrl' => array('/user/recovery'),
            'loginUrl' => array('/user/login'),
            'returnUrl' => array('/home'),
            'returnLogoutUrl' => array('/user/login'),
        ),
        'rights'=>array(
           'superuserName'=>'admin',
           'authenticatedName'=>'Authenticated',
           'userIdColumn'=>'id',
           'userNameColumn'=>'username',
           'enableBizRule'=>true, 
           'enableBizRuleData'=>true, 
           'displayDescription'=>true, 
           'flashSuccessKey'=>'RightsSuccess',
           'flashErrorKey'=>'RightsError',
           'baseUrl'=>'/rights',
           'layout'=>'rights.views.layouts.main',
           'appLayout'=>'application.views.layouts.main',
           'cssFile'=>'rights.css',
           'install'=>false,
           'debug'=>false, 
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user'=>array(
                'class'=>'RWebUser',
                'rightsReturnUrl'=>array('authItem/roles'),
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
        ),
        'authManager'=>array(
                'class'=>'RDbAuthManager',
                'rightsTable'=>'rights',
                'connectionID'=>'db',
                'defaultRoles'=>array('Authenticated', 'Guest'),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'yiiwheels' => array(
            'class' => 'ext.yiiwheels.YiiWheels',
        ),

        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '/invoice/print/<id:\w+>'=>'invoice/print',
                '/home'=>'site/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=orderbillinginventorymf',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',  
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    // 'class' => 'CFileLogRoute',
                    'class' => 'CWebLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
              array(
              'class'=>'CEmailLogRoute',
              'levels'=>'error',
              'emails'=>'hellsing357@gmail.com',
              ),
             */
            ),
        ),
    ),
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'company_name' => 'Marcials Furniture',
        'company_street' => '#123 Test Street',
        'company_city' => 'Test City , Nueva Vizcaya',
        'company_zipcode' => '3709',
        'company_tel_number' => '+63 906 123 4567',
        'company_fax' => '+63 906 123 4567',
        'tax_percentage' => '0.5%',
    ),
);
