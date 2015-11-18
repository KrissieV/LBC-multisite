<?php
/**
 * The template for displaying the About page.
 *
 * This is the template that displays the About page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lenexabaptist
 */

get_header(); ?>
<!-- using page-about.php -->

<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>
<div class="bar main_bkgd"></div>
<div class="divider dots"></div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container">
			<?php $my_query = new WP_Query( 'pagename=about/staff' ); ?>
			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<div class="col span_3_of_12 about-box">
				<?php $blog_id = get_current_blog_id(); 
					if($blog_id == 1) { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-staff.png" alt="icon-staff" width="134"  />
					<?php } else { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-staff-gray.png" alt="icon-staff" width="134"  />
					<?php }; ?>
					
					<h2>Staff</h2>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink() ?>" class="button main_bkgd">Meet Our Staff</a>
				</div>
			<?php endwhile; 
				wp_reset_postdata(); ?>
				
			<?php $my_query2 = new WP_Query( 'pagename=campuses' ); ?>
			<?php while ( $my_query2->have_posts() ) : $my_query2->the_post(); ?>
				<div class="col span_3_of_12 about-box">
				<?php  
					if($blog_id == 1) { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-locations.png" alt="icon-locations" width="134" />
					<?php } else { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-locations-gray.png" alt="icon-locations" width="134" />
					<?php }; ?>
					
					<h2>Locations</h2>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink() ?>" class="button main_bkgd">Find A Campus</a>
				</div>
			<?php endwhile; 
				wp_reset_postdata(); ?>
				
			<?php $my_query3 = new WP_Query( 'pagename=about/doctrine' ); ?>
			<?php while ( $my_query3->have_posts() ) : $my_query3->the_post(); ?>
				<div class="col span_3_of_12 about-box">
				<?php  
					if($blog_id == 1) { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-doctrine.png" alt="icon-doctrine" width="134" />
					<?php } else { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-doctrine-gray.png" alt="icon-doctrine" width="134" />
					<?php }; ?>
					
					<h2>Doctrine</h2>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink() ?>" class="button main_bkgd">What We Believe</a>
				</div>
			<?php endwhile; 
				wp_reset_postdata(); ?>
				
			<?php $my_query4 = new WP_Query( 'pagename=about/story' ); ?>
			<?php while ( $my_query4->have_posts() ) : $my_query4->the_post(); ?>
				<div class="col span_3_of_12 about-box">
				<?php  
					if($blog_id == 1) { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-story.png" alt="icon-story" width="134" />
					<?php } else { ?>
						<img src="/wp-content/themes/lenexabaptist/images/icon-story-gray.png" alt="icon-story" width="134" />
					<?php }; ?>
					
					<h2>Story</h2>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink() ?>" class="button main_bkgd">Read Our Story</a>
				</div>
			<?php endwhile; 
				wp_reset_postdata(); ?>
				
		</div><!-- end .container -->
		
		<div class="campus-details inset-shadows">
		<div class="container">
			<div class="col span_4_of_12">
			<h5><img src="/wp-content/themes/lenexabaptist/images/icon_times_white.png" alt="icon_times_white" width="25"  />Service Times</h5>
				<?php // check if the repeater field has rows of data
if( have_rows('service_times','options') ):

 	// loop through the rows of data
    while ( have_rows('service_times','options') ) : the_row();

        // display a sub field value
        echo '<p><strong>';
        the_sub_field('day');
        echo '</strong></p>';
        
        	if( have_rows('service','options') ):

				// loop through the rows of data
				while ( have_rows('service','options') ) : the_row();

					// display a sub field value
					echo '<p><span class="fake_col">';
					the_sub_field('time');
					echo '</span>';
					the_sub_field('description');
					echo '<p>';

				endwhile;

			else :

			// no rows found

			endif;

    endwhile;

else :

    // no rows found

endif;

?>

			</div><!-- end col 1 -->
			<div class="col span_4_of_12">
			<h5><img src="/wp-content/themes/lenexabaptist/images/icon_directions_white.png" alt="icon_directions_white" width="25" />Directions</h5>
			<?php the_field('directions_description','options'); ?>

			</div><!-- end col 2 -->
			<div class="col span_4_of_12">
				<h5><img src="/wp-content/themes/lenexabaptist/images/icon_parking_white.png" alt="icon_parking_white" width="25"  />Parking</h5>
			<?php the_field('parking_instructions','options'); ?>
			</div><!-- end col 3 -->
		</div>
		</div><!-- end .campus-details -->
		<div class="divider dots"></div>
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'about' ); ?>

				

			<?php endwhile; // end of the loop. ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
