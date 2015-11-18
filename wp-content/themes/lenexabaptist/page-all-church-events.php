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
<!-- using page-all-church-events.php -->

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
		<div class="col span_8_of_12 remove-top-marg calendar">
			<ul class="pill-nav"><li><a href="/all-church-events/monthly/" class="main_border">Monthly View</a></li></ul>
		<?php eme_get_events_list("paging=1&limit=0&template_id=2&scope=this_week&show_recurrent_events_once=1"); ?>
		</div>
		<div class="col span_4_of_12 remove-top-marg">
		<?php if( have_rows('sidebar_item') ):

				// loop through the rows of data
				while ( have_rows('sidebar_item') ) : the_row();

					// display a sub field value
					echo '<div class="sidebar-item main_border"><h6>';
					the_sub_field('heading');
					echo '</h6>';
					the_sub_field('text');
					echo '<div class="clear"></div></div>';

				endwhile;

			else :

			// no rows found

			endif; ?>

	</div>

		</div>
		</div>
				<div class="divider bar main_bkgd"></div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php } ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
