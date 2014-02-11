<?php

/**
 * Add the post type "Session" which will house all of our sessions for every camp
 * @return void
 *
 */
function make_session_init() {
	register_post_type( 'session', array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'supports'          => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'       => true,
		'query_var'         => true,
		'rewrite'           => true,
		'labels'            => array(
			'name'                => __( 'Sessions', 'makercamp' ),
			'singular_name'       => __( 'Sessions', 'makercamp' ),
			'all_items'           => __( 'Sessions', 'makercamp' ),
			'new_item'            => __( 'New Sessions', 'makercamp' ),
			'add_new'             => __( 'Add New', 'makercamp' ),
			'add_new_item'        => __( 'Add New Sessions', 'makercamp' ),
			'edit_item'           => __( 'Edit Sessions', 'makercamp' ),
			'view_item'           => __( 'View Sessions', 'makercamp' ),
			'search_items'        => __( 'Search Sessions', 'makercamp' ),
			'not_found'           => __( 'No Sessions found', 'makercamp' ),
			'not_found_in_trash'  => __( 'No Sessions found in trash', 'makercamp' ),
			'parent_item_colon'   => __( 'Parent Sessions', 'makercamp' ),
			'menu_name'           => __( 'Sessions', 'makercamp' ),
		),
	) );

}
add_action( 'init', 'make_session_init' );

function make_session_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['session'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Sessions updated. <a target="_blank" href="%s">View Sessions</a>', 'makercamp'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'makercamp'),
		3 => __('Custom field deleted.', 'makercamp'),
		4 => __('Sessions updated.', 'makercamp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Sessions restored to revision from %s', 'makercamp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Sessions published. <a href="%s">View Sessions</a>', 'makercamp'), esc_url( $permalink ) ),
		7 => __('Sessions saved.', 'makercamp'),
		8 => sprintf( __('Sessions submitted. <a target="_blank" href="%s">Preview Sessions</a>', 'makercamp'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Sessions scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Sessions</a>', 'makercamp'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Sessions draft updated. <a target="_blank" href="%s">Preview Sessions</a>', 'makercamp'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'make_session_updated_messages' );


/**
 * Add our meta boxes to the session post type
 * @return void
 */
function make_session_add_meta_boxes() {
	add_meta_box( 'make-sessions-materials-instructions', 'Materials and Instructions', 'make_sessions_materials_instructions', 'session', 'advanced', 'high' );
	add_meta_box( 'make-sessions-link', 'Session Link', 'make_sessions_link', 'session', 'side', 'core' );
}
add_action( 'add_meta_boxes', 'make_session_add_meta_boxes' );


/**
 * Creates the content inside the meta box
 * @param  object $post The post object of the current post being edited
 * @return html
 */
function make_sessions_materials_instructions( $post ) {

	// Get the data from the DB
	$mats_instruct = get_post_meta( absint( $post->ID ), 'materials-instructions', true );

	// Load in the TinyMCE editor
	wp_editor( wp_kses_post( $mats_instruct ), 'session-mat-instruct', array(
		'media_buttons' => false,
		'tinymce' => array(
			'theme_advanced_buttons1' => 'formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,spellchecker,wp_fullscreen,wp_adv'
		),
	) );

	// Set a security check
	wp_nonce_field( 'session-meta-box-save', 'session-nonce' );
}


function make_sessions_link( $post ) {

	// Get the data
	$session_link = unserialize( get_post_meta( absint( $post->ID ), 'session-link', true ) ); ?>
	<label for="btn-title"><strong>Button Title</strong></label>
	<input type="text" name="session-link['title']" id="btn-title" value="<?php echo ( ! empty( $session_link['title'] ) ) ? esc_attr( $session_link['title'] ) : ''; ?>" style="display:block;width:100%;" placeholder="View Video">
	<label for="btn-link" style="margin-top:10px;"><strong>Link URL</strong></label>
	<input type="text" name="session-link['url']" id="btn-link" value="<?php echo ( ! empty( $session_link['url'] ) ) ? esc_url( $session_link['url'] ) : ''; ?>" style="display:block;width:100%;">
	<?php wp_nonce_field( 'session-meta-box-save', 'session-nonce' );
}

/**
 * Saves all meta boxes for sessions
 * @param  Integer $post_id The post ID
 * @return void
 */
function make_sessions_save_meta_boxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['session-nonce'] ) || ! wp_verify_nonce( $_POST['session-nonce'], 'session-meta-box-save' ) ) return;
	if ( ! current_user_can( 'edit_post', absint( $post_id ) ) ) return;
	
	// Save the Materials and Instructions
	if ( isset( $_POST['session-mat-instruct'] ) )
		update_post_meta( absint( $post_id ), 'materials-instructions', wp_kses_post( $_POST['session-mat-instruct'] ) );

	// Save the Session link
	if ( isset( $_POST['session-link'] ) )
		update_post_meta( absint( $post_id ), 'session-link-btn', serialize( $_POST['session-link'] ) );
}
add_action( 'save_post', 'make_sessions_save_meta_boxes' );
