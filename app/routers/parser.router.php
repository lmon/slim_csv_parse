<?php

require_once '/Library/WebServer/Documents/iflist/iflist-testing/tests/parsecsv-for-php-master/parsecsv.lib.php';

$parser_helper = new Parser_Helper();

// GET index route
$app->get('/parse', function () use ($app) {
    $app->render('parser.php', array('hello' => 'doin stuff' ));
})->name('home');


$app->get('/parse/test', function () use ($app) {

	$file = '/Library/WebServer/Documents/iflist/iflist-testing/csv-data/talent_wo_gender_2858_markedMF.csv';
	$csv = new parseCSV($file);
    $app->render('parser_test.php', array('csv' => $csv, 'file'=>$file));

})->name('test');


$app->post('/parse/update', function () use ($app, $parser_helper, $capsule) {
	$status = "..procesing ";
	$query_result = array();
    $query_result2 = array();

	$query_result = $parser_helper->query_for_gender_blank('talent', array('talent_id', 'gender'));

	if($backup = $parser_helper->backup_table($capsule, 'talent')){
		$status .= "..backing up ";
		if( $execute = $parser_helper->update_rows_from_csv() ){
			$status .= "..updating ";
			$result = $parser_helper->query_for_gender_blank('talent', array('talent_id', 'gender'));
		}else{
			$status .= "..execute fail ";

		}
	}else{
		$status .= "..back up fail";

	}	

    $app->render('parser_update.php', array(
    	'status' => $status, 
    	'query_result' => $query_result,
    	'query_result2' => $query_result2,
    	));


})->name('update-table');




