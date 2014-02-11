<?php

function camp_init() {
	register_taxonomy( 'camp', array( 'session', 'maker' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Camps', 'makercamp' ),
			'singular_name'              => _x( 'Camp', 'taxonomy general name', 'makercamp' ),
			'search_items'               => __( 'Search Camps', 'makercamp' ),
			'popular_items'              => __( 'Popular Camps', 'makercamp' ),
			'all_items'                  => __( 'All Camps', 'makercamp' ),
			'parent_item'                => __( 'Parent Camp', 'makercamp' ),
			'parent_item_colon'          => __( 'Parent Camp:', 'makercamp' ),
			'edit_item'                  => __( 'Edit Camp', 'makercamp' ),
			'update_item'                => __( 'Update Camp', 'makercamp' ),
			'add_new_item'               => __( 'New Camp', 'makercamp' ),
			'new_item_name'              => __( 'New Camp', 'makercamp' ),
			'separate_items_with_commas' => __( 'Camps separated by comma', 'makercamp' ),
			'add_or_remove_items'        => __( 'Add or remove Camps', 'makercamp' ),
			'choose_from_most_used'      => __( 'Choose from the most used Camps', 'makercamp' ),
			'menu_name'                  => __( 'Camps', 'makercamp' ),
		),
	) );

}
add_action( 'init', 'camp_init' );
