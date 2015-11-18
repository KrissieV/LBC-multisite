<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package lenexabaptist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="section">
	<div class="col span_8_of_12">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title dots"><span>', '</span></h1>' ); ?>
		<?php

// check if the repeater field has rows of data
if( have_rows('titles') ):

 	// loop through the rows of data
    while ( have_rows('titles') ) : the_row();

        // display a sub field value ?><h3><?php the_sub_field('title'); ?></h3><?php endwhile;

else :

    // no rows found

endif;

?>

	</header><!-- .entry-header -->
	
	<div class="entry-content">
		<img src="<?php the_field('large_image'); ?>" class="alignleft"  /><?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lenexabaptist' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'lenexabaptist' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	</div>
	
	<div class="col span_4_of_12">
	<div class="sidebar-item main_border">
		<h6>Pastoral Staff</h6>
		<?php $args = array('post_type' => 'staff','posts_per_page'=>-1,'order'=>'ASC','tax_query' => array(
			array(
				'taxonomy' => 'position',
				'field'    => 'slug',
				'terms'    => 'pastor',
			),),);
		$loop = new WP_Query( $args ); ?>
		<?php if ( $loop->have_posts() ) :  ?>
		
		
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
			<p class="staff-list"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php

// check if the repeater field has rows of data
if( have_rows('titles') ):

 	// loop through the rows of data
    while ( have_rows('titles') ) : the_row();

        // display a sub field value ?>, <?php the_sub_field('title'); ?><?php endwhile;

else :

    // no rows found

endif;

?>

			
			</p>
			
		
		<?php endwhile; ?>
		<p class="staff-list">&nbsp;</p>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		<p><a href="/about/staff/" class="button main_bkgd">Back to Staff</a></p>
	</div>
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
</article><!-- #post-## -->
