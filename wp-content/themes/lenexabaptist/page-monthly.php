<?php
/**
 * The template for displaying the Ministries page.
 *
 * This is the template that displays the Ministries page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lenexabaptist
 */

get_header(); ?>
<!-- using page-monthly.php -->

<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>

<?php if ( EME_IS_SINGLE_EVENT_PAGE()) { 
    eme_event();
} else { ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container">
		<div class="section">
		<div class="col span_12_of_12 remove-bot-marg">
		<h1><?php the_title(); ?></h1>
		</div>
		</div>
		<div class="section">
		<div class="col span_12_of_12 remove-top-marg calendar">
			<ul class="pill-nav"><li><a href="/calendar" class="main_border">Weekly View</a></li></ul>
		<?php eme_get_calendar("full=1"); ?>
		</div>
		

		</div>
		</div>
				<div class="divider bar main_bkgd"></div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php } ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
