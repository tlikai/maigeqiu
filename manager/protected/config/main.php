<?php
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '后台管理',
    'timeZone' => 'Asia/Shanghai',
    'language' => 'zh_cn',

	'preload' => array('log'),

	'import' => array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'tbk',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
        
	'components' => array(
		'user' => array(
			'allowAutoLogin' => true,
		),

		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=tbk',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
			'tablePrefix' => '',
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
		
		'topClient' => array(
			'class' => 'Top',
			'appkey' => '21030036',
			'secretKey' => '0e1c877e7dfa827ac605c527cf84163b',
			'format' => 'json',
			'pid'=>'31887621',
		),
	),
	
	'params' => array(
		'adminEmail' => 'webmaster@example.com',
        'appkey' => '21030036',
        'secretKey' => '0e1c877e7dfa827ac605c527cf84163b',
        'pid' => '31887621',
        'start_price' => 1,
        'end_price' => 60,
        'sort' => 'commissionNum_desc',
        'cacheDomain' => 'http://tb.com/index.php?r=site/clearCache'
	),
);