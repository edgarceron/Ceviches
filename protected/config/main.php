<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sofint New',
        'theme'=>'classic',
        'language'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),
        'defaultController' => 'site/index',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',                        
                        'generatorPaths'=>array(
                            'application.gii',   // a path alias
                        ),
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),                        
		),
		
				
		'admin'=>array
		(
			'nombre'=>'Admin',
			'modulo'=>'1',
			'padre'=>'',
			'desplegable' => true,
			'version'=>0,
		),                
		'plugins'=>array
		(
			'nombre'=>'Plugins',
			'modulo'=>'1-1',
			'padre'=>'admin',
			'desplegable' => false,
			'version'=>0,
		),
		'maestros'=>array
		(
			'nombre'=>'Maestros',
			'modulo'=>'1',
			'padre'=>'',
			'desplegable' => true,
			'version'=>1,
		),
			
		'usuarios'=>array
		(
			'nombre'=>'Usuarios',
			'modulo'=>'1-3',
			'padre'=>'plugins',
			'desplegable' => false,
			'version'=>0,
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		 'metadata'=>array('class'=>'Metadata'),
		
		'urlManager'=>array(                    
			'urlFormat'=>'path',                        
			'rules'=>array(                                    
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',                            
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sofintbase',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);