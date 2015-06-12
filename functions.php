<?php 

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