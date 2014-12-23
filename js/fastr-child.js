// see http://codex.wordpress.org/Function_Reference/wp_enqueue_script#jQuery_noConflict_Wrappers
jQuery( document ).ready( function( $ ) {
	// Smooth scroll the 'back to top' link
	$( 'a.back-to-top' ).click( function( evt ) {
		$( 'html, body' ).animate( {
			scrollTop: 0
		}, 300 );
		evt.preventDefault();
	} );

	var mobileVisible = $( '#menu-toggle' );
	$( '#menu-toggle, #sidebar-cover' ).click( function() {
		// TODO: Animation on toggle-off
		$( '#menu-toggle' ).toggleClass( 'toggled-on' );
	} );

	$( '#top-strip nav li' ).click( function( evt ) {
		$( this ).children( 'ul' ).toggle();
		// close other "open" children
		console.log ( $( this ).siblings( 'li' ) );
		$( this ).siblings( 'li' ).each( function() {
			$( this ).children( 'ul' ).hide();
		} );

		// so that upper-level LI's don't receive the event
		evt.stopPropagation();
	} );

	$( document ).keydown( function( evt ) {
		evt = evt || window.event;
		if ( evt.keyCode == 27 && $( '#menu-toggle' ).hasClass( 'toggled-on' ) ) { // ESC
			$( '#menu-toggle' ).removeClass( 'toggled-on' );
		}
	} );
} );
