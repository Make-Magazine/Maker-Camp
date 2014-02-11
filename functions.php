<?php 

// Load any VIP requirements
require_once( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' );

// Load our generic theme functions
include_once( 'includes/theme_stuff.php' );

// Load the Sessions post type
include_once( 'post-types/session.php' );

// Load the Makers post type
include_once( 'post-types/maker.php' );

// Load our taxnomies
include_once( 'taxonomies/camp.php' );

// Load Maker Camp functions
include_once( 'includes/maker-camp.php' );

// Load Maker Camp Map
include_once( 'includes/google-maps.php' );