<?php 

require_once( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' );
include_once dirname( __FILE__ ) . '/includes/theme_stuff.php';

// 31. Maker Camp
include_once dirname( __FILE__ ) . '/includes/maker-camp.php';


// 37. Maker Camp Map
include_once dirname( __FILE__ ) . '/includes/google-maps.php';


/**
 * Get a volume cover image
 */
function make_get_cover_image( $number = 37 ) {
	$url = esc_url( 'http://cdn.makezine.com/make/covers/MAKE_V' . absint( $number ) . '_high.jpg' );
	return $url;
}

function make_get_cap_option( $option_name ) {
	return cheezcap_get_option( $option_name );
}

?>