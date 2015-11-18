<?php
/**
 * The template for displaying the home page.
 *
 * This is the template that displays the home page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lenexabaptist
 */

get_header(); ?>
<!--using front-page.php -->
	
		<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img inset-shadow-top" style="background-image:url(<?php echo $url; ?>);">
			<?php if ( get_field('mission_statement') ) { ?>
			<div class="mission-statement">
			<?php the_field('mission_statement'); ?> 
			</div>
			<?php }; ?>
			<?php $value = get_field('add_callout_box');
		if ($value == '2 Callout Boxes') { ?>
				<?php // check if the repeater field has rows of data
					if( have_rows('callout_box') ): ?>
						<div class="callout-boxes">
							<div class="container">
								<?php 	// loop through the rows of data
								while ( have_rows('callout_box') ) : the_row();

							        // display a sub field value
							        echo '<div class="col span_5_of_12 remove-bot-marg cbox"><h6>';
							        the_sub_field('title');
							        echo '</h6><p><img src="';
							        the_sub_field('icon');
							        echo '" width=60 />';
							        the_sub_field('text');
							        if (get_sub_field('button_link')) {
							        echo '<a href="';
							        the_sub_field('button_link');
							        echo '">';
							        the_sub_field('button_text');
							        echo '</a>';
							        };
							        echo '</p></div>';
								
								endwhile; ?>
								<div class="clear"></div>
    						</div>
						</div>
						<script>
							$( document ).ready(function() {
							var left=$(".cbox:nth-child(1)").height()+30;
							var right=$(".cbox:nth-child(2)").height()+30;
							
							if(left>right)
							{
								$('.cbox:nth-child(2)').css({ height: left});
							}
								else
							{
							    $('.cbox:nth-child(1)').css({ height: right});
							}
							});
						</script>

					<?php else :

						// no rows found

					endif; ?>
			<?php } else if ($value == '1 Callout Box') { ?>
				<?php // check if the repeater field has rows of data
					if( have_rows('callout_box_1') ): ?>
						<div class="callout-boxes">
							<div class="container">
								<?php 	// loop through the rows of data
								while ( have_rows('callout_box_1') ) : the_row();

							        // display a sub field value
							        echo '<div class="col span_5_of_12 remove-bot-marg"><h6>';
							        the_sub_field('title');
							        echo '</h6><p><img src="';
							        the_sub_field('icon');
							        echo '" width=60 />';
							        the_sub_field('text');
							        if (get_sub_field('button_link')) {
							        echo '<a href="';
							        the_sub_field('button_link');
							        echo '">';
							        the_sub_field('button_text');
							        echo '</a>';
							        };
							        echo '</p></div>';
								
								endwhile; ?>
    						</div>
						</div>

					<?php else :

						// no rows found

					endif; ?>
			<?php } else if ($value == 'No Callout Boxes') {
				// do nothing
			}; ?>

				
				
			
		</div>
<?php } else { ?>
	
<?php }; ?>
<div class="bar main_bkgd"></div>
		<?php if ($value == '2 Callout Boxes') { ?>
				<?php // check if the repeater field has rows of data
					if( have_rows('callout_box') ): ?>
						<div class="callout-boxes-mobile">
							<div class="container">
								<?php 	// loop through the rows of data
								while ( have_rows('callout_box') ) : the_row();

							        // display a sub field value
							        echo '<div class="col span_5_of_12 remove-bot-marg"><h6>';
							        the_sub_field('title');
							        echo '</h6><p><img src="';
							        the_sub_field('icon');
							        echo '" width=60 />';
							        the_sub_field('text');
							        if (get_sub_field('button_link')) {
							        echo '<a href="';
							        the_sub_field('button_link');
							        echo '">';
							        the_sub_field('button_text');
							        echo '</a>';
							        };
							        echo '</p></div>';
								
								endwhile; ?>
    						</div>
						</div>

					<?php else :

						// no rows found

					endif; ?>
			<?php } else if ($value == '1 Callout Box') { ?>
				<?php // check if the repeater field has rows of data
					if( have_rows('callout_box_1') ): ?>
						<div class="callout-boxes-mobile">
							<div class="container">
								<?php 	// loop through the rows of data
								while ( have_rows('callout_box_1') ) : the_row();

							        // display a sub field value
							        echo '<div class="col span_10_of_12 remove-bot-marg"><h6>';
							        the_sub_field('title');
							        echo '</h6><p><img src="';
							        the_sub_field('icon');
							        echo '" width=60 />';
							        the_sub_field('text');
							        if (get_sub_field('button_link')) {
							        echo '<a href="';
							        the_sub_field('button_link');
							        echo '">';
							        the_sub_field('button_text');
							        echo '</a>';
							        };
							        echo '</p></div>';
								
								endwhile; ?>
    						</div>
						</div>

					<?php else :

						// no rows found

					endif; ?>
			<?php } else if ($value == 'No Callout Boxes') {
				// do nothing
			}; ?>			

				


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container">
		<div class="section">
<div class="col span_6_of_12">
	<?php eme_get_events_list("limit=1&category=1&long_events=1&template_id=1"); ?>
	
	
		
		<div class="service-times">
<h1 class="block sec_bkgd">Service Times / <a href="/about/services/">details</a></h1>

<?php // check if the repeater field has rows of data
if( have_rows('service_times','options') ):

 	// loop through the rows of data
    while ( have_rows('service_times','options') ) : the_row();

        // display a sub field value
        echo '<h4>';
        the_sub_field('day');
        echo '</h4>';
        
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
		</div><!-- end .service-times -->
		<div class="buttons">
		
		<?php

$rows = get_field('link' ); // get all the rows
$first_row = $rows[0]; // get the first row
$first_row_text = $first_row['text' ]; // get the sub field value
$first_row_page = $first_row['page' ]; // get the sub field value
$second_row = $rows[1]; // get the first row
$second_row_text = $second_row['text' ]; // get the sub field value
$second_row_page = $second_row['page' ]; // get the sub field value ?>
<?php if (!empty($first_row_text)) { ?>
<a class="button styleA" href="<?php echo $first_row_page; ?>"><?php echo $first_row_text; ?></a>
<?php } ?>
<?php if (!empty($second_row_text)) { ?>
<a class="button styleB main_bkgd" href="<?php echo $second_row_page; ?>"><?php echo $second_row_text; ?></a>
<?php } ?>

		
</div><!-- end .buttons -->
<div class="divider dots"></div>

<?php if ( get_field('form') ) { ?>
<h1 class="block sec_bkgd"><span>E-Newsletter Sign-up</span></h1>
<?php 
    $form_object = get_field('form');
    echo do_shortcode('[gravityform id="' . $form_object['id'] . '" title="false" description="false" ajax="true"]');
?>
<?php }; ?>
</div><!-- end .col.span_6_of_12 -->
<div class="col span_6_of_12">
	<h1 class="dots"><span>Upcoming Events / <a href="/all-church-events/">view all</a></span></h1>
	<?php eme_get_events_list("limit=4&category=2&long_events=1&template_id=2"); ?>
	<a class="button styleA alignright" href="/all-church-events/">View Full Calendar</a>
	<div class="divider dots"></div>
</div>

		</div>
		
		</div>
		<div class="bar main_bkgd"></div>
			<?php while ( have_posts() ) : the_post(); ?>

				

				

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>