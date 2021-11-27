<?php
	use yii\db\Connection;
	return [
		'class' => Connection::class,
		'dsn' => env('CONNECTION'). ':host=' .env('HOST'). ';dbname=' .env('DATABASE'),
		'username' => env('USERNAME'),
		'password' => env('PASSWORD'),
		'tablePrefix' => env('PREFIX'),
		'charset' => 'utf8',
		
		// Schema cache options (for production environment)
		//'enableSchemaCache' => true,
		//'schemaCacheDuration' => 60,
		//'schemaCache' => 'cache',
	];
