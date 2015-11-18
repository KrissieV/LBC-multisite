<?php
/**
 * @package lenexabaptist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="section">
<div class="col span_8_of_12">
	<?php 
		gravity_form( 1, false, false, false, '', false );
	?>

	
</div>
</div>
</article><!-- #post-## -->