<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lenexabaptist
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="col span_6_of_12">
			<h1 class="no-space"><?php bloginfo( 'name' ); ?></h1>
			<address>
			<?php if( get_field('address_description','option') ): ?>
				<strong><?php the_field('address_description', 'option'); ?></strong><br/>
			<?php endif; ?>
			<?php the_field('street_address', 'option'); ?><br/>
			<?php the_field('city', 'option'); ?>, <?php the_field('state', 'option'); ?> <?php the_field('zip', 'option'); ?><br/><br/>
			
			<?php if( get_field('address_description_2','option') ): ?>
				<strong><?php the_field('address_description_2', 'option'); ?></strong><br/>
				<?php the_field('street_address_2', 'option'); ?><br/>
				<?php the_field('city_2', 'option'); ?>, <?php the_field('state_2', 'option'); ?> <?php the_field('zip_2', 'option'); ?><br/><br/>
			<?php endif; ?>
			
						<a href="tel:+1-<?php the_field('phone', 'option'); ?>" class="tel"><?php the_field('phone', 'option'); ?></a><br/>
			<a href="mailto:<?php the_field('main_campus_email', 'option'); ?>" class="email"><?php the_field('main_campus_email', 'option'); ?></a>
			</address>
			
			</div>
			<div class="col span_6_of_12 contact-form">
			<!-- include CSS & JS files -->
<!-- CSS file -->
<link rel="stylesheet" type="text/css" href="/wp-content/themes/lenexabaptist/css/QapTcha.jquery.css" media="screen" />
 
<!-- jQuery files -->
<script type="text/javascript" src="/wp-content/themes/lenexabaptist/js/jquery-ui.js"></script>
<script type="text/javascript" src="/wp-content/themes/lenexabaptist/js/jquery.ui.touch.js"></script>
<script type="text/javascript" src="/wp-content/themes/lenexabaptist/js/QapTcha.jquery.js"></script>
	<h1>Contact &amp; Prayer Request Form</h1>
			<?php echo do_shortcode('[sitepoint_contact_form]'); ?>
			
			<?php
			// check if $_SESSION['qaptcha_key'] created with AJAX exists
if(isset($_SESSION['qaptcha_key']) && !empty($_SESSION['qaptcha_key']))
{
  $myVar = $_SESSION['qaptcha_key'];
 
  // check if the random input created exists and is empty
  if(isset($_POST[''.$myVar.'']) && empty($_POST[''.$myVar.'']))
  {
    //mail can be sent
  }
  else
  {
    //mail can not be sent
  }
}
unset($_SESSION['qaptcha_key']);
?>
			
			<script type="text/javascript">
  $(document).ready(function(){
    
    
    // More complex call
    $('.QapTcha').QapTcha({
      autoSubmit : true,
      autoRevert : true,
      PHPfile : '/wp-content/themes/lenexabaptist/Qaptcha.jquery.php'
    });
    $('.Slider').addClass('main_bkgd');
  });
  
</script>
			</div>
		</div>
		<div class="legal">
			<p><a href="https://lbcks.sharepoint.com/SitePages/Home.aspx" target="_blank">Staff Email Login</a><br/>
			&copy; <span class="year"></span> Lenexa Baptist Church.
			<script>
			$(document).ready(function(){
			var currentYear = (new Date).getFullYear();
			$("#colophon .year").text( (new Date).getFullYear() );
			});
			</script>
			<span class="social">
			<?php if (get_field('facebook', 'options')) { ?> <a target="_blank" href="<?php the_field('facebook','options') ?>">Facebook</a><?php } ?>
			<?php if (get_field('twitter', 'options')) { ?> <a target="_blank" href="<?php the_field('twitter','options') ?>">Twitter</a><?php } ?>
			<?php if (get_field('instagram', 'options')) { ?> <a target="_blank" href="<?php the_field('instagram','options') ?>">Instagram</a><?php } ?>
			<?php if (get_field('e-news_sign-up', 'options')) { ?> <a target="_blank" href="<?php the_field('e-news_sign-up','options') ?>">Email</a><?php } ?>
		</span>
		</p>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<!-- flowtype initiallization - controls font-size scaling in the nav  -->
<script>
	$('.date').flowtype();
</script>

<script type="text/javascript">
		$(document).ready(function() {
			$('.gallery-icon a').attr('data-fancybox-group','gallery');
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.gallery-icon a').fancybox({
				maxHeight: '400',
			});

			/*
			 *  Different effects
			 */


		});
	</script>



</body>
</html>
