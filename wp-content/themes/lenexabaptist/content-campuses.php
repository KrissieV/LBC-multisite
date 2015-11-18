<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package lenexabaptist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="wrapper-gray">
<div class="divider dots top-marg"></div>
	<div class="container">
	
	<div class="section">
	<div class="col span_12_of_12 ">
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
	
	</div>
	
	</div>
</div>
</article><!-- #post-## -->
<div class="section">
<div id="ajax-tabs" class="campuses" >
			<div class="col span_12_of_12">
			<div class="tabs-wrapper">
    <ul class="nav">
    
   
    <?php 
    	$blog_id = get_current_blog_id();
    	$sites = wp_get_sites();
		for ($i=2;$i<=count($sites);$i++){ 
				switch_to_blog($i) ?>
				<?php if( get_field('campus_website','options') )
{ ?>
<li><a href="#/link<? echo $i; ?>" class="<?php if($i == $blog_id || $blog_id == 1 && $i == 2){echo 'current top-shadow';} ?> link<? echo $i; ?>" onClick=changeTabCampus(<? echo $i; ?>); ><img src="<?php the_field('campus_secondary_logo','options') ?>" width="80" /><br/><span><?php the_field('city','options') ?>, <?php the_field('state','options') ?></span></a></li>
   
<?php } else { ?>
    
<?php } ?>
				
				
				<?php restore_current_blog(); ?>
		<?php } ?><div class="clear"></div>
    </ul></div>
			</div>
			<div class="container">
			<div class="col span_12_of_12">
    <div class="list-wrap">
    <div id="tab-content"></div>
	    </div> <!-- END List Wrap -->
</div>
<!-- END Ajax Tabs -->
			
</div>
</div>
</div>