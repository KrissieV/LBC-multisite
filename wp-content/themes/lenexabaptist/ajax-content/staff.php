<?php 
if(isset($_POST['i'])){
   $i=$_POST['i']; }?>
<?php 
	include("../../../../wp-load.php");
	global $wpdb;
	switch_to_blog($i); ?>
	
		<?php $args = array('post_type' => 'staff','posts_per_page'=>-1,'order'=>'ASC','orderby'=>'menu_order','tax_query' => array(
			array(
				'taxonomy' => 'position',
				'field'    => 'slug',
				'terms'    => 'pastor',
			),),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) :  ?>
		<h1>Pastoral Staff</h1>
		<div class="section">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="staff-member col span_3_of_12 main_border">
			<img src="<?php the_field('large_image'); ?>"  />
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<p>
			<?php

// check if the repeater field has rows of data
if( have_rows('titles') ):

 	// loop through the rows of data
    while ( have_rows('titles') ) : the_row();

        // display a sub field value ?>
        <strong><?php the_sub_field('title'); ?></strong><br/>

    <?php endwhile;

else :

    // no rows found

endif;

?>
<a href="mailto:<?php the_field('email_address'); ?>">Email <?php the_title(); ?></a><br/>
<?php the_field('phone'); ?>
			</p>
		</div>
		<?php endwhile; ?>
		</div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		
		<?php $args = array('post_type' => 'staff','orderby'=>'menu_order','posts_per_page'=>-1,'order'=>'ASC','tax_query' => array(
			array(
				'taxonomy' => 'position',
				'field'    => 'slug',
				'terms'    => 'support',
			),),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) :  ?>
		<h1>Ministry Staff</h1>
		<div class="section">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="staff-member col span_3_of_12 main_border">
			<img src="<?php the_field('large_image'); ?>"  />
			<h6><?php the_title(); ?></h6>
			<p>
			<?php

// check if the repeater field has rows of data
if( have_rows('titles') ):

 	// loop through the rows of data
    while ( have_rows('titles') ) : the_row();

        // display a sub field value ?>
        <strong><?php the_sub_field('title'); ?></strong><br/>

    <?php endwhile;

else :

    // no rows found

endif;

?>
<a href="mailto:<?php the_field('email_address'); ?>">Email <?php the_title(); ?></a><br/>
<?php the_field('phone'); ?>
			</p>
		</div>
		<?php endwhile; ?>
		</div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		
		<?php $args = array('post_type' => 'staff','orderby'=>'menu_order','posts_per_page'=>-1,'order'=>'ASC','tax_query' => array(
			array(
				'taxonomy' => 'position',
				'field'    => 'slug',
				'terms'    => 'pastoral-interns',
			),),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) :  ?>
		<h1>Pastoral Interns</h1>
		<div class="section">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="staff-member col span_3_of_12 main_border">
			<img src="<?php the_field('large_image'); ?>"  />
			<h6><?php the_title(); ?></h6>
			<p>
			<?php

// check if the repeater field has rows of data
if( have_rows('titles') ):

 	// loop through the rows of data
    while ( have_rows('titles') ) : the_row();

        // display a sub field value ?>
        <strong><?php the_sub_field('title'); ?></strong><br/>

    <?php endwhile;

else :

    // no rows found

endif;

?>
<a href="mailto:<?php the_field('email_address'); ?>">Email <?php the_title(); ?></a><br/>
<?php the_field('phone'); ?>
			</p>
		</div>
		<?php endwhile; ?>
		</div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	
		<?php restore_current_blog();
	die();
	?>