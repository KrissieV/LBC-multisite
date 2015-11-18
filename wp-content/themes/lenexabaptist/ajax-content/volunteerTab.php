<?php 
if(isset($_POST['i'])){
   $i=$_POST['i']; }?>
<?php 
	include("../../../../wp-load.php");
	global $wpdb; ?>
	<h1>Volunteer Opportunities</h1>
	<?php $args = array('post_type' => 'volunteer','tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'sticky',
			),
			array(
				'taxonomy' => 'category',
				'terms'    => $i,
			),
			),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) : ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			
			<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		<div class="divider dots one-row"></div>
	<?php $args = array('post_type' => 'volunteer','tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'terms'    => array( $i ),
			),
			array(
				'operator' => 'NOT IN',
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'sticky',
			),
			),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) : ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			<h4 class="tab"><?php the_title(); ?></h4>
			<?php the_excerpt(); ?>
			<p>Contact <strong><a href="mailto:<?php the_field('contact_email'); ?>"><?php the_field('contact_name'); ?></a></strong> for more info.</p>
			<div class="divider dots one-row"></div>
		<?php endwhile; ?>
		<?php else : ?>
	<p><?php _e( 'Sorry, there are no volunteer opportunities for this ministry listed at this time. Check back soon as updates are made regularly.' ); ?></p>
<?php endif; ?>
		<?php wp_reset_query(); ?>


	
<?php die(); ?>