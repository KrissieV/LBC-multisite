<?php
/**
 * The template for displaying the Ministries page.
 *
 * This is the template that displays the Ministries page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lenexabaptist
 */
?>
<!-- using page-ministries-sub.php -->

<?php if ( '' != get_the_post_thumbnail() ) {
    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="feature-img" style="background-image:url(<?php echo $url; ?>);"></div>
<?php } else { ?>
	
<?php }; ?>
<div id="ajax-tabs" class="ministries" >
			<div class="col span_12_of_12">
			<div class="tabs-wrapper">
    <ul class="nav">
		<li><a href="#/overview" class="overview current page<?php echo $post->ID; ?>" onClick=changeTabPage(<?php echo $post->ID; ?>)><?php the_title(); ?></a></li>
		
		<?php 
		$post_id = $post->ID; 
		$event_cat = get_field('event_category_id'); 
		
		$categories = get_the_category();

		if($categories){
			foreach($categories as $category) {
				$cat_id = $category->term_id;
				}
			} ?>
		
		<li><a href="#/events" class="events" onClick=changeTabEvents(<?php echo $event_cat; ?>)>Events</a></li>
		<li><a href="#/volunteer" class="volunteer" onClick=changeTabVolunteer(<?php echo $cat_id; ?>)>Volunteer</a></li>
		<li><a href="#/news" class="news"  onClick=changeTabNews(<?php echo $cat_id; ?>)>News/Updates</a></li>
    <div class="clear"></div>
    </ul></div>
			</div>
			
			<div class="container">
			<div class="col span_8_of_12 relative">
			<?php $args = array('post_type' => 'page', 'post_parent' => $post_id,'order' => 'ASC');
		$loop = new WP_Query( $args ); ?>
		<?php if ($loop->have_posts()) : ?>
		<ul class="pill-nav">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<li><a href="#/page<?php echo $post->ID; ?>" class="main_border page<?php echo $post->ID; ?>" onClick=changePillPage(<?php echo $post->ID; ?>)><?php the_title(); ?></a></li>
		<?php endwhile; ?>
		</ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
    <div class="list-wrap">
    <div id="tab-content">
    <?php while ( have_posts() ) : the_post(); ?>
    

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

    
 
	    </div> <!-- END List Wrap -->
</div>

</div>
</div><!-- END Ajax Tabs -->

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


			<?php endwhile; // end of the loop. ?>
			</div>
<script>
$( document ).ready(function() {
     if (location.hash == "#/events") {
	     changeTabEvents(<?php echo $event_cat; ?>);
     } else if (location.hash == "#/volunteer") {
	     changeTabVolunteer(<?php echo $cat_id; ?>);
     } else if (location.hash == "#/news") {
	     changeTabNews(<?php echo $cat_id; ?>);
     } else if (location.hash == "#/overview") {
	     //do nothing
     } else if (location.hash) {
	     i = location.hash.replace("#/page","");
	     changeTabPage(i);
     }
});
</script>
<?php get_sidebar(); ?>
