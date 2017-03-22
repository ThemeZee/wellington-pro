<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Maxwell Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Custom Colors Class
 */
class Maxwell_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Maxwell Theme is not active.
		if ( ! current_theme_supports( 'maxwell-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'maxwell_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

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
		$theme_options = Maxwell_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Maxwell_Pro_Customizer::get_default_options();

		// Set Link Color.
		if ( $theme_options['link_color'] != $default_options['link_color'] ) {

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
		if ( $theme_options['top_navi_color'] != $default_options['top_navi_color'] ) {

			$custom_css .= '
				/* Top Navigation Color Setting */
				@media only screen and (min-width: 60.001em) {

					.top-navigation-menu ul {
						background: ' . $theme_options['top_navi_color'] . ';
					}

				}

				@media only screen and (max-width: 60em) {

					.top-navigation-toggle,
					.top-navigation-toggle:after {
						color: ' . $theme_options['top_navi_color'] . ';
					}

					.top-navigation-menu,
					.top-navigation-menu ul {
						background: ' . $theme_options['top_navi_color'] . ';
					}

				}
				';

		}

		// Set Primary Navigation Color.
		if ( $theme_options['navi_color'] != $default_options['navi_color'] ) {

			$custom_css .= '
				/* Main Navigation Color Setting */
				@media only screen and (min-width: 60.001em) {

					.main-navigation-menu ul {
						background: ' . $theme_options['navi_color'] . ';
					}

					.main-navigation-menu li.current-menu-item > a {
						border-color: ' . $theme_options['navi_color'] . ';
					}

				}

				@media only screen and (max-width: 60em) {

					.main-navigation-toggle {
						border-top: 0.3em solid ' . $theme_options['navi_color'] . ';
					}

					.main-navigation-menu,
					.main-navigation-menu ul {
						background: ' . $theme_options['navi_color'] . ';
					}

				}
				';

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
				.entry-title a:visited {
					color: ' . $theme_options['title_color'] . ';
				}
				';

		}

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] != $default_options['widget_title_color'] ) {

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

		return $custom_css;

	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'maxwell_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'maxwell-pro' ),
			'priority' => 60,
			'panel' => 'maxwell_options_panel',
			)
		);

		// Get Default Colors from settings.
		$default_options = Maxwell_Pro_Customizer::get_default_options();

		// Add Link and Button Color setting.
		$wp_customize->add_setting( 'maxwell_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'maxwell_theme_options[link_color]', array(
				'label'      => _x( 'Links and Buttons', 'color setting', 'maxwell-pro' ),
				'section'    => 'maxwell_pro_section_colors',
				'settings'   => 'maxwell_theme_options[link_color]',
				'priority' => 10,
			)
		) );

		// Add Top Navigation Color setting.
		$wp_customize->add_setting( 'maxwell_theme_options[top_navi_color]', array(
			'default'           => $default_options['top_navi_color'],
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'maxwell_theme_options[top_navi_color]', array(
				'label'      => _x( 'Top Navigation', 'color setting', 'maxwell-pro' ),
				'section'    => 'maxwell_pro_section_colors',
				'settings'   => 'maxwell_theme_options[top_navi_color]',
				'priority' => 20,
			)
		) );

		// Add Navigation Primary Color setting.
		$wp_customize->add_setting( 'maxwell_theme_options[navi_color]', array(
			'default'           => $default_options['navi_color'],
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'maxwell_theme_options[navi_color]', array(
				'label'      => _x( 'Main Navigation', 'color setting', 'maxwell-pro' ),
				'section'    => 'maxwell_pro_section_colors',
				'settings'   => 'maxwell_theme_options[navi_color]',
				'priority' => 30,
			)
		) );

		// Add Navigation Secondary Color setting.
		$wp_customize->add_setting( 'maxwell_theme_options[title_color]', array(
			'default'           => $default_options['title_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'maxwell_theme_options[title_color]', array(
				'label'      => _x( 'Post Titles', 'color setting', 'maxwell-pro' ),
				'section'    => 'maxwell_pro_section_colors',
				'settings'   => 'maxwell_theme_options[title_color]',
				'priority' => 40,
			)
		) );

		// Add Widget Title Color setting.
		$wp_customize->add_setting( 'maxwell_theme_options[widget_title_color]', array(
			'default'           => $default_options['widget_title_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'maxwell_theme_options[widget_title_color]', array(
				'label'      => _x( 'Widget Titles', 'color setting', 'maxwell-pro' ),
				'section'    => 'maxwell_pro_section_colors',
				'settings'   => 'maxwell_theme_options[widget_title_color]',
				'priority' => 50,
			)
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Maxwell_Pro_Custom_Colors', 'setup' ) );
