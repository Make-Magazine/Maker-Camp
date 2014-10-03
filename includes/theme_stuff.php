<?php
/**
 * General makeblog theme functions
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 *
 * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses add_image_size() To set a custom post thumbnail size.
 *
 */
function make_action_after_setup_theme() {

	// Support for Featured Images
	add_theme_support('post-thumbnails' );

	// Content Width
	if ( ! isset( $content_width ) )
		$content_width = 1170; // Max width of the main content

	// Custom Backgrounds
	add_theme_support( 'custom-background' );

	add_theme_support( 'automatic-feed-links' );

	// Add our Menus
	register_nav_menu( 'mc-header-menu', __( 'Maker Camp Nav' ) );

}
add_action( 'after_setup_theme', 'make_action_after_setup_theme' );

/**
 * Enqueue all scripts and stylesheets.
 * @return void
 *
 * @version  1.1
 */
function make_load_resources() {
	// To ensure CSS files are downloaded in parallel, always include CSS before JavaScript.
	wp_enqueue_style( 'make-css', get_stylesheet_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'make-css', get_stylesheet_directory_uri() . '/css/redesign.css' );
	wp_enqueue_style( 'make-print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );

	// Load our common scripts first. These should not require jQuery
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'make-bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'maker-camp-js', get_stylesheet_directory_uri() . '/js/common.js', array('jquery'), '1.0', true );

	// display our map sort plugin for Maker Camp
	if ( is_page( 20 ) ) // TODO: Update page id to match new page created
		wp_enqueue_script( 'make-sort-table', get_stylesheet_directory_uri() . '/js/libs/jquery.tablesorter.min.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'make_load_resources' );


/**
 * Enqueue all scripts and stylesheets for the admin area
 * @return void
 *
 * @version 0.1
 */
function make_load_admin_resources() {
	$screen = get_current_screen();

	// Load our selection script only for Sessions
	if ( $screen->id === 'session' ) {
		wp_enqueue_style( 'make-chosen-styles', esc_url( get_stylesheet_directory_uri() . '/css/chosen.min.css' ) );
		wp_enqueue_script( 'make-chosen-js', esc_url( get_stylesheet_directory_uri() . '/js/libs/chosen.jquery.min.js' ), array( 'jquery' ), '1.1.0', true );

		// Schedule JS
		wp_enqueue_script( 'make-schedule-js', esc_url( get_stylesheet_directory_uri() . '/js/schedules.js' ), array( 'jquery' ), '1.0', true );
		wp_localize_script( 'make-schedule-js', 'make_schedule', array(
			'schedule_nonce' => wp_create_nonce( 'new-week-nonce' ),
		) );
	}
}
add_action( 'admin_enqueue_scripts', 'make_load_admin_resources' );


/**
 * Register the WordPress sidebars.
 */
function make_register_sidebar() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar(
			array(
				'id' => 'sidebar_top',
				'name' => __( 'Sidebar Top', 'makercamp' ),
				'description' => __( 'This widget area is at the top of the sidebar, above everything else.', 'makercamp' ),
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'id' => 'sidebar_bottom',
				'name' => __( 'Sidebar Bottom', 'makercamp' ),
				'description' => __( 'This widget area is at the bottom of the sidebar, below everything else.', 'makercamp' ),
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			)
		);
	}
}
add_action( 'widgets_init', 'make_register_sidebar' );


/**
 * Adds the post thumbnail to the RSS feed.
 * Like a lot of people, I wish that we weren't truncating the RSS feed, but hey, not my decision!
 */
function make_rss_post_thumbnail( $content ) {
	global $post;

	if ( has_post_thumbnail( absint( $post->ID ) ) )
		$content = '<a href="' . esc_url( get_permalink() ) . '">' . get_the_post_thumbnail( absint( $post->ID ), 'archive-thumb', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '</a>' . esc_html( get_the_excerpt() ) . '<p><a href="' . esc_url( get_permalink() ) . '">Read more on MAKE</a></p>';

	return $content;
}
add_filter( 'the_excerpt_rss', 'make_rss_post_thumbnail' );
add_filter( 'the_content_feed', 'make_rss_post_thumbnail' );


/**
 * Adds the ability to get all posts from a given parent in the admin.
 */
function make_support_post_parent_queries_in_admin( $query ) {
	if ( is_admin() && ! empty( $_GET['post_parent'] ) && $query->is_main_query() && ! $query->get( 'post_parent' ) && empty( $_POST ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		$query->set( 'post_parent', absint( $_GET['post_parent'] ) );
	}
}
add_action( 'pre_get_posts', 'make_support_post_parent_queries_in_admin' );

function make_allow_data_atts() {
	global $allowedposttags;

	$tags = array( 'div,a,li' );
	$new_attributes = array(
		'data-toggle'	=> true,
		'data-dismiss'	=> true,
		'data-slide'	=> true,
	);

	foreach ( $tags as $tag ) {
		if ( isset( $allowedposttags[ $tag ] ) && is_array( $allowedposttags[ $tag ] ) )
			$allowedposttags[ $tag ] = array_merge( $allowedposttags[ $tag ], $new_attributes );
	}
}
add_action( 'init', 'make_allow_data_atts' );

function make_filter_tiny_mce_before_init( $options ) {
	if ( ! isset( $options['extended_valid_elements'] ) )
		$options['extended_valid_elements'] = '';
		$options['extended_valid_elements'] .= ',a[data*|class|id|style|href]';
		$options['extended_valid_elements'] .= ',li[data*|class|id|style]';
		$options['extended_valid_elements'] .= ',div[data*|class|id|style]';
	return $options;
}
add_filter('tiny_mce_before_init', 'make_filter_tiny_mce_before_init');


function mf_allow_data_atts( $allowedposttags, $context ) {
	$tags = array( 'div', 'a', 'li' );
	$new_attributes = array(
		'data-toggle' 	=> true,
		'data-dismiss' 	=> true,
		'data-interval'	=> true,
	);

	foreach ( $tags as $tag ) {
		if ( isset( $allowedposttags[ $tag ] ) && is_array( $allowedposttags[ $tag ] ) )
			$allowedposttags[ $tag ] = array_merge( $allowedposttags[ $tag ], $new_attributes );
	}

	return $allowedposttags;
}
add_filter( 'wp_kses_allowed_html', 'mf_allow_data_atts', 10, 2 );


function mf_filter_tiny_mce_before_init( $options ) {

	if ( ! isset( $options['extended_valid_elements'] ) )
		$options['extended_valid_elements'] = '';

	$options['extended_valid_elements'] .= ',a[data*|class|id|style|href]';
	$options['extended_valid_elements'] .= ',li[data*|class|id|style]';
	$options['extended_valid_elements'] .= ',div[data*|class|id|style]';

	return $options;
}
add_filter( 'tiny_mce_before_init', 'mf_filter_tiny_mce_before_init' );


/**
 * Function to generate the title tags for page heads.
 */
function make_generate_title_tag() {
	$output = '';
	if ( is_home() || is_front_page() ) {
		$output .= get_bloginfo('name') . ' | ' . get_bloginfo('description');
	} elseif ( is_page( 235220 ) || is_post_type_archive( 'craft' ) ) {
		$output .= 'Craft | Crocheting, kniting, sewing, jewelry making, and papercraft';
	} elseif ( is_singular( 'craft' ) ) {
		$output .= wp_title( '', false ) . ' | MAKE: Craft';
	} else {
		$output .= wp_title( '', false ) . ' | ' . get_bloginfo('name');
	}
	return $output;
}


/**
 * Generate a description for the meta description tag.
 *
 * On the home page, use the bloginfo() description, if a single page, use 20 words of the post content. At some point, need to use the excerpt if it exists, then default to the post content. At the end, run it through esc_attr().
 */
function make_generate_description() {
	global $post;
	if ( is_single() ) {
		if ( empty ($post->post_content) ) {
			$fallback_content = get_post_meta ( absint( $post->ID ), 'Description' , true );
			return esc_attr( wp_trim_words( htmlspecialchars( wp_kses( strip_shortcodes( $fallback_content ), array() ) ), 20 ) );
		}
		return esc_attr( wp_trim_words( htmlspecialchars( wp_kses( strip_shortcodes( $post->post_content ), array() ) ), 20 ) );
	} elseif( is_page( 235220 ) || is_post_type_archive( 'craft' ) ) {
		return 'The craft movement encourages people to make things themselves rather than buy what thousands of others already own';
	} else {
		return esc_attr( get_bloginfo('name') . " - " . get_bloginfo('description') );
	}
}


/**
 * Adds footer copyright information
 */
function make_copyright_footer() { ?>
	<div class="row">
		<div class="span12 footer_copyright text-center">
			<p><a href="http://makezine.com/">Make:</a> and <a href="http://makerfaire.com/">Maker Faire</a> are registered trademarks of <a href="http://makermedia.com/">Maker Media, Inc.</a></p>
			<p>Copyright &copy; 2004-<?php echo date("Y") ?> Maker Media, Inc.  All rights reserved</p>
		</div>
	</div>
<?php }

/**
 * Get a volume cover image
 */
function make_get_cover_image( $number = 39 ) {
	$url = esc_url( 'http://cdn.makezine.com/make/covers/MAKE_V' . absint( $number ) . '_high.jpg' );
	return $url;
}

/**
* Open Graph functionality for Home page
 */

function fb_home_image( $tags ) {
    if ( is_home() || is_front_page() ) {
        // Remove the default blank image added by Jetpack
        unset( $tags['og:image'] );

        $fb_home_img = 'http://makercamp.com/wp-content/uploads/2014/07/maker-camp-01.png';
        $tags['og:image'] = esc_url( $fb_home_img );
    }
    return $tags;
}
add_filter( 'jetpack_open_graph_tags', 'fb_home_image' );
