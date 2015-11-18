<?php
/**
 * The template for displaying the Pastoral Intern Program page.
 *
 * This is the template that displays the Pastoral Intern Program page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lenexabaptist
 */

get_header(); ?>
<!-- using page-pastoralinternprogram.php -->

<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="container no-bottom-marg">
	<div class="col span_12_of_12"><h1 class="entry-title"><?php the_title(); ?></h1></div>
</div>
<div class="container">
	<div class="col span_4_of_12 objectives">
		<?php the_field('objectives_list'); ?>
	</div>
	<div class="col span_8_of_12">
		<?php the_content(); ?>
	</div>
</div>
<div id="ajax-tabs" class="intern top-shadow">
	<div class="col span_12_of_12">
		<div class="tabs-wrapper">
			<ul class="nav">
				
				<?php if( have_rows('tabs') ):
				
				    while ( have_rows('tabs') ) : the_row(); ?>
				
				        
				        <li class="tab"><?php the_sub_field('tab_title'); ?></li>
				
				    <?php endwhile; ?>
				
				<?php else :
				
				    // no rows found
				
				endif; ?>
				
			</ul>
		</div>
		<div class="container">
			<?php if( have_rows('tabs') ):
			
			    while ( have_rows('tabs') ) : the_row(); ?>
			
			        <div class="tab-content">
			
			        <?php the_sub_field('tab_content'); ?>
			</div>
			    <?php endwhile; ?>
			
			<?php else :
			
			    // no rows found
			
			endif; ?>
		</div>
	</div>
	</div>
	<div class="divider bar main_bkgd"></div>
	<div class="divider dots"></div>
	<script>
		$(document).ready(function(){
			$('.tab-content:nth-child(1)').toggleClass('active');
			$('.tab:nth-child(1)').toggleClass('active');
			
		
			$('.tab:nth-child(1)').click(function(){
				$('.active').toggleClass('active');
				$('.tab-content:nth-child(1)').toggleClass('active');
				$('.tab:nth-child(1)').toggleClass('active');
			});
			$('.tab:nth-child(2)').click(function(){
				$('.active').toggleClass('active');
				$('.tab-content:nth-child(2)').toggleClass('active');
				$('.tab:nth-child(2)').toggleClass('active');
			});
			$('.tab:nth-child(3)').click(function(){
				$('.active').toggleClass('active');
				$('.tab-content:nth-child(3)').toggleClass('active');
				$('.tab:nth-child(3)').toggleClass('active');
			});
		});
	</script>
	<div class="container">
		<?php if( have_rows('bottom_columns') ):
		
		    while ( have_rows('bottom_columns') ) : the_row(); ?>
		
		        <div class="col span_4_of_12">
		        <?php the_sub_field('column'); ?>
		</div>
		    <?php endwhile; ?>
		
		<?php else :
		
		    // no rows found
		
		endif; ?>
		
			
		
	</div>

<?php endwhile; // end of the loop. ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
