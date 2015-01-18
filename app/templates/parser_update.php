

<?php render_h1('File Parser Update'); ?>
	

Status: <?php print $status; ?> <hr>

Pre Update:  <?php render_table($query_result); ?>

Post Update: <?php render_table($query_result2); ?>