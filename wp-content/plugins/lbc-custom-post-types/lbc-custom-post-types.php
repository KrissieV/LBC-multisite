<?php
/*
Plugin Name: LBC Custom Post Types
Plugin URI: http://www.honeystreet.com
Description: Custom Post Types for the LBC website and Campus Sites
Version: 1.0
Author: Krissie VandeNoord, Honeystreet Design Studio
Author URI: http://www.honeystreet.com/

This plugin is released under the GPLv2 license. The images packaged with this plugin are the property of
their respective owners, and do not, necessarily, inherit the GPLv2 license.
*/

/**
 * Create Volunteer Post Type
 */
function lbc_volunteer_init() {
    $args = array(
      'public' => true,
      'label'  => 'Volunteers',
      'supports' => array( 'title', 'editor', 'excerpt' ),
      'menu_icon' => 'dashicons-groups',
      'taxonomies' => array('category'),
      'has_archive' => true,
      'publicly_queryable' => true,
      'hierarchical' => true,
    );
    register_post_type( 'volunteer', $args );
}
add_action( 'init', 'lbc_volunteer_init' );

/**
 * Create Staff Post Type and Register Position Taxonomy as well as add standard terms: Campus Pastor, Pastor, Support
 */
function lbc_staff_init() {
    $args = array(
      'public' => true,
      'label'  => 'Staff',
      'supports' => array( 'title', 'editor', 'excerpt' ),
      'menu_icon' => 'dashicons-businessman',
      'taxonomies' => array('category', 'position'),
      'has_archive' => true,
      'publicly_queryable' => true,
      'hierarchical' => true,
    );
    register_post_type( 'staff', $args );
}
add_action( 'init', 'lbc_staff_init' );

function create_staffposition_tax() {
	register_taxonomy(
		'position',
		'staff',
		array(
			'label' => __( 'Position' ),
			'rewrite' => array( 'slug' => 'position' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy_for_object_type( 'position', 'staff' );
}

add_action( 'init', 'create_staffposition_tax', 8 );

function example_insert_category() {
	wp_insert_term(
		'Campus Pastor',
		'position',
		array(
		  'description'	=> 'This is for the main pastor only, and will be used to display pastoral information for the campus on other sites',
		  'slug' 		=> 'campus-pastor'
		)
	);
	wp_insert_term(
		'Pastor',
		'position',
		array(
		  'description'	=> 'This is for all pastoral staff',
		  'slug' 		=> 'pastor'
		)
	);
	wp_insert_term(
		'Support',
		'position',
		array(
		  'description'	=> 'This is for all non-pastoral staff',
		  'slug' 		=> 'support'
		)
	);
}
add_action( 'init', 'example_insert_category', 10 );

/**
 * Create Curriculum Post Type
 */
function lbc_curriculum_init() {
    $args = array(
      'public' => true,
      'label'  => 'Curriculum',
      'supports' => array( 'title', 'editor' ),
      'menu_icon' => 'dashicons-welcome-learn-more',
      'has_archive' => true,
      'publicly_queryable' => true,
    );
    register_post_type( 'curriculum', $args );
}
add_action( 'init', 'lbc_curriculum_init' );

/**
 * Create Job Post Type
 */
function lbc_jobs_init() {
    $args = array(
      'public' => true,
      'label'  => 'Jobs',
      'supports' => array( 'title', 'editor' ),
      'menu_icon' => 'dashicons-hammer',
      'has_archive' => true,
      'publicly_queryable' => true,
    );
    register_post_type( 'jobs', $args );
}
add_action( 'init', 'lbc_jobs_init' );