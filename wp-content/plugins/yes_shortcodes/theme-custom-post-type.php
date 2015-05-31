<?php 

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'logica_flush_rewrite_rules' );

// Flush your rewrite rules
function logica_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function register_custom_post_tax_type() {
	
	//register teams post type
	register_post_type('events', 
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Events', 'js_composer' ), /* This is the Title of the Group */
			'singular_name' => __( 'Events', 'js_composer' ), /* This is the individual type */
			'all_items' => __( 'All Events', 'js_composer' ), /* the all items menu item */
			'add_new' => __( 'Add New Event', 'js_composer' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Event', 'js_composer' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'js_composer' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Event', 'js_composer' ), /* Edit Display Title */
			'new_item' => __( 'New Event', 'js_composer' ), /* New Display Title */
			'view_item' => __( 'View Event', 'js_composer' ), /* View Display Title */
			'search_items' => __( 'Search Event', 'js_composer' ) /* Search Custom Type Title */ 
			), /* end of arrays */
			'description' => __( 'Your Events', 'js_composer' ),
			'public' => true,
			'menu_icon' => 'dashicons-admin-site',
			'show_ui' => true,
			'supports' => array('title','thumbnail','editor'),
	));

	//register important people post type
	register_post_type('important-people', 
		array( 'labels' => array(
			'name' => __( 'Important People', 'js_composer' ), /* This is the Title of the Group */
			'singular_name' => __( 'Important People', 'js_composer' ), /* This is the individual type */
			'all_items' => __( 'All Persons', 'js_composer' ), /* the all items menu item */
			'add_new' => __( 'Add New Person', 'js_composer' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Person', 'js_composer' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'js_composer' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Person', 'js_composer' ), /* Edit Display Title */
			'new_item' => __( 'New Person', 'js_composer' ), /* New Display Title */
			'view_item' => __( 'View Person', 'js_composer' ), /* View Display Title */
			'search_items' => __( 'Search Persons', 'js_composer' ) /* Search Custom Type Title */ 
			), /* end of arrays */
			'description' => 'Add Important People',
			'public' => true,
			'menu_icon' => 'dashicons-groups',
			'taxonomies' => array('people-category'),
			'supports' => array( 'title','editor','thumbnail' ),
	));

	//register categories for portfolio post type
	register_taxonomy('people-category', 
		'important-people', 
		array(  'hierarchical' => true,
				'labels' => array(
						'name' => __( 'People Categories', 'js_composer' ), /* name of the custom taxonomy */
						'singular_name' => __( 'People Category', 'js_composer' ), /* single taxonomy name */
						'search_items' =>  __( 'Search People Categories', 'js_composer' ), /* search title for taxomony */
						'all_items' => __( 'All People Categories', 'js_composer' ), /* all title for taxonomies */
						'parent_item' => __( 'Parent People Category', 'js_composer' ), /* parent title for taxonomy */
						'parent_item_colon' => __( 'Parent People Category:', 'js_composer' ), /* parent taxonomy title */
						'edit_item' => __( 'Edit People Category', 'js_composer' ), /* edit People taxonomy title */
						'update_item' => __( 'Update People Category', 'js_composer' ), /* update title for taxonomy */
						'add_new_item' => __( 'Add New People Category', 'js_composer' ), /* add new title for taxonomy */
						'new_item_name' => __( 'New People Category Name', 'js_composer' ) /* name title for taxonomy */
			    ),
			)
	);

}

add_action( 'init', 'register_custom_post_tax_type',0 );

?>