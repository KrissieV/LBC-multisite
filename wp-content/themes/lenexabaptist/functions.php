<?php
/**
 * lenexabaptist functions and definitions
 *
 * @package lenexabaptist
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'lenexabaptist_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lenexabaptist_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lenexabaptist, use a find and replace
	 * to change 'lenexabaptist' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lenexabaptist', get_template_directory() . '/languages' );
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style('css/editor-style.css');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'utility' => __( 'Utility Menu', 'lenexabaptist' ),
		'primary' => __( 'Primary Menu', 'lenexabaptist' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	
}
endif; // lenexabaptist_setup
add_action( 'after_setup_theme', 'lenexabaptist_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lenexabaptist_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'lenexabaptist' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'lenexabaptist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lenexabaptist_scripts() {
	wp_enqueue_style( 'lenexabaptist-style', get_stylesheet_uri() );
	
	$variable = get_field('navy/gray', 'option');
	if($variable == 'Navy') {
	wp_enqueue_style('lbc-navy-style',get_template_directory_uri() . '/css/navy.css');
	} elseif($variable == 'Gray') {
	wp_enqueue_style('lbc-navy-style',get_template_directory_uri() . '/css/gray.css');
	}

	wp_enqueue_script( 'lenexabaptist-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'lenexabaptist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	// Load in jquery for jquery plugins FlowType
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', false);
	wp_enqueue_script('jquery');
	
	// Fancybox2
	wp_enqueue_script( 'lbc-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array('jquery') );
	wp_enqueue_style( 'lbc-fancybox-style', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	
	// Load in jquery for ajax-tabs
	wp_enqueue_script( 'lbc-ajaxtabs', get_template_directory_uri() . '/js/ajax-tabs.js', array('jquery') );
	
	// FlowType - controls font-size scaling in the nav
	wp_enqueue_script( 'lbc-flowtype', get_template_directory_uri() . '/js/flowtype.js', array('jquery') );
	
	// Typekit
	wp_enqueue_script( 'lbc-typekit', '//use.typekit.net/syr3nlo.js', array('jquery') );
	wp_enqueue_script( 'typekit', get_template_directory_uri() . '/js/typekit.js', array('jquery','lbc-typekit') );
	
	// SS Social Font
	wp_enqueue_script( 'ss-social', get_template_directory_uri() . '/js/ss-social.js', array(),'1.0.0',true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lenexabaptist_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Add Options Pages.
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'position'      => 61.1,
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Campus Details',
		'menu_title'	=> 'Campus Details',
		'parent_slug'	=> 'theme-options',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-options',
	));
	
} 



/**
 * Create Top Level Pages and remove default 'Hello World' and 'Sample Page'.
 */
 
if (isset($_GET['activated']) && is_admin()){
        $new_page_title = 'Home';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
       
        $homeSet = get_page_by_title( 'Home' );
        update_option( 'page_on_front', $homeSet->ID );
        update_option( 'show_on_front', 'page' );
        
        $new_page_title = 'About';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Ministries';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Ministries';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }

        
        $new_page_title = 'Campuses';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Staff';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_parent' => 6,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Doctrine';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_parent' => 6,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Story';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_parent' => 6,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Services';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_parent' => 6,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Watch Sermons';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'All Church Events';
        $new_page_content = 'This is the page content';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
        
        $new_page_title = 'Alert';
        $new_page_content = 'This is a weather announcement or callout on the homepage';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'draft',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }

       
        
        wp_delete_post(1);
        wp_delete_post(2);
        
 
}

/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
 
function tuts_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
 
/**
 * Add styles/classes to the "Styles" drop-down
 */
// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'button',  
			'inline' => 'span',  
			'classes' => 'button main_bkgd',
		),
		array(  
			'title' => 'small',  
			'inline' => 'span',  
			'classes' => 'small',
		),  
		array(  
			'title' => 'verse',  
			'block' => 'blockquote',  
		),
		array(  
			'title' => 'callout',  
			'block' => 'blockquote', 
			'classes' => 'callout main_border', 
		),
		
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

/**
 * Create Read More with Exceprts
 */
add_action('init', 'my_custom_init');
function my_custom_init() {
	add_post_type_support( 'page', 'excerpt' );
}

 
/**
 * Create Read More with Exceprts
 */
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/**
 * Create HTML list of pages.
 *
 * @package Razorback
 * @subpackage Walker
 * @author Michael Fields <michael@mfields.org>
 * @copyright Copyright (c) 2010, Michael Fields
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @uses Walker_Page
 *
 * @since 2010-05-28
 * @alter 2010-10-09
 */
class Razorback_Walker_Page_Selective_Children extends Walker_Page {
    /**
     * Walk the Page Tree.
     *
     * @global stdClass WordPress post object.
     * @uses Walker_Page::$db_fields
     * @uses Walker_Page::display_element()
     *
     * @since 2010-05-28
     * @alter 2010-10-09
     */
    function walk( $elements, $max_depth ) {
        global $post;
        $args = array_slice( func_get_args(), 2 );
        $output = '';
 
        /* invalid parameter */
        if ( $max_depth < -1 ) {
            return $output;
        }
 
        /* Nothing to walk */
        if ( empty( $elements ) ) {
            return $output;
        }
 
        /* Set up variables. */
        $top_level_elements = array();
        $children_elements  = array();
        $parent_field = $this->db_fields['parent'];
        $child_of = ( isset( $args[0]['child_of'] ) ) ? (int) $args[0]['child_of'] : 0;
 
        /* Loop elements */
        foreach ( (array) $elements as $e ) {
            $parent_id = $e->$parent_field;
            if ( isset( $parent_id ) ) {
                /* Top level pages. */
                if( $child_of === $parent_id ) {
                    $top_level_elements[] = $e;
                }
                /* Only display children of the current hierarchy. */
                else if (
                    ( isset( $post->ID ) && $parent_id == $post->ID ) ||
                    ( isset( $post->post_parent ) && $parent_id == $post->post_parent ) ||
                    ( isset( $post->ancestors ) && in_array( $parent_id, (array) $post->ancestors ) )
                ) {
                    $children_elements[ $e->$parent_field ][] = $e;
                }
            }
        }
 
        /* Define output. */
        foreach ( $top_level_elements as $e ) {
            $this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
        }
        return $output;
    }
} 
function exclude_category( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '-33' );
    }
}
add_action( 'pre_get_posts', 'exclude_category' );

function change_posts_per_curriculum_archive_page() {
	if ( is_post_type_archive('curriculum') )
		set_query_var('posts_per_page', -1); // or use variable key: posts_per_page
}
add_filter('pre_get_posts', 'change_posts_per_curriculum_archive_page');


?>