<?php

// GET index route
$app->get('/', function () use ($app) {
    //$oStuff = new models\Stuff();
    //$hello = $oStuff->setStuff();
	
	$settingValue = $app->config('test_config_value');

    $app->render('index.home.php', array('hello' => 'a string', 'settingvalue'=>$settingValue));
});