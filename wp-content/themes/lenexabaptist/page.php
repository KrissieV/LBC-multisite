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
<!-- using page.php -->


<?php $parent = array_reverse(get_post_ancestors($post->ID));
$first_parent = get_page($parent[0]);
$ancestor = $first_parent->post_name;
?>
<?php if( $ancestor == 'ministries' ) { ?>
    <?php get_template_part( 'page','ministries-sub' ); ?>
<?php } else { ?>
<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php } ?>
<?php get_footer(); ?>
