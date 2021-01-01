/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

( function ( $ ) {
	var animationTime = 0;
	// Site title and description.
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( 'a.navbar-brand span' ).text( to );
		} );
	} );

	//Update Primary navbar color in real time...
	wp.customize( 'top_navbar_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.navbar-top' ).css( 'background', newval );
		} );
	} );

	wp.customize( 'top_navbar_padding', function ( value ) {
		value.bind( function ( newval ) {
			$( '.navbar-top' ).css( 'padding-top', newval + 'px' );
			$( '.navbar-top' ).css( 'padding-bottom', newval + 'px' );
			if( $( 'body' ).hasClass( 'fixed-navbar-top' ) ) {
				$( 'body' ).css( 'padding-top', $( '#site-navigation' ).outerHeight() );
			}
		} );
	} );
	//Update Side navbar color in real time...
	wp.customize( 'side_navbar_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.navbar-side' ).css( 'background', newval );
		} );
	} );

	//Update Secondary navbar color in real time...
	wp.customize( 'top_secondary_navbar_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.navbar-top-secondary' ).css( 'background', newval );
		} );
	} );

	wp.customize( 'top_secondary_navbar_padding', function ( value ) {
		value.bind( function ( newval ) {
			$( '.navbar-top-secondary' ).css( 'padding', newval );
		} );
	} );

	wp.customize( 'modular_design', function ( value ) {
		value.bind( function ( newval ) {
			$( 'body' ).toggleClass( "modular-design" );
		} );
	} );

	wp.customize( 'show_social_with_brand_colors', function ( value ) {
		value.bind( function ( newval ) {
			$( '.lyrico-brand-icons' ).toggleClass( "with-brand-colors" );
		} );
	} );

	wp.customize( 'header_background_template', function ( value ) {
		value.bind( function ( newval ) {
			var oldval = $( '.lyrico-site-header' ).data( 'template' );
			$( '.lyrico-site-header' ).removeClass( oldval );
			$( '.lyrico-site-header' ).addClass( "lyrico-gradient-" + newval );
			$( '.lyrico-site-header' ).data( 'template', "lyrico-gradient-" + newval );
		} );
	} );

	// Footer Color
	wp.customize( 'footer_background_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.site-footer-container' ).css( 'background', newval );
		} );
	} );
	// Modular BG Color
	wp.customize( 'module_background_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.lyrico-module, #secondary-div .widget, .lyrico-blog-post' ).css( 'background', newval );
		} );
	} );

	// Modular Header Color
	wp.customize( 'module_header_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.lyrico-module .module-header, #secondary-div .widget .widget-title, .lyrico-blog-post .card-title' ).css( 'color', newval );
		} );
	} );

	// Main Container Background Color
	wp.customize( 'content_text_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.main-container' ).css( 'color', newval );
		} );
	} );
	// Content Text Color
	wp.customize( 'main_container_background_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.main-container' ).css( 'background', newval );
		} );
	} );
	wp.customize( 'footer_text_color', function ( value ) {
		value.bind( function ( newval ) {
			$( '.site-footer-container' ).css( 'color', newval );
			$( '.widget-title > hr' ).css( 'border-top-color', newval );
			$( '.footer-hr' ).css( 'border-top-color', newval );
		} );
	} );

	textPreview( 'home_latest_lyrics_title', '.lyrico-module-wrapper#home-latest-lyrics h1' );
	textPreview( 'home_playlists_title', '.lyrico-module-wrapper#home-playlists h1' );
	textPreview( 'home_artists_title', '.lyrico-module-wrapper#home-artists h1' );
	textPreview( 'home_albums_title', '.lyrico-module-wrapper#home-albums h1' );
	textPreview( 'home_popular_lyrics_title', '.lyrico-module-wrapper#home-popular-lyrics h1' );
	textPreview( 'home_news_title', '.lyrico-module-wrapper#home-news h1' );

	textPreview( 'home_playlists_button_text', '.lyrico-module-wrapper#home-playlists .module-button a' );
	textPreview( 'home_artists_button_text', '.lyrico-module-wrapper#home-artists .module-button a' );
	textPreview( 'home_albums_button_text', '.lyrico-module-wrapper#home-albums .module-button a' );
	textPreview( 'home_news_button_text', '.lyrico-module-wrapper#home-news .module-button a' );

	textPreview( 'footer_copyright_text', '.footer-copyright-text' );

	function textPreview( setting_id, css_class ) {
		wp.customize( setting_id, function ( value ) {
			value.bind( function ( newval ) {
				$( css_class ).html( newval );
			} );
		} );
	}

} )( jQuery );