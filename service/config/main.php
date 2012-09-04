<?php

Yii::setPathOfAlias('manager', dirname(__FILE__) . '/../../manager/protected/');

return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => '成人街 - 淘宝应用',
    'timeZone' => 'Asia/Shanghai',

	'preload' => array('log'),

	'import' => array(
		'manager.models.*',
// 		'application.models.*',
		'application.components.*',
	),

	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'tbk',
			'ipFilters' => array('127.0.0.1','::1'),
		),
	),
        
	'components' => array(
		'user' => array(
			'allowAutoLogin'=>true,
		),

		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=tbk',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		'cache' => array(
			'class' => 'CFileCache',
            'directoryLevel' => 2,
		),
	        
		'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
	        
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
				),
			),
		),
	),

	'params' => array(
		'appkey' => '12645927',
        'secretKey' => '046b321a6b99b6242c3a6d55c69d21f2',
        'pid' => '10575377',
        'start_price' => 1,
        'end_price' => 60,
        'sort' => 'commissionNum_desc',
        'appId' => '1'
	),
);
