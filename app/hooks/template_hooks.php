<?php

$app->hook('slim.before.dispatch', function () use ($app) {
	$app->render('html_header.php');
});
  
$app->hook('slim.after.dispatch', function () use ($app) {
	$app->render('html_footer.php');
});
