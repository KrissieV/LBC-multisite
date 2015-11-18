<?php
/**
 * The template for displaying all single posts.
 *
 * @package lenexabaptist
 */

get_header(); ?>
<!-- using archive-curriculum.php -->
<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
<div class="section">
<div class="col span_12_of_12">
	<h1>Sunday School Curriculum Ordering Options</h1>
	<ul id="curriculum-list">
		<li>
			<span><strong>Title</strong></span>
			<span><strong>Series</strong></span>
			<span><strong>Publisher</strong></span>
		</li>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'curriculum-list' );
				?>

			<?php endwhile; ?>

			<?php lenexabaptist_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
	</ul>
</div></div></div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>