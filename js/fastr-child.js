// see http://codex.wordpress.org/Function_Reference/wp_enqueue_script#jQuery_noConflict_Wrappers
jQuery( document ).ready( function( $ ) {

	$( '#top-strip a[href="#"]' ).click( function( evt ) {
		if ( ! $( this ).hasClass( 'back-to-top' ) ) {
			evt.preventDefault();
		}
	} );

	// Smooth scroll the 'back to top' link
	$( 'a.back-to-top' ).click( function( evt ) {
		$( 'html, body' ).animate( {
			scrollTop: 0
		}, 300 );
		evt.preventDefault();
	} );

	$( '#menu-toggle, #sidebar-cover' ).click( function() {
		// TODO: Animation on toggle-off
		$( '#menu-toggle' ).toggleClass( 'toggled-on' );
	} );

	$( '#top-strip nav li' ).click( function( evt ) {
		$( this ).children( 'ul' ).toggleClass( 'shown-mobile' );

		$( this ).siblings( 'li' ).each( function() {
			$( this ).children( 'ul' ).removeClass( 'shown-mobile' );
		} );

		// so that upper-level LI's don't receive the event
		evt.stopPropagation();
	} );

	$( '.search-form input[type=submit]' ).click( function( evt ) {
		var $search = $( this ).parents( '.search-form' ).find( 'input[type=search]' );
		if ( $search.hasClass( 'collapsed' ) ) {
			$search.removeClass( 'collapsed' ).focus();
		}
		if ( ! $search.val() ) {
			evt.preventDefault(); // no search if input is blank
		}
	} );

	$( '#top-strip .search-form input[type=search]' ).blur( function( evt ) {
		if ( ! $( this ).val() ) {
			$( this ).addClass( 'collapsed' );
		}
	} );

	$( document ).keydown( function( evt ) {
		evt = evt || window.event;
		if ( evt.keyCode == 27 && $( '#menu-toggle' ).hasClass( 'toggled-on' ) ) { // ESC
			$( '#menu-toggle' ).removeClass( 'toggled-on' );
		}
	} );

	
	var lastScrollTop = 0;
	var tolerance = 10;
	$( window ).scroll( function() {
		var st = $( this ).scrollTop();
		if ( Math.abs( st - lastScrollTop ) <= tolerance ) {
			return;
		}

		// If we are close to the top then snap the header to the top
		if ( st < tolerance && ( $( '#top-strip' ).hasClass( 'nav-down' ) || $( '#top-strip' ).hasClass( 'nav-up' ) ) ) {
			$( '#top-strip' ).removeClass( 'nav-down nav-up' );
		}
		// If they scrolled down and are past the navbar, add class .nav-up.
		// This is necessary so you never see what is "behind" the navbar.
		else if ( st > lastScrollTop && st > $( '#top-strip' ).height() ) {
			// Scroll Down
			$( '#top-strip' ).removeClass( 'nav-down' ).addClass( 'nav-up' );
		}
		else if ( st + $( this ).height() < $( document ).height() ) {
			// Scroll up
			$( '#top-strip' ).removeClass( 'nav-up' ).addClass( 'nav-down' );
		}
		lastScrollTop = st;
	} );

	/*
	// Parallax scrolling
	$( window ).scroll( function( evt ) {
		if ( ! $( 'body' ).hasClass( 'home' ) && ( $( 'body' ).hasClass( 'single' ) || $( 'body' ).hasClass( 'page' ) ) ) {
			var scrollPosition = $( this ).scrollTop();
			var headerHeight = parseInt( $( '.site-header' ).height(), 10 );
			var bgx = $( '.site-header' ).css( 'background-position' ).split( ' ' )[0].trim();
			$( '.site-header' ).css( 'background-position', bgx + ' ' + ( 50 - ( scrollPosition / 16 ) + '%' ) );
			$( '.site-header .container' ).css( 'opacity', 1 - (scrollPosition / headerHeight ) );
		}
	} );
	*/
} );
