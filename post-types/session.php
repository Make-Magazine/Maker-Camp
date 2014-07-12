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
  add_meta_box( 'make-schedule', 'Schedule Session', 'make_add_schedules_mb', 'session', 'advanced', 'high' );
  add_meta_box( 'make-sessions-link', 'Session Link', 'make_sessions_link', 'session', 'side', 'core' );
  add_meta_box( 'make-sessions-advanced-project', 'Advanced Project', 'make_sessions_advanced_project', 'session', 'side', 'default' );
  add_meta_box( 'make-sessions-daily-project', 'Daily Project', 'make_sessions_daily_project', 'session', 'side', 'default' );
  add_meta_box( 'make-sessions-skill-project', 'Skill Project', 'make_sessions_skill_project', 'session', 'side', 'default' );
  add_meta_box( 'make-sessions-weekend-project', 'Weekend Project', 'make_sessions_weekend_project', 'session', 'side', 'default' );
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


/**
 * Displays the meta box for adding the session URL
 * @param  object $post The post object of the current post being edited
 * @return html
 */
function make_sessions_link( $post ) {

  // Get the data
  $session_link_title = unserialize( get_post_meta( absint( $post->ID ), 'session-link-btn-title', true ) );
  $session_link_url = unserialize( get_post_meta( absint( $post->ID ), 'session-link-btn-url', true ) );
 ?>
  <label for="btn-title"><strong>Button Title</strong></label>
  <input type="text" name="session-link[title]" id="btn-title" value="<?php echo ( ! empty( $session_link_title ) ) ? sanitize_text_field( $session_link_title ) : ''; ?>" style="display:block;width:100%;" placeholder="View Video">
  <label for="btn-link" style="margin-top:10px;"><strong>Link URL</strong></label>
  <input type="text" name="session-link[url]" id="btn-link" value="<?php echo ( ! empty( $session_link_url ) ) ? esc_url( $session_link_url ) : ''; ?>" style="display:block;width:100%;">
  <?php wp_nonce_field( 'session-meta-box-save', 'session-nonce' );
}

/**
 * Displays the meta box for adding the daily project url
 * @param  object $post The post object of the current post being edited
 * @return html
 */

function make_sessions_daily_project($post) {
  // Get the data
  $daily_project = unserialize( get_post_meta( absint( $post->ID ), 'session-daily-project', true ) ); ?>
  <label for="daily-title"><strong>Project Title</strong></label>
  <input type="text" name="daily-project[title]" id="daily-title-WHY-IS-THIS-HIDDEN" value="<?php echo ( ! empty( $daily_project['title'] ) ) ? sanitize_text_field( $daily_project['title'] ) : ''; ?>" style="display:block;width:100%;">
  <label for="daily-link" style="margin-top:10px;"><strong>Project URL</strong></label>
  <input type="text" name="daily-project[url]" id="daily-link" value="<?php echo ( ! empty( $daily_project['url'] ) ) ? esc_url( $daily_project['url'] ) : ''; ?>" style="display:block;width:100%;">

  <?php wp_nonce_field( 'session-meta-box-save', 'session-nonce' );
}


/**
 * Displays the meta box for adding the advanced project urls
 * @param  object $post The post object of the current post being edited
 * @return html
 */
function make_sessions_advanced_project( $post ) {

  // Get the data
  $adv_project = unserialize( get_post_meta( absint( $post->ID ), 'session-adv-project', true ) ); ?>
  <label for="adv-title"><strong>Project Title</strong></label>
  <input type="text" name="adv-project[title]" id="adv-title-WHY-IS-THIS-HIDDEN" value="<?php echo ( ! empty( $adv_project['title'] ) ) ? sanitize_text_field( $adv_project['title'] ) : ''; ?>" style="display:block;width:100%;">
  <label for="adv-link" style="margin-top:10px;"><strong>Project URL</strong></label>
  <input type="text" name="adv-project[url]" id="adv-link" value="<?php echo ( ! empty( $adv_project['url'] ) ) ? esc_url( $adv_project['url'] ) : ''; ?>" style="display:block;width:100%;">
  <?php wp_nonce_field( 'session-meta-box-save', 'session-nonce' );
}

/**
 * Displays the meta box for adding the skill project urls
 * @param  object $post The post object of the current post being edited
 * @return html
 */
function make_sessions_skill_project( $post ) {

  // Get the data
  $skill_project = unserialize( get_post_meta( absint( $post->ID ), 'session-skill-project', true ) ); ?>
  <label for="skill-title"><strong>Project Title</strong></label>
  <input type="text" name="skill-project[title]" id="skill-title-WHY-IS-THIS-HIDDEN" value="<?php echo ( ! empty( $skill_project['title'] ) ) ? sanitize_text_field( $skill_project['title'] ) : ''; ?>" style="display:block;width:100%;">
  <label for="skill-link" style="margin-top:10px;"><strong>Project URL</strong></label>
  <input type="text" name="skill-project[url]" id="skill-link" value="<?php echo ( ! empty( $skill_project['url'] ) ) ? esc_url( $skill_project['url'] ) : ''; ?>" style="display:block;width:100%;">
  <?php wp_nonce_field( 'session-meta-box-save', 'session-nonce' );
}

/**
 * Displays the meta box for adding the weekend project urls
 * @param  object $post The post object of the current post being edited
 * @return html
 */
function make_sessions_weekend_project( $post ) {

  // Get the data
  $weekend_project = unserialize( get_post_meta( absint( $post->ID ), 'session-weekend-project', true ) ); ?>
  <label for="weekend-title"><strong>Project Title</strong></label>
  <input type="text" name="weekend-project[title]" id="weekend-title-WHY-IS-THIS-HIDDEN" value="<?php echo ( ! empty( $weekend_project['title'] ) ) ? sanitize_text_field( $weekend_project['title'] ) : ''; ?>" style="display:block;width:100%;">
  <label for="weekend-link" style="margin-top:10px;"><strong>Project URL</strong></label>
  <input type="text" name="weekend-project[url]" id="weekend-link" value="<?php echo ( ! empty( $weekend_project['url'] ) ) ? esc_url( $weekend_project['url'] ) : ''; ?>" style="display:block;width:100%;">
  <?php wp_nonce_field( 'session-meta-box-save', 'session-nonce' );
}

/**
 * Displays the meta box for scheduling a session and adding or creating a Week
 * @param  object $post The post object of the current post being edited
 * @return html
 */
function make_add_schedules_mb( $post ) { ?>
  <table>
    <tr>
      <td width="20%"><label for="schedule-date"><strong>Date</strong></label></td>

      <td width="80%"><input type="date" name="schedule[date]" id="schedule-date" value="<?=unserialize(get_post_meta($post->ID, 'schedule-date', true)); ?>"></td>
    </tr>
    <tr>
      <td valign="top"><label for="assign-week"><strong>Assign To A Week</strong></label></td>
      <td>
        <?php make_dropdown_weeks( $post->ID ); ?>
        <hr>
        <div id="add-week-wrapper">
          <button id="add-new-week" class="button" style="display:block;">+ New Week</button>
        </div>
      </td>
    </tr>
  </table>
  <?php wp_nonce_field( 'session-meta-box-save', 'session-nonce' ); ?>
<?php }


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
  if ( isset( $_POST['session-link']['title'] ) )
    update_post_meta( absint( $post_id ), 'session-link-btn-title', serialize( $_POST['session-link']['title'] ) );

  if ( isset( $_POST['session-link']['url'] ) )
    update_post_meta( absint( $post_id ), 'session-link-btn-url', serialize( $_POST['session-link']['url'] ) );

  // Save the Session Advanced Project
  if ( isset( $_POST['adv-project'] ) )
    update_post_meta( absint( $post_id ), 'session-adv-project', serialize( $_POST['adv-project'] ) );

  if ( isset( $_POST['daily-project'] ) )
    update_post_meta( absint( $post_id ), 'session-daily-project', serialize( $_POST['daily-project'] ) );

  if ( isset( $_POST['skill-project'] ) )
    update_post_meta( absint( $post_id ), 'session-skill-project', serialize( $_POST['skill-project'] ) );

  if ( isset( $_POST['weekend-project'] ) )
    update_post_meta( absint( $post_id ), 'session-weekend-project', serialize( $_POST['weekend-project'] ) );

  if ( isset( $_POST['schedule']['date'] ) ) {
    update_post_meta ( absint( $post_id ), 'schedule-date', serialize( $_POST['schedule']['date']));
  }

  if ( isset( $_POST['schedule']['week'] ) ) {
    update_post_meta ( absint( $post_id ), 'schedule-week', $_POST['schedule']['week']);
    $term = get_term($_POST['schedule']['week'], 'week');
    #error_log(print_r($term, true));
    wp_set_object_terms( absint( $post_id), $term->term_id, 'week');
  }




  // Save the schedule date and week
  // if ( isset( $_POST['schedule'] ) ) {
  //   $schedule_obj = array(
  //     'date' => esc_attr( $_POST['schedule']['date'] ),
  //     'week' => esc_attr( $_POST['schedule']['week'] ),
  //     'title' => sanitize_text_field( $_POST['post_title'] )
  //   );
  //   make_update_schedule( $post_id, $schedule_obj, $_POST['session-nonce'] );
  // }
}
add_action( 'save_post', 'make_sessions_save_meta_boxes' );

function make_get_sessions( $args = array() ) {
  $defaults = array(
    'post_type' => 'session',
    'posts_per_page' => 20,
  );
  $query = wp_parse_args( $args, $defaults );

  $query = new WP_Query( $query );

  return $query->posts;
}


function make_list_schedule( $type = 'full' ) {
  return make_get_sessions();
}