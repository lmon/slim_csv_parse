<?php
// index.php
require '/Users/lmonaco/lib/vendor/autoload.php';
# http://www.slimframework.com/install

$app = new \Slim\Slim(array(
	'mode' => 'development',
	'debug' => true,
	'templates.path' => './templates'
	)
);

/*
// Automatically load all models
$models = glob('./models/*.php');
foreach ($models as $model) {
    //print $model;
    require $model;
}
*/
// Automatically load router files
$routers = glob('./routers/*.router.php');
foreach ($routers as $router) {
    require $router;
}


$app->run();
exit;

require_once '../parsecsv-for-php-master/parsecsv.lib.php';

$file = 'csv/talent_wo_gender_2858_markedMF.csv';
$csv = new parseCSV($file);

print_r($csv->data);

?>