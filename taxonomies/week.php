<?php

function week_init() {
	register_taxonomy( 'week', array( 'session', 'schedule' ), array(
		'hierarchical'      => false,
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
			'name'                       => __( 'Weeks', 'makercamp' ),
			'singular_name'              => _x( 'Week', 'taxonomy general name', 'makercamp' ),
			'search_items'               => __( 'Search Weeks', 'makercamp' ),
			'popular_items'              => __( 'Popular Weeks', 'makercamp' ),
			'all_items'                  => __( 'All Weeks', 'makercamp' ),
			'parent_item'                => __( 'Parent Week', 'makercamp' ),
			'parent_item_colon'          => __( 'Parent Week:', 'makercamp' ),
			'edit_item'                  => __( 'Edit Week', 'makercamp' ),
			'update_item'                => __( 'Update Week', 'makercamp' ),
			'add_new_item'               => __( 'New Week', 'makercamp' ),
			'new_item_name'              => __( 'New Week', 'makercamp' ),
			'separate_items_with_commas' => __( 'Weeks separated by comma', 'makercamp' ),
			'add_or_remove_items'        => __( 'Add or remove Weeks', 'makercamp' ),
			'choose_from_most_used'      => __( 'Choose from the most used Weeks', 'makercamp' ),
			'menu_name'                  => __( 'Weeks', 'makercamp' ),
		),
	) );
}
add_action( 'init', 'week_init' );


/**
 * Fetches terms for the week taxonomy
 * @todo  Update to be more configurable. right now it just returns all
 * @param  string $field [description]
 * @return [type]        [description]
 */
function make_get_week( $field = '' ) {

	if ( empty( $field ) ) {
		$weeks = get_terms( 'week', array( 'hide_empty' => false ) );
	}

	return $weeks;
}


/**
 * Produces a dropdown of all terms in the Week taxonomy
 * @return HTML
 */
function make_dropdown_weeks( $post_id ) {
	$weeks = make_get_week();
	$selected = get_the_terms( absint( $post_id ), 'week', true );
	// var_dump( $selected );
	$output = '<select name="schedule[week]" id="assign-week">';
		$output .= '<option value="">-- Select A Week --</option>';

		foreach ( $weeks as $week ) {
			$output .= '<option value="' . absint( $week->term_id ) . '"' . selected( $selected, $week->term_id ) . '>' . esc_html( $week->name ) . '</option>';
		}

	$output .= '</select>';

	echo $output;
}


/**
 * Allows us to use our custom schedule meta box in session to create new week taxonomy terms
 * @return JSON
 */
function make_ajax_add_new_week() {
	// Security check
	if ( ! wp_verify_nonce( $_POST['nonce'], 'new-week-nonce' ) )
		wp_send_json( array( 'success' => false, 'message' => 'Could not verify the request' ) );

	if ( isset( $_POST['term_name'] ) && ! empty( $_POST['term_name'] ) ) {
		$term = wp_insert_term( sanitize_text_field( $_POST['term_name'] ), 'week', array( 'slug' => sanitize_title( $_POST['term_name'] ) ) );

		if ( ! is_wp_error( $term ) ) {
			wp_send_json( array( 'success' => true, 'message' => 'Week Successfully Created!', 'term' => array( 'id' => absint( $term['term_id'] ), 'name' => sanitize_text_field( $_POST['term_name'] ) ) ) );
		} else {
			wp_send_json( array( 'success' => false, 'message' => esc_html( $term->get_error_message() ) ) );
		}
	} else {
		wp_send_json( array( 'success' => false, 'message' => 'Week name cannot be empty.' ) );
	}
}
add_action( 'wp_ajax_make_add_week', 'make_ajax_add_new_week' );