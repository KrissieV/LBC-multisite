<?php 
if(isset($_POST['i'])){
   $i=$_POST['i']; }?>
<?php 
	include("../../../../wp-load.php");
	global $wpdb; ?>
	<?php
	$test = eme_get_events_list("limit=10&category=".$i."&long_events=1&template_id=3&echo=false&show_recurrent_events_once=1");
	$count = strlen($test);
	if ($count == 33) {
	
	echo '<p>There are no events for this ministry currently scheduled. Check back soon for updates.</p>';
	
	} else {
		eme_get_events_list("limit=10&category=".$i."&long_events=1&template_id=3&show_recurrent_events_once=1");
	};
 ?>

	
<?php die(); ?>