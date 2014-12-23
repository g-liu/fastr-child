// see http://codex.wordpress.org/Function_Reference/wp_enqueue_script#jQuery_noConflict_Wrappers
jQuery( document ).ready( function( $ ) {
	$( '#menu-toggle, #sidebar-cover' ).click( function() {
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
		if ( evt.keyCode == 27 ) { // ESC
			$( '#menu-toggle' ).removeClass( 'toggled-on' );
		}
	} );
} );
