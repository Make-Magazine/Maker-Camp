jQuery( document ).ready( function( $ ) {

	$( '#add-new-week' ).click( function( e ) {
		e.preventDefault();

		$( this ).replaceWith( '<input type="text" id="week-name" placeholder="Enter the week name" /> <input type="submit" value="+ New Week" id="submit-week" class="button button-primary" />');
	});

	// Process the new week and saves it to the week taxonomy
	$( '#make-schedule' ).on( 'click', '#submit-week', function( e ) {
		e.preventDefault();

		var $this = $( this );
		var new_week = $this.prev().val();

		// Disable the fields to prevent unwanted changes
		$this.add( '#week-name' ).attr( 'disabled', 'disabled' );

		// Add our loading icon which is stored in WordPress core
		$this.after( '<img src="' + mexp.admin_url + '/images/wpspin_light.gif" alt="Saving Week" style="margin-left:10px;" id="saving-week-term" />' );

		// Let's save the data
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: {
				'action' : 'make_add_week', // Calls our wp_ajax_nopriv_make_ajax_login or wp_ajax_make_ajax_login actions
				'term_name'   : new_week,
				'nonce'  : make_schedule.schedule_nonce
			},
			success: function( results ) {
				// Check that everything went well
				if ( results.success ) {
					$( '#add-week-wrapper' ).find( '#message' ).remove();
					$( '#assign-week' ).append( '<option value="' + results.term.id + '">' + results.term.name + '</option>' ).val( results.term.id );
					$( '#add-week-wrapper' ).replaceWith( '<div id="message" class="updated"><p>' + results.message + '</p></div>' ).delay( 5000 ).slideUp();
				} else {
					$( '#add-week-wrapper' ).find( '#message' ).remove();
					$( '#submit-week, #week-name' ).removeAttr( 'disabled' );
					$( '#saving-week-term' ).remove();
					$( '#add-week-wrapper' ).append( '<div id="message" class="error"><p>' + results.message + '</p></div>' );
				}
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				console.log( 'ERROR' );
				console.log( textStatus );
				console.log( errorThrown );
			}
		});
	});
});
