
// This file contains common JavaScript that is loaded into every page.
// We want to register and enqueue these scripts with WordPress.

// Load Typekit
try{Typekit.load();}catch(e){}

// Sadly the Facebook Comment Box does not allow us to change the positioning
jQuery( document ).ready( function( $ ) {
	$( '.comment-list' ).appendTo( '#comments' );

	$('.collapse').collapse();

	// Load our Bootstrap Tab JS on the schedule page
	if ( $('.schedule-content').length >= 1 ) {

		// Run the Bootstrap tab functions
		$('#schedule li.active a').tab('show');
		$('#schedule a').click(function(e) {
			e.preventDefault();

			$(this).tab('show');
		});
		
	}
});