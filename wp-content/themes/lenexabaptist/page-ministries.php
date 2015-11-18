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
<!-- using page-ministries.php -->

<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>

<?php if( have_rows('ministry_category') ): ?>

				<?php // loop through the rows of data
				while ( have_rows('ministry_category') ) : the_row();

					// display a sub field value
					echo '<div class="min-cat inset-shadow-top"><div class="min-img inset-shadow-side"><img src="';
					the_sub_field('image');
					echo '" /></div><div class="min-descript">';
					echo '<h5 class="dots dark"><span>';
					the_sub_field('title');
					echo '<span></h5>';
					the_sub_field('description');
					

/*
*  Loop through post objects (assuming this is a multi-select field) ( setup postdata )
*  Using this method, you can use all the normal WP functions as the $post object is temporarily initialized within the loop
*  Read more: http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset
*/
$post_objects = get_sub_field('pages');

if( $post_objects ): ?>
    <ul class="main_border">
    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;

					echo '</div><div class="clear"></div></div>';

				endwhile; ?>

			<?php else :

			// no rows found

			endif; ?>
		

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php $blog_id = get_current_blog_id();
		if($blog_id == 1){ ?>
		<div class="min-partner-wrapper inset-shadows main_border">
				<div class="container">
					<article class="page">
				<h1>Ministry Partners</h1>
				<ul class="min-partner">
				<?php if( have_rows('ministry_partner_links') ): ?>

				<?php // loop through the rows of data
				while ( have_rows('ministry_partner_links') ) : the_row();

					// display a sub field value
					echo '<li><a href="';
					the_sub_field('ministry_partner_link');
					echo '" target="_blank">';
					the_sub_field('ministry_partner_name');
					echo '</a></li>';

				endwhile; ?>

			<?php else :

			// no rows found

			endif; ?>
			<div class="clear"></div>
				</ul>
					</article>
			<?php while ( have_posts() ) : the_post(); ?>

				

				

			<?php endwhile; // end of the loop. ?>
		</div>
		</div>
		<?php } ?>
		<div class="divider bar main_bkgd"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
