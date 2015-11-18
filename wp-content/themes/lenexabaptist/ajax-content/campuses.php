<?php 
if(isset($_POST['i'])){
   $i=$_POST['i']; }?>
<?php 
	include("../../../../wp-load.php");
	global $wpdb;
	switch_to_blog($i); ?>
	<div class="section">
	
	<?php
		if ( wp_is_mobile() ) {
	/* Display and echo mobile specific stuff here */
	} else { ?>
	<div class="col span_4_of_12 remove-top-marg">
		<?php $args = array('post_type' => 'staff','tax_query' => array(
			array(
				'taxonomy' => 'position',
				'field'    => 'slug',
				'terms'    => 'campus-pastor',
			),),);
		$loop = new WP_Query( $args ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<img src="<?php the_field('pastor_image','options'); ?>" />
			<h4>Pastor <?php the_title(); ?></h4>
			<?php the_excerpt(); ?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div><!-- end .col.span_4_of_12 -->
	<?php } ?>
	
	
	<div class="col span_8_of_12 remove-top-marg">
	<div class="col span_8_of_12 remove-top-marg"><img src="<?php the_field('campus_logo','options'); ?>" /></div>
	<?php if( get_field('start_year','option') ): ?>
				<h1 class="dots"><span>Established <?php the_field('start_year','options'); ?></span></h1>
			<?php endif; ?>
			<?php the_field('campus_description','options'); ?>
			<a href="<?php the_field('website','options'); ?>" class="button" style="background:<?php the_field('main_color','options'); ?>;" target="_blank">Visit our Website</a>
	
	
	</div><!-- end .col.span_8_of_12 -->
	</div>
	
	<?php
		if ( wp_is_mobile() ) { ?>
		<div class="container"><div class="divider dots one-row"></div></div>
	<div class="col span_4_of_12 remove-top-marg">
		<?php $args = array('post_type' => 'staff','tax_query' => array(
			array(
				'taxonomy' => 'position',
				'field'    => 'slug',
				'terms'    => 'campus-pastor',
			),),);
		$loop = new WP_Query( $args ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<img src="<?php the_field('pastor_image','options'); ?>" />
			<h4>Pastor <?php the_title(); ?></h4>
			<?php the_excerpt(); ?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div><!-- end .col.span_4_of_12 -->
	
	<?php } else { ?>
	
	<?php } ?>

	
	<div class="section campus-details" style="border-bottom:4px solid <?php the_field('main_color','options'); ?>">
	<div class="col span_4_of_12 remove-top-marg">
	<h5><img src="/wp-content/themes/lenexabaptist/images/icon_times_charcoal.png" alt="icon_times_charcoal" width="25"  />Service Times</h5>
		<?php // check if the repeater field has rows of data
if( have_rows('service_times','options') ):

 	// loop through the rows of data
    while ( have_rows('service_times','options') ) : the_row();

        // display a sub field value
        echo '<strong>';
        the_sub_field('day');
        echo '</strong>';
        
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

	</div><!-- end .col.span_4_of_12 -->
	<div class="col span_4_of_12 remove-top-marg">
	<h5><img src="/wp-content/themes/lenexabaptist/images/icon_directions_charcoal.png" alt="icon_directions_charcoal" width="25"  />Location</h5>
	<?php if( get_field('address_description','option') ): ?>
				<strong><?php the_field('address_description', 'option'); ?></strong><br/>
			<?php endif; ?>
			<?php the_field('street_address', 'option'); ?><br/>
			<?php the_field('city', 'option'); ?>, <?php the_field('state', 'option'); ?> <?php the_field('zip', 'option'); ?><br/><br/>
			<?php the_field('phone', 'option'); ?>
	</div><!-- end .col.span_4_of_12 -->
	<div class="col span_4_of_12 remove-top-marg">
	<h5><img src="/wp-content/themes/lenexabaptist/images/icon_website_charcoal.png" alt="icon_times_charcoal" width="25"  />Website</h5>
	<a href="<?php the_field('website', 'option'); ?>" target="_blank"><?php the_field('website', 'option'); ?></a><br/>
	<a href="mailto:<?php the_field('main_campus_email', 'option'); ?>"><?php the_field('main_campus_email', 'option'); ?></a>
	</div><!-- end .col.span_4_of_12 -->
	</div><!-- end .section -->
	<?php restore_current_blog();
	die();
	?>