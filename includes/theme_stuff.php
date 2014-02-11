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

	add_theme_support('post-thumbnails' );
	// Add Image Sizes here http://codex.wordpress.org/Function_Reference/add_image_size


	// Content Width
	if ( ! isset( $content_width ) )
		$content_width = 1170; // Max width of the main content

	// Custom Backgrounds
	add_theme_support( 'custom-background' );

	add_theme_support( 'automatic-feed-links' );

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
	wp_enqueue_style( 'make-print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );

	// Load our common scripts first. These should not require jQuery
	wp_enqueue_script( 'make-typekit', 'http://use.typekit.com/fzm8sgx.js', array() );
	wp_enqueue_script( 'make-common', get_stylesheet_directory_uri() . '/js/common.js', array( 'make-typekit' ) );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'make-bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'make-header', get_stylesheet_directory_uri() . '/js/header.js', array( 'jquery' ), false, true );
	
	// display our map sort plugin for Maker Camp
	if ( is_page( 315793 ) ) // TODO: Update page id to match new page created
		wp_enqueue_script( 'make-sort-table', get_stylesheet_directory_uri() . '/js/jquery.tablesorter.min.js', array( 'jquery' ), false, true );
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
	}
}
add_action( 'admin_enqueue_scripts', 'make_load_admin_resources' );

/**
 * Provides a way to truncate titles
 * @param  integer $length The desiered length
 * @return string
 */
function make_get_short_title( $length ) {
	$original = get_the_title();
	$title = substr( $original, 0, absint( $length ) );
	if ( strlen( $original ) > absint( $length ) ) $title .= '...';

	return $title;
}


/**
 * Register the WordPress sidebar to site.
 * 
 */
function make_register_sidebar() {
	if( function_exists('register_sidebar')) {
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
 * Get the first category name of a post.
 * This take the category name, strips out content (spaces, &, and) and then returns.
 * @return string Main category name with a slash at the end.
 */
function make_get_category_name() {
	global $post;
	if ( is_single() && has_category() ) {
		$cats = get_the_terms($post->ID, 'category');
		$sortcats = array_shift($cats);
		if (!empty($sortcats)) {
			$cat = $sortcats; // let's just assume the post has one category
		}
	}
	elseif ( is_category() ) { // category archives
		$cat = get_queried_object();
	}
	if (is_single() || is_category()) {
		$output = '/';	
	} else {
		$output = null;
	}
	$boom = array( '&amp;', ' ', 'and' );
	if (!empty($cat->name)) {
		$output .= str_replace($boom, '', $cat->name);
	}
	return $output;
}


/**
 * Get the first category name of a post.
 * This take the category name, strips out content (spaces, &, and) and then returns.
 * @return string Main category name with a stripped slash.
 */
function make_get_category_name_strip_slash() {
	if ( is_single() ) {
		$cats =  get_the_category();
		$cat = $cats[0]; // let's just assume the post has one category
	}
	elseif ( is_category() ) { // category archives
		$cat = get_queried_object();
	}

	if (isset($cat->name)) {
		$boom = array( '&amp;', ' ', 'and' );
		$output = str_replace($boom, '', $cat->name);
		return $output;
	}
}


/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}

/**
 * Adds the Quantcast tag to the bottom of the page.
 * @return string Quantcast Javascript tracking code.
 */
function make_quantcast_tag() { ?>
		<!-- Quantcast Tag -->
		<script type="text/javascript">
			var _qevents = _qevents || [];

			(function() {
				var elem = document.createElement('script');
				elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
				elem.async = true;
				elem.type = "text/javascript";
				var scpt = document.getElementsByTagName('script')[0];
				scpt.parentNode.insertBefore(elem, scpt);
			})();

			_qevents.push({
				qacct:"p-c0y51yWFFvFCY"
			});
		</script>

		<noscript>
			<div style="display:none;">
				<img src="//pixel.quantserve.com/pixel/p-c0y51yWFFvFCY.gif" border="0" height="1" width="1" alt="Quantcast"/>
			</div>
		</noscript>
		<!-- End Quantcast tag -->
<?php }
add_action('wp_footer', 'make_quantcast_tag');


/**
 * Removes the thumbnail class from the homepages of Craft and make.
 */
function make_get_rid_of_thumbnail_class() {

	if ( is_page( array( 'craft-home', 'home-page-include', 'home-page' ) ) ) { ?>

		<script>
			jQuery(document).ready(function(){
				jQuery(".entry-content img").removeClass('thumbnail');
			});
		</script>

	<?php }
}

add_action('wp_footer', 'make_get_rid_of_thumbnail_class');

/**
 * Hides the post name from the breadcrumb.
 * Ideally, we would do this using PHP, but I couldn't figure out an easy method. While this might be a little jarring, it works for now.
 */
function make_hide_breadcrumb_elements() {

	if (is_single()) { ?>

		<script>
			jQuery(document).ready(function(){
				jQuery("span.divider").eq(-1).hide();
				jQuery(".current").hide();
			});
		</script>

	<?php }
}

add_action('wp_footer', 'make_hide_breadcrumb_elements');

add_action('right_now_content_table_end', 'add_magazine_article_counts');

/**
 * Counts the post numbers for the Dashboard.
 */
function add_magazine_article_counts() {
		if (!post_type_exists('magazine')) {
			 return;
		}

		$num_posts = wp_count_posts( 'magazine' );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( 'Magazine Article', 'Magazine Articles', intval($num_posts->publish) );
		if ( current_user_can( 'edit_posts' ) ) {
			$url = admin_url( 'edit.php?post_type=magazine' );
			$num = '<a href="'.$url.'">'.$num.'</a>';
			$text = '<a href="'.$url.'">'.$text.'</a>';
		}
		echo '<td class="first b b-magazine">' . $num . '</td>';
		echo '<td class="t magazine">' . $text . '</td>';

		echo '</tr>';

		if ($num_posts->pending > 0) {
			$num = number_format_i18n( $num_posts->pending );
			$text = _n( 'Magazine Articles Pending', 'Magazine Articles Pending', intval($num_posts->pending) );
			if ( current_user_can( 'edit_posts' ) ) {
				$url = admin_url( 'edit.php?post_status=pending&post_type=magazine' );
				$num = '<a href="'.$url.'">'.$num.'</a>';
				$text = '<a href="'.$url.'">'.$text.'</a>';
			}
			echo '<td class="first b b-recipes">' . $num . '</td>';
			echo '<td class="t recipes">' . $text . '</td>';

			echo '</tr>';
		}
}

add_action('right_now_content_table_end', 'add_craft_article_counts');


/**
 * Takes popular tags, and renames them.
 */
function make_get_better_tag_title( $title = null ) {
	if ( $title == null ) {
		$title = single_cat_title('', false);	
	}
	$machine = array(
		'robotskills', 
		'castmat', 
		'advancedmaterials', 
		'reusedmat', 
		'plywoodmat', 
		'naturalmaterials', 
		'naturalmaterial', 
		'metalmat', 
		'ceramicsmat', 
		'concretematerial', 
		'circuitskills', 
		'electronskills', 
		'foodskills', 
		'hobbyskills', 
		'machineskills', 
		'MechanicSkills', 
		'metalskills',
		'Photo Skills',
		'plasticskills',
		'robotskills',
		'skillbuilder',
		'WoodSkills',
		'papermat',
		'glassmat',
		'greatcreate'
		);
	$human   = array(
		'Robot Skill Builder', 
		'Casting Materials', 
		'Advanced Mataerials', 
		'Reused Materials', 
		'Plywood', 
		'Natural Materials', 
		'Natural Materials', 
		'Metal', 
		'Ceramics', 
		'Concrete', 
		'Circuit Skill Builder',
		'Electronics Skill Builder', 
		'Food Skill Builder',
		'Hobby Skill Builder', 
		'Machining Skill Builder', 
		'Mechanic Skill Builder', 
		'Metal Skill Builder',
		'Photo Skill Builder',
		'Plastic Skill Builder',
		'Robot Skill Builder',
		'Skill Builder',
		'Woodworking Skill Builder',
		'Paper Skill Builder',
		'Glass',
		'Radio Shack\'s The Great Create'
		);

	$newtag = str_replace($machine, $human, $title);
	return $newtag;

}


/**
 * Adds the post thumbnail to the RSS feed.
 * Like a lot of people, I wish that we weren't truncating the RSS feed, but hey, not my decision!
 */
function make_rss_post_thumbnail($content) {
	global $post;
	if( has_post_thumbnail($post->ID) ) {
		$content =  '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, 'archive-thumb', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '</a>' . get_the_excerpt() . '<p><a href="' . get_permalink() . '">Read more on MAKE</a></p>';
	}
	return $content;
}

add_filter('the_excerpt_rss', 'make_rss_post_thumbnail');
add_filter('the_content_feed', 'make_rss_post_thumbnail');


/**
 * Adds icons for the custom post types that are in the admin.
 */
function make_cpt_icons() { ?>
	<style type="text/css" media="screen">
		.icon16.icon-dashboard:before,
		#adminmenu .menu-icon-dashboard div.wp-menu-image:before {
			content: '\f226';
		}

		.icon16.icon-post:before,
		#adminmenu .menu-icon-post div.wp-menu-image:before {
			content: '\f109';
		}

		.icon16.icon-media:before,
		#adminmenu .menu-icon-media div.wp-menu-image:before {
			content: '\f104';
		}

		.icon16.icon-links:before,
		#adminmenu .menu-icon-links div.wp-menu-image:before {
			content: '\f103';
		}

		.icon16.icon-page:before,
		#adminmenu .menu-icon-page div.wp-menu-image:before {
			content: '\f105';
		}

		.icon16.icon-comments:before,
		#adminmenu .menu-icon-comments div.wp-menu-image:before {
			content: '\f101';
			margin-top: 1px;
		}

		.icon16.icon-appearance:before,
		#adminmenu .menu-icon-appearance div.wp-menu-image:before {
			content: '\f100';
		}

		.icon16.icon-plugins:before,
		#adminmenu .menu-icon-plugins div.wp-menu-image:before {
			content: '\f106';
		}

		.icon16.icon-users:before,
		#adminmenu .menu-icon-users div.wp-menu-image:before {
			content: '\f110';
		}

		.icon16.icon-tools:before,
		#adminmenu .menu-icon-tools div.wp-menu-image:before {
			content: '\f107';
		}

		.icon16.icon-settings:before,
		#adminmenu .menu-icon-settings div.wp-menu-image:before {
			content: '\f108';
		}

		.icon16.icon-site:before,
		#adminmenu .menu-icon-site div.wp-menu-image:before {
			content: '\f112'
		}

		.icon16.icon-generic:before,
		#adminmenu .menu-icon-generic div.wp-menu-image:before {
			content: '\f111';
		}

		.icon16.icon-video:before,
		#adminmenu #menu-posts-video div.wp-menu-image:before {
			content: '\f126';
		}

		.icon16.icon-project:before,
		#adminmenu #menu-posts-projects div.wp-menu-image:before {
			content: '\f308';
		}

		.icon16.icon-magazine:before,
		#adminmenu #menu-posts-magazine div.wp-menu-image:before {
			content: '\f123';
		}

		.icon16.icon-review:before,
		#adminmenu #menu-posts-review div.wp-menu-image:before {
			content: '\f175';
		}

		.icon16.icon-volume:before,
		#adminmenu #menu-posts-volume div.wp-menu-image:before {
			content: '\f318';
		}

		.icon16.icon-errata:before,
		#adminmenu #menu-posts-errata div.wp-menu-image:before {
			content: '\f117';
		}

		.icon16.icon-page_2:before,
		#adminmenu #menu-posts-page_2 div.wp-menu-image:before {
			content: '\f161';
		}

		.icon16.icon-slideshow:before,
		#adminmenu #menu-posts-slideshow div.wp-menu-image:before {
			content: '\f181';
		}

		.icon16.icon-golink:before,
		#adminmenu #menu-posts-go div.wp-menu-image:before {
			content: '\f103';
		}

		.icon16.icon-newsletter:before,
		#adminmenu #menu-posts-newsletter div.wp-menu-image:before {
			content: '\f116';
		}
		.icon16.icon-craft:before,
		#adminmenu #menu-posts-craft div.wp-menu-image:before {
			content: '\f309';
		}

		.icon16.icon-from-the-maker-shed:before,
		#adminmenu #menu-posts-from-the-maker-shed div.wp-menu-image:before {
			content: '\f312';
		 }

	</style>
<?php }

add_action( 'pre_get_posts', 'make_support_post_parent_queries_in_admin' );
/**
 * Adds the ability to get all posts from a given parent in the admin.
 */
function make_support_post_parent_queries_in_admin( $query ) {
	if ( is_admin() && ! empty( $_GET['post_parent'] ) && $query->is_main_query() && ! $query->get( 'post_parent' ) && empty( $_POST ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		$query->set( 'post_parent', absint( $_GET['post_parent'] ) );
	}
}

function make_get_post_meta_rss( $term ) {
	$term =  get_post_custom_values( $term );
	$term = $term[0];
	$term = ent2ncr( $term );
	return $term;

}

/**
 * Spits out a UL of all of the featured posts
 */
function make_daily_themes() {
	$featuredposts = esc_html( make_get_cap_option( 'weekly' ) );
	$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
	$output = '<ul>';
	foreach ( $posts as $idx => $post ) {
		$output .= '<li><a href="' . get_permalink( $post->ID ) . '">';
		if ( $idx == 0 )
			$output .= '<strong>Monday Jolt:</strong> ';
		if ( $idx == 1 )
			$output .= '<strong>Toolsday:</strong> ';
		if ( $idx == 2 )
			$output .= '<strong>Workshop Wednesday:</strong> ';
		if ( $idx == 3 )
			$output .= '<strong>3D Thursday:</strong> ';
		if ( $idx == 4 )
			$output .= '<strong>Family Friday:</strong> ';
		$output .= get_the_title( $post->ID );
		$output .= '</a></li>';
		
	}
	$output .= '</ul>';
	return $output;
	
	wp_reset_query();
}

add_shortcode( 'make-themes', 'make_daily_themes' );

/**
 * Adds a dynamic feature block to the home page.
 */
function make_featured_post() {
	global $post;
	$post_id = make_get_cap_option( 'daily' );
	$post = get_post( $post_id );
	$output = '<div class="img"><a href="' . get_permalink( $post->ID) . '">';
	$output .= get_the_post_thumbnail( $post->ID , $size = 'featured-thumb' );
	$output .= '</div>';
	$output .= '<div class="blurb">';
	$output .= '<h3><span class="trending">What\'s hot:</span> ' . $post->post_title . '</h3>';
	$output .= '<p><small>By: <strong>' . coauthors( ', ', ' & ', '', '', false ) . '</strong></small></p>';
	$output .= '<p>' . wp_trim_words(strip_shortcodes( $post->post_content ), 20) . '</p>';
	$output .= '</a></div>';
	return $output;
}


/**
 * Renames the custom post type on the front end to be a little better.
 */
function make_post_type_better_name( $name ) {
	if ($name == 'post') {
		return 'posts';
	} elseif ($name == 'projects' ) {
		return 'projects';
	} elseif ( $name == 'videos' ) {
		return 'videos';
	} elseif ( $name == 'magazine' ) {
		return 'articles';
	} elseif ( $name == 'review' ) {
		return 'reviews';
	} elseif ( $name == 'craft' ) {
		return 'craft';
	} 
}

add_action( 'init', 'make_allow_data_atts' );
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

add_filter('tiny_mce_before_init', 'make_filter_tiny_mce_before_init'); 
function make_filter_tiny_mce_before_init( $options ) { 

	if ( ! isset( $options['extended_valid_elements'] ) ) 
		$options['extended_valid_elements'] = ''; 

	$options['extended_valid_elements'] .= ',a[data*|class|id|style|href]';
	$options['extended_valid_elements'] .= ',li[data*|class|id|style]';
	$options['extended_valid_elements'] .= ',div[data*|class|id|style]';

	return $options; 
}

add_filter( 'wpcom_sitemap_post_types', 'make_sitemap_add_gallery_post_type' );

function make_sitemap_add_gallery_post_type( $post_types ) {
	$post_types[] = 'gallery';
	$post_types[] = 'video';
	$post_types[] = 'craft';
	$post_types[] = 'review';
	$post_types[] = 'projects';
	return $post_types;
}


/**
 * Adds a menu field to the menus section of the admin area for the topbar
 * @return void
 *
 * @version  1.1
 */
function make_register_menu() {

	// Make Navigation menus
	register_nav_menu( 'make-primary', __( 'Make Primary Nav', 'make' ) );
	register_nav_menu( 'make-secondary', __( 'Make Secondary Nav', 'make' ) );

	// Popdown Menus
	register_nav_menu( 'popdown-menu-top', __( 'Popdown Top', 'make' ) );
	register_nav_menu( 'popdown-menu-middle', __( 'Popdown Middle', 'make' ) );
	register_nav_menu( 'popdown-menu-last', __( 'Popdown Last', 'make' ) );
}
add_action( 'init', 'make_register_menu' );


add_filter( 'wp_kses_allowed_html', 'mf_allow_data_atts', 10, 2 );
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


add_filter('tiny_mce_before_init', 'mf_filter_tiny_mce_before_init'); 
function mf_filter_tiny_mce_before_init( $options ) { 

	if ( ! isset( $options['extended_valid_elements'] ) ) 
		$options['extended_valid_elements'] = ''; 

	$options['extended_valid_elements'] .= ',a[data*|class|id|style|href]';
	$options['extended_valid_elements'] .= ',li[data*|class|id|style]';
	$options['extended_valid_elements'] .= ',div[data*|class|id|style]';

	return $options; 
}


/**
 * Allows us to easily integrate different types of authors.
 * This is needed because our blog feeds contain multiple types of posts.
 * This will handle the display of those different kinds and apply the right data and styling.
 * @param  string $post_id The post ID of the post we are returning this info for
 * @param  string $prefix  The string to add in front of the autor name. Defaults to "By".
 * @return String
 *
 * @version  1.0
 */
function make_get_author( $post_id, $prefix = 'By' ) {

	// Return our post type name
	$post_type = get_post_type( absint( $post_id ) );

	// Check that we are not loading a video CPT. If we are, return false so we don't echo anything
	// if ( $post_type == 'video')
	// 	return false;

	// If we want to echo our results, we'll do that here.
	echo '<li>';
	echo esc_attr( $prefix ) . ' ';

	if( function_exists( 'coauthors_posts_links' ) ) {	
		coauthors_posts_links(); 
	} else { 
		the_author_posts_link(); 
	}

	echo '</li>';

}


/**
 * Filter the query variables and make sure we are searching for the feed so we can include our custom post types like a boss.
 * @param  array $query_var The query variables.
 * @return array
 *
 * @version  1.0
 */
function make_add_post_types_to_feed( $query_var ) {

	// Check that we are quering the RSS feed and post_type isn't being used.
	if ( isset( $query_var['feed'] ) && ! isset( $query_var['post_type'] ) )
		$query_var['post_type'] = array( 'post', 'projects', 'review', 'video', 'magazine' );

	return $query_var;
	
}
add_filter( 'request', 'make_add_post_types_to_feed' );



/**
 * Outputs the code for our Popdown menu found on all Make sites
 * @return html
 *
 * @version  1.0
 */
function make_popdown_menu() { ?>
	<div class="make-popdown">
		<div class="wrapper-container">
			<div class="container">
				<div class="row">
					<div class="span3 offset2 border-right">
						<div class="row-fluid">
							<a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&amp;PK=M37BN05" class="span4" onClick="_gaq.push(['_trackEvent', 'popdown-subscribe', 'Click', 'Subscribe Image']);"><img src="<?php echo get_template_directory_uri(); ?>/img/footer-make-cover.jpg" alt=""></a>
							<div class="span7 side-text">
								<a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&amp;PK=M37BN05" onClick="_gaq.push(['_trackEvent', 'popdown-subscribe', 'Click', 'Subscribe Link']);">Subscribe to MAKE!</a> Receive both print &amp; digital editions.
							</div>
						</div>
					</div>
					<div class="span2 border-right">
						<?php wp_nav_menu( array(
							'theme_location'  => 'popdown-menu-top',
							'container'       => false, 
							'menu_class'      => 'first nav ga-nav',
							'depth'           => 1 
						) ); ?>
					</div>
					<div class="span4">
						<?php wp_nav_menu( array(
							'theme_location'  => 'popdown-menu-middle',
							'container'       => false, 
							'menu_class'      => 'second nav ga-nav',
							'depth'           => 1 
						) ); ?>
					</div>
				</div>
				<div class="row">
					<div class="span9 offset2 menu-bottom">
						<p>What's Hot on Makezine.com:</p>
						<?php wp_nav_menu( array(
							'theme_location'  => 'popdown-menu-last',
							'container'       => false, 
							'menu_class'      => 'last nav ga-nav',
							'depth'           => 1 
						) ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-button">
			<span class="popdown-btn"></span>
		</div>
	</div>
<?php }


/**
 * Remove unncessary meta boxes from Authors
 * @return void
 */
function make_remove_metaboxes_for_authors() {
	// Remove the following metaboxes for authors and below
	if ( ! current_user_can( 'delete_others_pages' ) ) {

		// Remove Edit Flow Editorial Metadata
		remove_meta_box( 'ef_editorial_meta', 'post', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'projects', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'magazine', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'review', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'video', 'side' );

		// Remove Edit Flot Editorial Comments
		remove_meta_box( 'edit-flow-editorial-comments', 'post', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'projects', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'magazine', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'review', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'craft', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'video', 'normal' );
		
		// Remove Edit Flow Notifications
		remove_meta_box( 'edit-flow-notifications', 'post', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'projects', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'magazine', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'review', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'video', 'advanced' );

		// Remove Featured Image
		remove_meta_box( 'postimagediv', 'post', 'side' );
		remove_meta_box( 'postimagediv', 'projects', 'side' );
		remove_meta_box( 'postimagediv', 'magazine', 'side' );
		remove_meta_box( 'postimagediv', 'review', 'side' );
		remove_meta_box( 'postimagediv', 'craft', 'side' );

		// Remove Makers Taxonomy
		remove_meta_box( 'tagsdiv-maker', 'post', 'side' );
		remove_meta_box( 'tagsdiv-maker', 'projects', 'side' );
		remove_meta_box( 'tagsdiv-maker', 'magazine', 'side' );
		remove_meta_box( 'tagsdiv-maker', 'review', 'side' );
		remove_meta_box( 'tagsdiv-maker', 'craft', 'side' );
		remove_meta_box( 'tagsdiv-maker', 'video', 'side' );

		// Remove Makers Location Taxonomy
		remove_meta_box( 'tagsdiv-location', 'post', 'side' );
		remove_meta_box( 'tagsdiv-location', 'projects', 'side' );
		remove_meta_box( 'tagsdiv-location', 'magazine', 'side' );
		remove_meta_box( 'tagsdiv-location', 'review', 'side' );
		remove_meta_box( 'tagsdiv-location', 'craft', 'side' );
		remove_meta_box( 'tagsdiv-location', 'video', 'side' );

		// Remove Primary Section Taxonomy
		remove_meta_box( 'mob_section_primary_term_div', 'post', 'side' );
		remove_meta_box( 'mob_section_primary_term_div', 'projects', 'side' );
		remove_meta_box( 'mob_section_primary_term_div', 'magazine', 'side' );
		remove_meta_box( 'mob_section_primary_term_div', 'review', 'side' );

		// Remove Primary Type Taxonomy
		remove_meta_box( 'mob_types_primary_term_div', 'post', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'projects', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'magazine', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'review', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'craft', 'side' );

		// Remove Primary Flag
		remove_meta_box( 'mob_flags_primary_term_div', 'projects', 'side' );

		// Remove Primary Difficulty
		remove_meta_box( 'mob_difficulty_primary_term_div', 'projects', 'side' );
		remove_meta_box( 'mob_difficulty_primary_term_div', 'video', 'side' );

		// Remove Primary Playlist
		remove_meta_box( 'mob_playlist_primary_term_div', 'video', 'side' );

		// Remove Flags Taxonomy
		remove_meta_box( 'flagsdiv', 'projects', 'side' );

		// Remove Magazine Meta
		remove_meta_box( 'magazine_meta', 'post', 'side' );
		remove_meta_box( 'magazine_meta', 'projects', 'side' );
		remove_meta_box( 'magazine_meta', 'magazine', 'side' );
		remove_meta_box( 'magazine_meta', 'review', 'side' );

		// Remove Projects Meta
		remove_meta_box( 'advanced_testgroup', 'projects', 'advanced' );

		// Remove Tools Taxonomy
		remove_meta_box( 'tagsdiv-tools', 'projects', 'side' );

		// Remove Parts Taxonomy
		remove_meta_box( 'tagsdiv-parts', 'projects', 'side' );

	}
}
add_action( 'do_meta_boxes', 'make_remove_metaboxes_for_authors' );


/**
 * Hide post types we don't want to show to authors
 * @return void
 */
function make_remove_admin_areas_for_authors() {
	// Remove the following metaboxes for authors and below
	if ( ! current_user_can( 'delete_others_pages' ) ) {
		remove_menu_page( 'edit.php?post_type=newsletter' );
	}
}
add_action( 'admin_menu', 'make_remove_admin_areas_for_authors' );

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
 * Simple boolean function to test if we are on a category page, and if that page has a parent.
 */
function make_is_parent_page() {
	if ( is_category() ) {
		$obj = get_queried_object();
		if ( $obj->parent == 0 ) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
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
			<p><?php if ( function_exists('vip_powered_wpcom') ) { echo vip_powered_wpcom(4); } ?></p>
		</div>
	</div>
<?php } 
