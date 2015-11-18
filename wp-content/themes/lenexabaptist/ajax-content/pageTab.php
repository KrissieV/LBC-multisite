<?php 
if(isset($_POST['i'])){
   $i=$_POST['i']; }?>
<?php 
	include("../../../../wp-load.php");
	global $wpdb; ?>
	
	<?php $args = array('post_type' => 'page','page_id' => $i);
		$loop = new WP_Query( $args ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
			<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lenexabaptist' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'lenexabaptist' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	

			
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>

<script type="text/javascript">
		$(document).ready(function() {
			$('.gallery-icon a').attr('data-fancybox-group','gallery');
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.gallery-icon a').fancybox({
				maxHeight: '400',
			});

			/*
			 *  Different effects
			 */


		});
	</script>
	
<?php die(); ?>