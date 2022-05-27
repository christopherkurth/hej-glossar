<?php
/**
 * Register Hej Glossar Custom Post Type.
 *
 * @package     hej_glossar
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Register Custom Post Type.
**/
function hej_glossar() {

	$hej_glossar_slug = get_option( 'hej_glossar_slug', 'hej_glossar' );

	$labels = array(
		'name'					=> esc_html_x( 'Glossar', 'Post Type General Name', 'hej-glossar' ),
		'singular_name'			=> esc_html_x( 'Term', 'Post Type Singular Name', 'hej-glossar' ),
		'menu_name'				=> esc_html__( 'Glossar', 'hej-glossar' ),
		'all_items'				=> esc_html__( 'All Terms', 'hej-glossar' ),
		'view_item'				=> esc_html__( 'View Term', 'hej-glossar' ),
		'add_new_item'			=> esc_html__( 'Add New Term', 'hej-glossar' ),
		'add_new'				=> esc_html__( 'Add New', 'hej-glossar' ),
    	'edit'					=> esc_html__( 'Edit', 'hej-glossar' ),
		'edit_item'				=> esc_html__( 'Edit Term', 'hej-glossar' ),
    	'new_item'				=> esc_html__( 'New Term', 'hej-glossar' ),
    	'view'					=> esc_html__( 'View Term', 'hej-glossar' ),
    	'view_item'				=> esc_html__( 'View Term', 'hej-glossar' ),
		'search_items'			=> esc_html__( 'Search Term', 'hej-glossar' ),
		'not_found'				=> esc_html__( 'Not Term found', 'hej-glossar' ),
		'not_found_in_trash'	=> esc_html__( 'No Term found in Trash', 'hej-glossar' ),
	);

	$args = array(
		'label'					=> esc_html__( 'hej-glossar', 'hej-glossar' ),
		'menu_icon'				=> 'dashicons-text-page',
		'labels'				=> $labels,
		'supports'				=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
		'taxonomies'			=> array( 'section' ),
		'hierarchical'			=> false,
    	'query_var' 			=> true,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'menu_position'			=> 27,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> false,
		'capability_type'		=> 'page',
		'rewrite'				=> array( 'slug' => $hej_glossar_slug ? get_post($hej_glossar_slug)->post_name : 'glossar', 'with_front' => false ),
	);

	register_post_type( 'hej_glossar', $args );
}
add_action( 'init', 'hej_glossar', 0 );