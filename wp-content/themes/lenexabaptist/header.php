<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lenexabaptist
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<!-- campus color scheme styles inserted -->
<style>
	a {color:<?php the_field('main_color','options'); ?>;}
	a:hover {color: <?php the_field('main_color_highlight','options'); ?>;}
	#menu-utility-menu li a:hover {color: <?php the_field('main_color_highlight','options'); ?>;}
	.main_bkgd {background-color: <?php the_field('main_color','options'); ?> !important;}
	.main_border {border-color: <?php the_field('main_color','options'); ?> !important;}
	.main_color {color: <?php the_field('main_color','options'); ?> !important;}
	.callout-boxes .col:nth-child(1),.callout-boxes-mobile .col:nth-child(1) {background-color: <?php the_field('main_color','options'); ?> !important;}
	.callout-boxes .col:nth-child(2),.callout-boxes-mobile .col:nth-child(2) {background-color: <?php the_field('main_color_highlight','options'); ?> !important;}
	table.eme-calendar-table td.eventful a, table.eme-calendar-table td.eventful-today a {color: <?php the_field('main_color','options'); ?> !important;}
	.email_signup .button {background-color: <?php the_field('main_color','options'); ?> !important;}
	@media screen and (max-width: 640px) {
		#site-navigation li a {border-color: <?php the_field('main_color','options'); ?> !important;}
	}
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'lenexabaptist' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<div class="container">
		<div class="site-branding span_4_of_12">
				<?php if ( get_header_image() ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="338" alt="<?php wp_title( '|', true, 'right' ); ?>">
					</a>
				<?php endif; // End header image check. ?>
			</div>

		
		<nav id="utility-navigation" class="main-navigation" role="navigation">
			
			<?php wp_nav_menu( array( 'theme_location' => 'utility', ) ); ?><div class="search-toggle" id="searchBTN"><a class="toggle-btn" onclick="showSearch()"></a><?php get_search_form(); ?></div>
			<script>
				function showSearch() {
				$('#searchBTN').css('background-image', 'none');
				$('.search-form').animate({
					width: [ "toggle"],
					
					}, 400, function() {
    $('.search-submit').css('background-image', 'url(/wp-content/themes/lenexabaptist/images/icon-search.png)');
    $('.search-field').css('visibility','visible');
    $('.toggle-btn').css('display','none');
    
  });
				}
			</script>

		</nav><!-- #site-navigation -->
		
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle"><?php _e( 'Primary Menu', 'lenexabaptist' ); ?></button>
			<ul>
			<?php wp_nav_menu( array( 'theme_location' => 'primary','items_wrap' => '%3$s','container' => false ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'utility','items_wrap' => '%3$s','container' => false ) ); ?>
			</ul>
		</nav><!-- #site-navigation -->
	</div>
	</header><!-- #masthead -->
	<div class="bar main_bkgd <?php if(!is_page('ministries')){?>shadow<?php }; ?>">
		

	</div>
	<!-- weather alert or callout -->
	
		<?php $args = array('post_type' => 'page','name'=>'alert','post_status'=>'publish');
		$loop = new WP_Query( $args ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div id="alert">
			<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	
		
	

	<div id="content" class="site-content">
