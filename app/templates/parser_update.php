

<?php render_h1('File Parser Update'); ?>
	

Status: <?php print $status; ?> <hr>

<?php render_h3('DB Pre Update: '.$query_result_count); ?>

<?php render_table($query_result); ?>

<?php render_h3('DB Post Update: '.$query_result2_count); ?>

<?php render_table($query_result2); ?>