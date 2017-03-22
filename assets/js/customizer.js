/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Maxwell Pro
 */

( function( $ ) {

	/* Link & Button Color Option */
	wp.customize( 'maxwell_theme_options[link_color]', function( value ) {
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

	/* Title Color Option */
	wp.customize( 'maxwell_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title, .site-title a:link, .site-title a:visited, .page-title, .entry-title, .entry-title a:link, .entry-title a:visited' )
				.css( 'color', newval );
		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'maxwell_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.widget-title, .widget-title a:link, .widget-title a:visited, .archive-title, .comments-header .comments-title, .comment-reply-title span' )
				.css( 'color', newval );
		} );
	} );

	/* Theme Fonts */
	wp.customize( 'maxwell_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='maxwell-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#maxwell-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#maxwell-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( 'body, button, input, select, textarea' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'maxwell_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='maxwell-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#maxwell-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#maxwell-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.site-title, .page-title, .entry-title' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'maxwell_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='maxwell-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#maxwell-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#maxwell-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.top-navigation-menu a, .main-navigation-menu a, .footer-navigation-menu a' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'maxwell_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='maxwell-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#maxwell-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#maxwell-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.widget-title, .archive-title, .comments-header .comments-title, .comment-reply-title span' )
				.css( 'font-family', newval );

		} );
	} );

} )( jQuery );
