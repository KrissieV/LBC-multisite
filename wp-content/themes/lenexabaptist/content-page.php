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
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
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
	<?php 

$posts = get_field('staff');

if( $posts ): ?>
<div class="sidebar-item main_border">
<h6>Staff</h6>
	
	<?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
	    
	    	<h5><a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a></h5>
	    	<p>
	    	<?php // check if the repeater field has rows of data
				if( have_rows('titles',$p->ID) ): ?>

				<?php // loop through the rows of data
				while ( have_rows('titles',$p->ID) ) : the_row();

        // display a sub field value ?>
        <?php the_sub_field('title',$p->ID); ?><br/>

    <?php endwhile;

else :

    // no rows found

endif; ?>
	    	<span><?php the_field('phone', $p->ID); ?></span><br/>
	    	<span><a href="mailto:<?php the_field('email_address', $p->ID); ?>"><?php the_field('email_address', $p->ID); ?></a></span><br/></p>
	    
	<?php endforeach; ?>
	
</div>
<?php endif; ?>

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
