/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Wellington Pro
 */

( function( $ ) {

	/* Link & Button Color Option */
	wp.customize( 'wellington_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.entry-content a, .entry-content a:link, .entry-content a:visited, .widget a:link, .widget a:visited, .post-navigation a:link, .post-navigation a:visited, .comments-area a:link, .comments-area a:visited, .breadcrumbs a:link, .breadcrumbs a:visited' )
				.css( 'color', newval );
			$( '.entry-content a, .post-navigation a, .comments-area a, .breadcrumbs a, .widget a' )
				.hover( function() { $( this ).css( 'color', '#303030' ); },
					function() { $( this ).css( 'color', newval ); }
				);
			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .pagination .current, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab, .tzwb-social-icons .social-icons-menu li a:link, .tzwb-social-icons .social-icons-menu li a:visited' )
				.css( 'color', '#ffffff' )
				.css( 'background', newval );
			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .tzwb-social-icons .social-icons-menu li a' )
				.hover( function() { $( this ).css( 'background', '#303030' ).css( 'color', '#ffffff' ); },
					function() { $( this ).css( 'background', newval ).css( 'color', '#ffffff' ); }
				);
			$( '.widget_tag_cloud .tagcloud a, .entry-tags .meta-tags a, .pagination a, .infinite-scroll #infinite-handle span, .tzwb-tabbed-content .tzwb-tabnavi li a' )
				.hover( function() { $( this ).css( 'background', newval ); },
					function() { $( this ).css( 'background', '#303030' ); }
				);
		} );
	} );

	/* Top Navigation Color Option */
	wp.customize( 'wellington_theme_options[top_navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.header-bar-wrap, .top-navigation-menu ul' )
				.css( 'background', newval );

			var textcolor, hovercolor, bgcolor, bordercolor;

			if( isColorDark( newval ) ) {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
				bgcolor = 'rgba(255,255,255,0.075)';
				bordercolor = 'rgba(255,255,255,0.1)';
			} else {
				textcolor = '#111111';
				hovercolor = 'rgba(0,0,0,0.5)';
				bgcolor = 'rgba(0,0,0,0.05)';
				bordercolor = 'rgba(0,0,0,0.15)';
			}

			$( '.top-navigation-menu a, .top-navigation-toggle, .top-navigation-menu .submenu-dropdown-toggle, .header-bar .social-icons-menu li a' )
				.css( 'color', textcolor );
			$( '.top-navigation-menu a, .top-navigation-toggle, .top-navigation-menu .submenu-dropdown-toggle, .header-bar .social-icons-menu li a' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
			$( '.top-navigation-menu li.current-menu-item > a' )
				.css( 'background-color', bgcolor );
			$( '.header-bar-wrap, .top-navigation-menu, .top-navigation-menu a, .top-navigation-menu ul, .top-navigation-menu ul a, .top-navigation-menu ul li:last-child a' )
				.css( 'border-color', bordercolor );
		} );
	} );

	/* Title Color Option */
	wp.customize( 'wellington_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title, .site-title a:link, .site-title a:visited, .page-title, .entry-title, .entry-title a:link, .entry-title a:visited' )
				.css( 'color', newval );
		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'wellington_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.widget-title, .widget-title a:link, .widget-title a:visited, .archive-title, .comments-header .comments-title, .comment-reply-title span' )
				.css( 'color', newval );
		} );
	} );

	/* Theme Fonts */
	wp.customize( 'wellington_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='wellington-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#wellington-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#wellington-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( 'body, button, input, select, textarea' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'wellington_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='wellington-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#wellington-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#wellington-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.site-title, .page-title, .entry-title' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'wellington_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='wellington-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#wellington-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#wellington-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.top-navigation-menu a, .main-navigation-menu a' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'wellington_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='wellington-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#wellington-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#wellington-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.widget-title, .archive-title, .comments-header .comments-title, .comment-reply-title span' )
				.css( 'font-family', newval );

		} );
	} );

	function hexdec( hexString ) {
		hexString = ( hexString + '' ).replace( /[^a-f0-9]/gi, '' );
		return parseInt( hexString, 16 );
	}

	function getColorBrightness( hexColor ) {

		// Remove # string.
		hexColor = hexColor.replace( '#', '' );

		// Convert into RGB.
		var r = hexdec( hexColor.substring( 0, 2 ) );
		var g = hexdec( hexColor.substring( 2, 4 ) );
		var b = hexdec( hexColor.substring( 4, 6 ) );

		return ( ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000 );
	}

	function isColorLight( hexColor ) {
		return ( getColorBrightness( hexColor ) > 130 );
	}

	function isColorDark( hexColor ) {
		return ( getColorBrightness( hexColor ) <= 130 );
	}

} )( jQuery );
