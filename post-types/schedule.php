<?php

/**
 * Add the post type "Session" which will house all of our sessions for every camp
 * @return void
 *
 */
function make_schedule_init() {
	register_post_type( 'schedule', array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => false,
		'supports'          => array( 'title' ),
		'has_archive'       => false,
		'query_var'         => true,
		'rewrite'           => false,
		'labels'            => array(
			'name'                => __( 'Schedules', 'makercamp' ),
			'singular_name'       => __( 'Schedule', 'makercamp' ),
			'all_items'           => __( 'Schedules', 'makercamp' ),
			'new_item'            => __( 'New Schedule', 'makercamp' ),
			'add_new'             => __( 'Add New', 'makercamp' ),
			'add_new_item'        => __( 'Add New Schedule', 'makercamp' ),
			'edit_item'           => __( 'Edit Schedule', 'makercamp' ),
			'view_item'           => __( 'View Schedule', 'makercamp' ),
			'search_items'        => __( 'Search Schedules', 'makercamp' ),
			'not_found'           => __( 'No Schedules found', 'makercamp' ),
			'not_found_in_trash'  => __( 'No Schedules found in trash', 'makercamp' ),
			'parent_item_colon'   => __( 'Parent Schedule', 'makercamp' ),
			'menu_name'           => __( 'Schedules', 'makercamp' ),
		),
	) );

}
add_action( 'init', 'make_schedule_init' );



/**
 * Allows us to update the schedule information for a session.
 * @param  [type] $post_id  [description]
 * @param  [type] $schedule [description]
 * @param  [type] $nonce    [description]
 * @return [type]           [description]
 */
function make_update_schedule( $post_id, $schedule, $nonce ) {
	if ( ! empty( $nonce ) && ! wp_verify_nonce( $nonce, 'session-meta-box-save' ) )
		return;

	// Check if this session has already been scheduled.
	$schedule_id = get_post_meta( absint( $post_id ), 'session-schedule-id', true );
	if ( empty( $schedule_id ) ) {
		$schedule_obj = array(
			'post_title' => sanitize_text_field( $schedule['title'] . ' Schedule' ),
			'post_status' => 'published',
			'post_type' => 'schedule',
			'post_author' => absint( get_current_user_id() ),
		);
		$schedule_id = wp_insert_post( $schedule_obj, true );

		// Add our date to the post meta
		update_post_meta( absint( $schedule_id ), 'schedule', serialize( $schedule ) );

		// Add the schedule id to the post meta of the session post.
		update_post_meta( absint( $post_id ), 'session-schedule-id', absint( $schedule_id ) );
	} else {
		$sched_orig = unserialize( get_post_meta( absint( $schedule_id ), 'schedule', true ) );

		if ( $sched_orig != $schedule ) {
			update_post_meta( absint( $schedule_id ), 'schedule', serialize( $schedule ) );
		}
	}

	return $schedule_id;
}