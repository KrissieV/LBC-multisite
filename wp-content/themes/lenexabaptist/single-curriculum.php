<?php
/**
 * The template for displaying all single posts.
 *
 * @package lenexabaptist
 */

get_header(); ?>
<!-- using single-curriculum.php -->
<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content','curriculum' ); ?>
			
			

			

		<?php endwhile; // end of the loop. ?>
</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>