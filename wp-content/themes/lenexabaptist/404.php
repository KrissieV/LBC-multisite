<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package lenexabaptist
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<div class="container">
<div class="section">
<div class="col span_8_of_12">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'lenexabaptist' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links to the right or use the search function in the upper right.', 'lenexabaptist' ); ?></p>

					

					

					

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
</div>
<div class="col span_4_of_12">
	<div class="sidebar-item">
	<ul class="site-map">
		<?php wp_list_pages('title_li='); ?>
	</ul>
	</div>
</div>
</div>
</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
