<?php

function maker_init() {
	register_post_type( 'maker', array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'query_var'         => true,
		'rewrite'           => true,
		'labels'            => array(
			'name'                => __( 'Makers', 'makercamp' ),
			'singular_name'       => __( 'Makers', 'makercamp' ),
			'all_items'           => __( 'Makers', 'makercamp' ),
			'new_item'            => __( 'New Makers', 'makercamp' ),
			'add_new'             => __( 'Add New', 'makercamp' ),
			'add_new_item'        => __( 'Add New Makers', 'makercamp' ),
			'edit_item'           => __( 'Edit Makers', 'makercamp' ),
			'view_item'           => __( 'View Makers', 'makercamp' ),
			'search_items'        => __( 'Search Makers', 'makercamp' ),
			'not_found'           => __( 'No Makers found', 'makercamp' ),
			'not_found_in_trash'  => __( 'No Makers found in trash', 'makercamp' ),
			'parent_item_colon'   => __( 'Parent Makers', 'makercamp' ),
			'menu_name'           => __( 'Makers', 'makercamp' ),
		),
	) );

}
add_action( 'init', 'maker_init' );

function maker_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['maker'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Makers updated. <a target="_blank" href="%s">View Makers</a>', 'makercamp'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'makercamp'),
		3 => __('Custom field deleted.', 'makercamp'),
		4 => __('Makers updated.', 'makercamp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Makers restored to revision from %s', 'makercamp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Makers published. <a href="%s">View Makers</a>', 'makercamp'), esc_url( $permalink ) ),
		7 => __('Makers saved.', 'makercamp'),
		8 => sprintf( __('Makers submitted. <a target="_blank" href="%s">Preview Makers</a>', 'makercamp'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Makers scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Makers</a>', 'makercamp'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Makers draft updated. <a target="_blank" href="%s">Preview Makers</a>', 'makercamp'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'maker_updated_messages' );


/**
 * Add our meta boxes to the session post type
 * @return void
 */
function make_maker_add_meta_boxes() {
	add_meta_box( 'make-maker-add-maker', 'Assign A Maker', 'make_maker_add_maker', 'session', 'side', 'core' );
	add_meta_box( 'make-maker-google-link', 'Google+ URL', 'make_maker_google_link', 'maker', 'side', 'core' );
}
add_action( 'add_meta_boxes', 'make_maker_add_meta_boxes' );


/**
 * Creates the content inside the meta box
 * @param  object $post The post object of the current post being edited
 * @return html
 */
function make_maker_add_maker( $post ) {

	// Get the data from the DB
	$set_makers = unserialize( get_post_meta( absint( $post->ID ), 'session-makers', true ) );

	// Fetch the list of makers, but don't return those listed in the $set_makers variable
	$list_makers = make_maker_get_list(); ?>
	<label for="makers" class="screen-reader-text">Makers</label>
	<select name="makers[]" id="makers" data-placeholder="Type in the Name of A Maker" class="chosen-select" multiple>
		<?php foreach ( $list_makers as $maker ) :
			$selected = ( is_array( $set_makers ) && in_array( absint( $maker->ID ), $set_makers ) ) ? ' selected' : ''; ?>
			<option value="<?php echo absint( $maker->ID ); ?>"<?php echo $selected; ?>><?php echo esc_html( $maker->post_title ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php wp_nonce_field( 'maker-meta-box-save', 'maker-nonce' );
}


/**
 * Allows us to set the makers Google URL
 * @param  integer $post The post object of the current post being edited
 * @return html
 */
function make_maker_google_link( $post ) {
	// Get the set Google URL
	$google_url = get_post_meta( $post->ID, 'maker-google-url', true ); ?>
	<label for="google-url" class="screen-reader-text">Google+ URL</label>
	<input type="text" name="maker-google-url" id="google-url" value="<?php echo ( ! empty( $google_url ) ) ? esc_url( $google_url ) : ''; ?>" style="width:100%;">
	<?php wp_nonce_field( 'maker-meta-box-save', 'maker-nonce' );
}


/**
 * Saves all meta boxes for sessions
 * @param  Integer $post_id The post ID
 * @return void
 */
function make_maker_save_meta_boxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['maker-nonce'] ) || ! wp_verify_nonce( $_POST['maker-nonce'], 'maker-meta-box-save' ) ) return;
	if ( ! current_user_can( 'edit_post', absint( $post_id ) ) ) return;

	// Save the Google+ URL
	if ( isset( $_POST['maker-google-url'] ) )
		update_post_meta( absint( $post_id ), 'maker-google-url', esc_url( $_POST['maker-google-url'] ) );

	// Save the Makers set to the session
	if ( isset( $_POST['makers'] ) )
		update_post_meta( absint( $post_id ), 'session-makers', serialize( $_POST['makers'] ) );
}
add_action( 'save_post', 'make_maker_save_meta_boxes' );


/**
 * Fetches and returns the list of makers
 * @return Object
 */
function make_maker_get_list() {
	$query = array(
		'post_type' => 'maker',
		'post_status' => 'any',
		'order' => 'ASC',
		'orderby' => 'name',
	);
	$makers = new WP_Query( $query );

	return $makers->posts;
}
