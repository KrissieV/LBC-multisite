<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package lenexabaptist
 */
?>


<div class="section">
<div id="ajax-tabs" class="staff" >
			<div class="col span_12_of_12">
			<div class="tabs-wrapper">
    <ul class="nav">
    <?php 
    	$blog_id = get_current_blog_id();
    	$sites = wp_get_sites();
		for ($i=1;$i<=count($sites);$i++){ 
				switch_to_blog($i) ?>
				<?php if( get_field('campus_website','options') )
{ ?>
<li><a href="#/link<? echo $i; ?>" class="<?php if($i == $blog_id){echo 'current';} ?> link<? echo $i; ?>" onClick=changeTabStaff(<? echo $i; ?>); ><img src="<?php the_field('campus_secondary_logo','options') ?>" width="80" /><br/><span><?php the_field('city','options') ?>, <?php the_field('state','options') ?></span></a></li>
   
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