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
	
	<div class="entry-content">
		<?php the_content(); ?>
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
