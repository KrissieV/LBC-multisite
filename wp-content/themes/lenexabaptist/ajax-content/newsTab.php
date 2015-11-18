<?php 
if(isset($_POST['i'])){
   $i=$_POST['i']; }?>
<?php 
	include("../../../../wp-load.php");
	global $wpdb; ?>
	<h1>News</h1>
	<?php $args = array('post_type' => 'post','tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'sticky',
			),
			array(
				'taxonomy' => 'category',
				'terms'    => $i,
			),
			),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) : ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			
			<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		<div class="divider dots one-row"></div>
	<?php $args = array('post_type' => 'post','tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'terms'    => array( $i ),
			),
			array(
				'operator' => 'NOT IN',
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'sticky',
			),
			),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) : ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			
			
			<?php get_template_part( 'content','excerpt'); ?>
			<div class="divider dots one-row"></div>
		<?php endwhile; ?>
		<?php else : ?>
	<p><?php _e( 'Sorry, there are no news updates for this ministry at this time. Check back soon as updates are made regularly.' ); ?></p>
<?php endif; ?>
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