<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Wellington Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Custom Colors Class
 */
class Wellington_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'wellington_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );

	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Wellington_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Wellington_Pro_Customizer::get_default_options();

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {

			$custom_css .= '
				/* Link and Button Color Setting */
				a:link,
				a:visited {
					color: ' . $theme_options['link_color'] . ';
				}

				a:hover,
				a:focus,
				a:active {
					color: #303030;
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.more-link,
				.entry-categories .meta-categories a,
				.widget_tag_cloud .tagcloud a:hover,
				.widget_tag_cloud .tagcloud a:active,
				.entry-tags .meta-tags a:hover,
				.entry-tags .meta-tags a:active,
				.pagination a:hover,
				.pagination a:active,
				.pagination .current,
				.infinite-scroll #infinite-handle span:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab,
				.tzwb-social-icons .social-icons-menu li a:link,
				.tzwb-social-icons .social-icons-menu li a:visited {
					color: #fff;
					background: ' . $theme_options['link_color'] . ';
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.more-link:hover,
				.more-link:active,
				.tzwb-social-icons .social-icons-menu li a:active,
				.tzwb-social-icons .social-icons-menu li a:hover {
					background: #303030;
				}
			';
		}

		// Set Top Navigation Color.
		if ( $theme_options['top_navi_color'] !== $default_options['top_navi_color'] ) {

			$custom_css .= '
				/* Top Navigation Color Setting */
				.header-bar-wrap,
				.top-navigation-menu ul {
					background: ' . $theme_options['top_navi_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['top_navi_color'] ) ) {
				$custom_css .= '
					.header-bar-wrap,
					.top-navigation-menu,
					.top-navigation-menu a,
					.top-navigation-menu ul,
					.top-navigation-menu ul a,
					.top-navigation-menu ul li:last-child a {
						border-color: rgba(255,255,255,0.1);
					}

					.top-navigation-menu a:link,
					.top-navigation-menu a:visited,
					.top-navigation-toggle,
					.top-navigation-toggle:focus,
					.top-navigation-menu .submenu-dropdown-toggle,
					.header-bar .social-icons-menu li a:link,
					.header-bar .social-icons-menu li a:visited {
					    color: #ffffff;
					}

					.top-navigation-menu a:hover,
					.top-navigation-menu a:active,
					.top-navigation-toggle:hover,
					.top-navigation-toggle:active,
					.top-navigation-menu .submenu-dropdown-toggle:hover,
					.top-navigation-menu .submenu-dropdown-toggle:active,
					.header-bar .social-icons-menu li a:hover,
					.header-bar .social-icons-menu li a:active {
						color: rgba(255,255,255,0.5);
					}

					.top-navigation-menu li.current-menu-item > a {
						background: rgba(255,255,255,0.075);
					}
				';
			}
		}

		// Set Main Navigation Color.
		if ( $theme_options['navi_color'] !== $default_options['navi_color'] ) {

			$custom_css .= '
				/* Main Navigation Color Setting */
				.primary-navigation-wrap,
				.main-navigation-menu ul {
					background: ' . $theme_options['navi_color'] . ';
				}
			';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['navi_color'] ) ) {
				$custom_css .= '
					.main-navigation-menu,
					.main-navigation-menu a,
					.main-navigation-menu ul,
					.main-navigation-menu ul a,
					.main-navigation-menu ul li:last-child a {
						border-color: rgba(0,0,0,0.15);
					}

					.main-navigation-menu a:link,
					.main-navigation-menu a:visited,
					.main-navigation-toggle,
					.main-navigation-toggle:focus,
					.main-navigation-menu .submenu-dropdown-toggle {
					    color: #111111;
					}

					.main-navigation-menu a:hover,
					.main-navigation-menu a:active,
					.main-navigation-toggle:hover,
					.main-navigation-toggle:active,
					.main-navigation-menu .submenu-dropdown-toggle:hover,
					.main-navigation-menu .submenu-dropdown-toggle:active {
						color: rgba(0,0,0,0.5);
					}

					.main-navigation-menu li.current-menu-item > a {
						background: rgba(0,0,0,0.05);
					}
				';
			}
		}

		// Set Title Color.
		if ( $theme_options['title_color'] != $default_options['title_color'] ) {

			$custom_css .= '
				/* Post Titles Primary Color Setting */
				.site-title,
				.site-title a:link,
				.site-title a:visited,
				.page-title,
				.entry-title,
				.entry-title a:link,
				.entry-title a:visited,
				.post-slider-controls .zeeflex-direction-nav a:link,
				.post-slider-controls .zeeflex-direction-nav a:visited {
					color: ' . $theme_options['title_color'] . ';
				}

				.site-title a:hover,
				.site-title a:active,
				.widget-title a:hover,
				.widget-title a:active,
				.entry-title a:hover,
				.entry-title a:active,
				.post-slider-controls .zeeflex-direction-nav a:hover,
				.post-slider-controls .zeeflex-direction-nav a:active {
					color: #ee3333;
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.more-link:hover,
				.more-link:active,
				.pagination a:link,
				.pagination a:visited,
				.infinite-scroll #infinite-handle span,
				.tzwb-social-icons .social-icons-menu li a:active,
				.tzwb-social-icons .social-icons-menu li a:hover {
					background: ' . $theme_options['title_color'] . ';
				}
			';
		}

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] !== $default_options['widget_title_color'] ) {

			$custom_css .= '
				/* Widget Titles Color Setting */
				.widget-title,
				.widget-title a:link,
				.widget-title a:visited,
				.archive-title,
				.comments-header .comments-title,
				.comment-reply-title span {
					color: ' . $theme_options['widget_title_color'] . ';
				}
			';
		}

		// Set Title Hover Color (= Link and Buttons color)
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {

			$custom_css .= '
				/* Title Hover Color Setting */
				.site-title a:hover,
				.site-title a:active,
				.widget-title a:hover,
				.widget-title a:active,
				.entry-title a:hover,
				.entry-title a:active,
				.post-slider-controls .zeeflex-direction-nav a:hover,
				.post-slider-controls .zeeflex-direction-nav a:active {
					color: ' . $theme_options['link_color'] . ';
				}

				.pagination a:hover,
				.pagination a:active,
				.infinite-scroll #infinite-handle span:hover {
					background: ' . $theme_options['link_color'] . ';
				}
			';
		}

		// Set Footer Widgets Color.
		if ( $theme_options['footer_widgets_color'] != $default_options['footer_widgets_color'] ) {

			$custom_css .= '
				.footer-widgets-background {
					background: ' . $theme_options['footer_widgets_color'] . ';
				}
				';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['footer_widgets_color'] ) ) {
				$custom_css .= '
					.footer-widgets .widget,
					.footer-widgets .widget-title,
					.footer-widgets .widget-title a:link,
					.footer-widgets .widget-title a:visited,
					.footer-widgets .widget a:link,
					.footer-widgets .widget a:visited  {
						color: #111111;
					}

					.footer-widgets .widget-title a:hover,
					.footer-widgets .widget-title a:active,
					.footer-widgets .widget a:hover,
					.footer-widgets .widget a:active {
						color: rgba(0,0,0,0.5);
					}
				';
			}
		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] != $default_options['footer_color'] ) {

			$custom_css .= '
				.footer-wrap {
					background: ' . $theme_options['footer_color'] . ';
				}
				';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$custom_css .= '
					.site-footer,
					.site-footer .site-info,
					.site-footer .site-info a:link,
					.site-footer .site-info a:visited,
					.footer-navigation-menu a:link,
					.footer-navigation-menu a:visited {
						color: #111111;
					}
					.site-footer .site-info a:hover,
					.site-footer .site-info a:active,
					.footer-navigation-menu a:hover,
					.footer-navigation-menu a:active {
						color: rgba(0,0,0,0.5);
					}
				';
			}
		}

		return $custom_css;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'wellington_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'wellington-pro' ),
			'priority' => 60,
			'panel' => 'wellington_options_panel',
			)
		);

		// Get Default Colors from settings.
		$default_options = Wellington_Pro_Customizer::get_default_options();

		// Add Top Navigation Color setting.
		$wp_customize->add_setting( 'wellington_theme_options[top_navi_color]', array(
			'default'           => $default_options['top_navi_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wellington_theme_options[top_navi_color]', array(
				'label'      => _x( 'Top Navigation', 'color setting', 'wellington-pro' ),
				'section'    => 'wellington_pro_section_colors',
				'settings'   => 'wellington_theme_options[top_navi_color]',
				'priority' => 10,
			)
		) );

		// Add Navigation Primary Color setting.
		$wp_customize->add_setting( 'wellington_theme_options[navi_color]', array(
			'default'           => $default_options['navi_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wellington_theme_options[navi_color]', array(
				'label'      => _x( 'Main Navigation', 'color setting', 'wellington-pro' ),
				'section'    => 'wellington_pro_section_colors',
				'settings'   => 'wellington_theme_options[navi_color]',
				'priority' => 20,
			)
		) );

		// Add Link and Button Color setting.
		$wp_customize->add_setting( 'wellington_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wellington_theme_options[link_color]', array(
				'label'      => _x( 'Links and Buttons', 'color setting', 'wellington-pro' ),
				'section'    => 'wellington_pro_section_colors',
				'settings'   => 'wellington_theme_options[link_color]',
				'priority' => 30,
			)
		) );

		// Add Navigation Secondary Color setting.
		$wp_customize->add_setting( 'wellington_theme_options[title_color]', array(
			'default'           => $default_options['title_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wellington_theme_options[title_color]', array(
				'label'      => _x( 'Post Titles', 'color setting', 'wellington-pro' ),
				'section'    => 'wellington_pro_section_colors',
				'settings'   => 'wellington_theme_options[title_color]',
				'priority' => 40,
			)
		) );

		// Add Widget Title Color setting.
		$wp_customize->add_setting( 'wellington_theme_options[widget_title_color]', array(
			'default'           => $default_options['widget_title_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wellington_theme_options[widget_title_color]', array(
				'label'      => _x( 'Widget Titles', 'color setting', 'wellington-pro' ),
				'section'    => 'wellington_pro_section_colors',
				'settings'   => 'wellington_theme_options[widget_title_color]',
				'priority' => 50,
			)
		) );

		// Add Footer Widget Color setting.
		$wp_customize->add_setting( 'wellington_theme_options[footer_widgets_color]', array(
			'default'           => $default_options['footer_widgets_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wellington_theme_options[footer_widgets_color]', array(
				'label'      => _x( 'Footer Widgets', 'color setting', 'wellington-pro' ),
				'section'    => 'wellington_pro_section_colors',
				'settings'   => 'wellington_theme_options[footer_widgets_color]',
				'priority' => 60,
			)
		) );

		// Add Footer Color setting.
		$wp_customize->add_setting( 'wellington_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'wellington_theme_options[footer_color]', array(
				'label'      => _x( 'Footer', 'color setting', 'wellington-pro' ),
				'section'    => 'wellington_pro_section_colors',
				'settings'   => 'wellington_theme_options[footer_color]',
				'priority' => 70,
			)
		) );
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
add_action( 'init', array( 'Wellington_Pro_Custom_Colors', 'setup' ) );
