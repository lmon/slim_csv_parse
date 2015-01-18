Parser Test

<?php render_h1('File Parser'); ?>
	
<?php render_h2($file); ?>

<form method="post" action="<?php echo Slim\Slim::getInstance()->urlFor('update-table'); ?>"><input type="submit" value="Update Talent table" />
</form> 


<?php render_table( $csv->data, array('use_head'=>1, 'head_data'=>$csv->titles, 'line_count'=>1) ); ?>

