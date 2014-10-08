<?php 

// Load any VIP requirements
require_once( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' );

// Load our generic theme functions
include_once( 'includes/theme_stuff.php' );

// Load the Sessions post type
include_once( 'post-types/session.php' );

// Load the Schedule post type
include_once( 'post-types/schedule.php' );

// Load the Makers post type
include_once( 'post-types/maker.php' );

// Load our Camp taxonomy
include_once( 'taxonomies/camp.php' );

// Load our Week taxonomy
include_once( 'taxonomies/week.php' );

// Load Maker Camp functions
include_once( 'includes/maker-camp.php' );

// Load Maker Camp Map
include_once( 'includes/google-maps.php' );

// Bootstrap Walker
include_once( 'includes/bootstrap_walker.php' );

// Shortcodes
include_once( 'includes/home.php' );

// View Helpers
include_once('includes/schedule-helpers.php');

// Remove Jetpack CSS
function remove_jetpack_styles(){
wp_deregister_style('AtD_style'); // After the Deadline
wp_deregister_style('jetpack-carousel'); // Carousel
wp_deregister_style('grunion.css'); // Grunion contact form
wp_deregister_style('the-neverending-homepage'); // Infinite Scroll
wp_deregister_style('infinity-twentyten'); // Infinite Scroll - Twentyten Theme
wp_deregister_style('infinity-twentyeleven'); // Infinite Scroll - Twentyeleven Theme
wp_deregister_style('infinity-twentytwelve'); // Infinite Scroll - Twentytwelve Theme
wp_deregister_style('noticons'); // Notes
wp_deregister_style('post-by-email'); // Post by Email
wp_deregister_style('publicize'); // Publicize
wp_deregister_style('sharedaddy'); // Sharedaddy
wp_deregister_style('sharing'); // Sharedaddy Sharing
wp_deregister_style('stats_reports_css'); // Stats
wp_deregister_style('jetpack-widgets'); // Widgets
}
add_action('wp_print_styles', 'remove_jetpack_styles');
