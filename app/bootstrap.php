<?php

require '../vendor/autoload.php';

require_once "../vendor/config/app_config.php";//$db_vars

require_once '../vendor/config/database.php';

$app_basedir = "../app/";

# http://www.slimframework.com/install

$app = new \Slim\Slim(array(
	'mode' => 'development',
	'debug' => true,
	'templates.path' => $app_basedir.'templates',
	'test_config_value' => 'testcfval',// messing around

	)
);


// Automatically load all models
$models = glob('../app/models/*.php');
foreach ($models as $model) {
    require_once $model;
}

// Automatically load hooks 
$hooks = glob($app_basedir.'hooks/*_hooks.php');
foreach ($hooks as $hook) {
    require_once $hook;
}

// Automatically load helpers files
// includes views, controllers, etc..
$helpers = glob($app_basedir.'helpers/*/*_helper.php');
foreach ($helpers as $helper) {
    require_once $helper;
}
// Automatically load router files
$routers = glob($app_basedir.'routers/*.router.php');
foreach ($routers as $router) {
    require_once $router;
}

 
