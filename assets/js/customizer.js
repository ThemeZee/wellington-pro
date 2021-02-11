/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Wellington Pro
 */

( function( $ ) {

	/* Header Search checkbox */
	wp.customize( 'wellington_theme_options[header_search]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.primary-navigation-wrap .header-search' );
			} else {
				showElement( '.primary-navigation-wrap .header-search' );
			}
		} );
	} );

	/* Author Bio checkbox */
	wp.customize( 'wellington_theme_options[author_bio]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.type-post .entry-footer .entry-author' );
			} else {
				showElement( '.type-post .entry-footer .entry-author' );
			}
		} );
	} );

	/* Link & Button Color Option */
	wp.customize( 'wellington_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {

			var title_color = '#303030',
				widget_title_color = '#303030';

			if( typeof wp.customize.value( 'wellington_theme_options[title_color]' ) !== 'undefined' ) {
				title_color = wp.customize.value( 'wellington_theme_options[title_color]' ).get();
			}

			if( typeof wp.customize.value( 'wellington_theme_options[widget_title_color]' ) !== 'undefined' ) {
				widget_title_color = wp.customize.value( 'wellington_theme_options[widget_title_color]' ).get();
			}

			$( '.entry-content a:link, .entry-content a:visited, .widget a:link, .widget a:visited, .post-navigation a:link, .post-navigation a:visited, .comments-area a:link, .comments-area a:visited, .breadcrumbs a:link, .breadcrumbs a:visited' )
				.not( $('.footer-widgets .widget a, .tzwb-tabbed-content .tzwb-tabnavi li a, .widget-magazine-posts a, .widget_tag_cloud .tagcloud a') )
				.css( 'color', newval );
			$( '.entry-content a, .post-navigation a, .comments-area a, .breadcrumbs a, .widget a' )
				.not( $('.footer-widgets .widget a, .tzwb-tabbed-content .tzwb-tabnavi li a, .widget-magazine-posts a, .widget_tag_cloud .tagcloud a') )
				.hover( function() { $( this ).css( 'color', '#303030' ); },
					function() { $( this ).css( 'color', newval ); }
				);
			$( '.site-title a, .entry-title a, .post-slider-controls .zeeflex-direction-nav a' )
				.hover( function() { $( this ).css( 'color', newval ); },
					function() { $( this ).css( 'color', title_color ); }
				);
			$( '.widget-title a' )
				.hover( function() { $( this ).css( 'color', newval ); },
					function() { $( this ).css( 'color', widget_title_color ); }
				);

			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .entry-categories .meta-categories a, .pagination .current, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab, .tzwb-social-icons .social-icons-menu li a:link, .tzwb-social-icons .social-icons-menu li a:visited' )
				.css( 'color', '#ffffff' )
				.css( 'background', newval );
			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .tzwb-social-icons .social-icons-menu li a' )
				.hover( function() { $( this ).css( 'background', title_color ).css( 'color', '#ffffff' ); },
					function() { $( this ).css( 'background', newval ).css( 'color', '#ffffff' ); }
				);
			$( '.pagination a, .infinite-scroll #infinite-handle span' )
				.hover( function() { $( this ).css( 'background', newval ); },
					function() { $( this ).css( 'background', title_color ); }
				);
			$( '.widget_tag_cloud .tagcloud a, .entry-tags .meta-tags a' )
				.hover( function() { $( this ).css( 'background', newval ); },
					function() { $( this ).css( 'background', '#dddddd' ); }
				);
			$( '.entry-categories .meta-categories a' )
				.hover( function() { $( this ).css( 'background', '#dddddd' ); },
					function() { $( this ).css( 'background', newval ); }
				);
			$( '.tzwb-tabbed-content .tzwb-tabnavi li a' )
				.hover( function() { $( this ).css( 'background', newval ); },
					function() { $( this ).css( 'background', '#303030' ); }
				);

			$( '.has-primary-color' ).css( 'color', newval );
			$( '.has-primary-background-color' ).css( 'background-color', newval );
		} );
	} );

	/* Top Navigation Color Option */
	wp.customize( 'wellington_theme_options[top_navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.header-bar-wrap, .top-navigation ul ul' )
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

			$( '.top-navigation ul a, .secondary-menu-toggle, .header-bar .social-icons-menu li a' )
				.css( 'color', textcolor );
			$( '.top-navigation ul a, .secondary-menu-toggle, .header-bar .social-icons-menu li a' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
			$( '.secondary-menu-toggle .icon, .top-navigation .dropdown-toggle .icon, .top-navigation ul .menu-item-has-children > a > .icon' )
				.css( 'fill', textcolor );
			$( '.secondary-menu-toggle, .top-navigation .dropdown-toggle, .top-navigation ul .menu-item-has-children > a' )
				.hover( function() { $( this ).find('.icon').css( 'fill', hovercolor ); },
						function() { $( this ).find('.icon').css( 'fill', textcolor ); }
				);
			$( '.top-navigation ul li.current-menu-item > a' )
				.css( 'background-color', bgcolor );
			$( '.header-bar-wrap, .top-navigation ul, .top-navigation ul a, .top-navigation ul ul, .top-navigation ul ul a, .top-navigation ul ul li:last-child a' )
				.css( 'border-color', bordercolor );
		} );
	} );

	/* Main Navigation Color Option */
	wp.customize( 'wellington_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.primary-navigation-wrap, .main-navigation ul ul' )
				.css( 'background', newval );

			var textcolor, hovercolor, bgcolor, bordercolor;

			if( isColorLight( newval ) ) {
				textcolor = '#111111';
				hovercolor = 'rgba(0,0,0,0.5)';
				bgcolor = 'rgba(0,0,0,0.05)';
				bordercolor = 'rgba(0,0,0,0.15)';
			} else {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
				bgcolor = 'rgba(255,255,255,0.075)';
				bordercolor = 'rgba(255,255,255,0.1)';
			}

			$( '.main-navigation ul a, .primary-menu-toggle, .header-search .header-search-icon' )
				.css( 'color', textcolor );
			$( '.main-navigation ul a, .primary-menu-toggle, .header-search .header-search-icon' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
			$( '.primary-menu-toggle .icon, .main-navigation .dropdown-toggle .icon, .main-navigation ul .menu-item-has-children > a > .icon' )
				.css( 'fill', textcolor );
			$( '.primary-menu-toggle, .main-navigation .dropdown-toggle, .main-navigation ul .menu-item-has-children > a' )
				.hover( function() { $( this ).find('.icon').css( 'fill', hovercolor ); },
						function() { $( this ).find('.icon').css( 'fill', textcolor ); }
				);
			$( '.main-navigation ul li.current-menu-item > a, .header-search .header-search-icon' )
				.css( 'background-color', bgcolor );
			$( '.main-navigation ul, .main-navigation ul a, .main-navigation ul ul, .main-navigation ul ul a, .main-navigation ul ul li:last-child a' )
				.css( 'border-color', bordercolor );
		} );
	} );

	/* Title Color Option */
	wp.customize( 'wellington_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {

			var link_color = '#ee3333';

			if( typeof wp.customize.value( 'wellington_theme_options[link_color]' ) !== 'undefined' ) {
				link_color = wp.customize.value( 'wellington_theme_options[link_color]' ).get();
			}

			$( '.site-title, .site-title a:link, .site-title a:visited, .page-title, .entry-title, .entry-title a:link, .entry-title a:visited' )
				.css( 'color', newval );
			$( '.site-title a, .entry-title a' )
				.hover( function() { $( this ).css( 'color', link_color ); },
						function() { $( this ).css( 'color', newval ); }
				);

			$( '.pagination a, .infinite-scroll #infinite-handle span' )
				.css( 'background', newval );
			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .tzwb-social-icons .social-icons-menu li a' )
				.hover( function() { $( this ).css( 'background', newval ).css( 'color', '#ffffff' ); },
					function() { $( this ).css( 'background', link_color ).css( 'color', '#ffffff' ); }
				);
			$( '.pagination a, .infinite-scroll #infinite-handle span' )
				.hover( function() { $( this ).css( 'background', link_color ); },
					function() { $( this ).css( 'background', newval ); }
				);

		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'wellington_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {

			var link_color = '#ee3333';

			if( typeof wp.customize.value( 'wellington_theme_options[link_color]' ) !== 'undefined' ) {
				link_color = wp.customize.value( 'wellington_theme_options[link_color]' ).get();
			}

			$( '.widget-title, .widget-title a:link, .widget-title a:visited, .archive-title, .comments-header .comments-title, .comment-reply-title span' )
				.not( $('.footer-widgets .widget .widget-title, .footer-widgets .widget .widget-title a' ) )
				.css( 'color', newval );
			$( '.widget-title a' )
				.not( $('.footer-widgets .widget .widget-title, .footer-widgets .widget .widget-title a' ) )
				.hover( function() { $( this ).css( 'color', link_color ); },
						function() { $( this ).css( 'color', newval ); }
				);
		} );
	} );

	/* Footer Widgets Color Option */
	wp.customize( 'wellington_theme_options[footer_widgets_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-widgets-background' )
				.css( 'background', newval );

			var textcolor, hovercolor;

			if( isColorLight( newval ) ) {
				textcolor = '#111111';
				hovercolor = 'rgba(0,0,0,0.5)';
			} else {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
			}

			$( '.footer-widgets .widget, .footer-widgets .widget-title, .footer-widgets .widget a' )
				.css( 'color', textcolor );
			$( '.footer-widgets .widget-title a, .footer-widgets .widget a' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
		} );
	} );

	/* Footer Color Option */
	wp.customize( 'wellington_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-wrap' )
				.css( 'background', newval );

			var textcolor, hovercolor;

			if( isColorLight( newval ) ) {
				textcolor = '#111111';
				hovercolor = 'rgba(0,0,0,0.5)';
			} else {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
			}

			$( '.site-footer, .site-footer .site-info, .site-footer .site-info a, .footer-navigation-menu a' )
				.css( 'color', textcolor );
			$( '.site-footer .site-info a, .footer-navigation-menu a' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
		} );
	} );

	/* Text Font */
	wp.customize( 'wellington_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'text-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--text-font', newFont );
		} );
	} );

	/* Title Font */
	wp.customize( 'wellington_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--title-font', newFont );
		} );
	} );

	/* Title Font Weight */
	wp.customize( 'wellington_theme_options[title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--title-font-weight', fontWeight );
		} );
	} );

	/* Title Text Transform */
	wp.customize( 'wellington_theme_options[title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--title-text-transform', textTransform );
		} );
	} );

	/* Navi Font */
	wp.customize( 'wellington_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'navi-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--navi-font', newFont );
		} );
	} );

	/* Navi Font Weight */
	wp.customize( 'wellington_theme_options[navi_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--navi-font-weight', fontWeight );
		} );
	} );

	/* Navi Text Transform */
	wp.customize( 'wellington_theme_options[navi_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--navi-text-transform', textTransform );
		} );
	} );

	/* Widget Title Font */
	wp.customize( 'wellington_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'widget-title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--widget-title-font', newFont );
		} );
	} );

	/* Widget Title Font Weight */
	wp.customize( 'wellington_theme_options[widget_title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--widget-title-font-weight', fontWeight );
		} );
	} );

	/* Widget Title Text Transform */
	wp.customize( 'wellington_theme_options[widget_title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--widget-title-text-transform', textTransform );
		} );
	} );

	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden'
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible'
		});
	}

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

	function loadCustomFont( font, type ) {
		var fontFile = font.split( " " ).join( "+" );
		var fontFileURL = "https://fonts.googleapis.com/css?family=" + fontFile + ":400,700";

		var fontStylesheet = "<link id='wellington-pro-custom-" + type + "' href='" + fontFileURL + "' rel='stylesheet' type='text/css'>";
		var checkLink = $( "head" ).find( "#wellington-pro-custom-" + type ).length;

		if (checkLink > 0) {
			$( "head" ).find( "#wellington-pro-custom-" + type ).remove();
		}
		$( "head" ).append( fontStylesheet );
	}

} )( jQuery );
