<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lenexabaptist
 */

get_header(); ?>
<!-- using page-campuses.php -->

<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'campuses' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php if($blog_id == 1 || $blog_id == 2){ ?>
<script>
$( document ).ready(function() {
    loadTabCampus(2);
});
</script>
<?php } else { ?>
<script>
$( document ).ready(function() {
    loadTabCampus(<?php echo $blog_id; ?>);
});
</script>
<?php } ?>


<?php get_footer(); ?>
