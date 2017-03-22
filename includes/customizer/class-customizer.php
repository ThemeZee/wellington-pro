<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Maxwell Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Customizer Class
 */
class Maxwell_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Maxwell Theme is not active.
		if ( ! current_theme_supports( 'maxwell-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'maxwell_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		$theme_options = wp_parse_args( get_option( 'maxwell_theme_options', array() ), self::get_default_options() );

		// Return theme options.
		return $theme_options;

	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'header_logo' 						=> '',
			'header_spacing'					=> 30,
			'logo_spacing'						=> 0,
			'footer_text'						=> '',
			'credit_link' 						=> true,
			'top_navi_color'					=> '#303030',
			'link_color'						=> '#33bbcc',
			'navi_color'						=> '#303030',
			'title_color'						=> '#303030',
			'widget_title_color'				=> '#303030',
			'text_font' 						=> 'Titillium Web',
			'title_font' 						=> 'Amaranth',
			'navi_font' 						=> 'Titillium Web',
			'widget_title_font' 				=> 'Amaranth',
			'available_fonts'					=> 'favorites',
		);

		return $default_options;

	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {

		wp_enqueue_script( 'maxwell-pro-customizer-js', MAXWELL_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), MAXWELL_PRO_VERSION, true );

	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {

		wp_enqueue_style( 'maxwell-pro-customizer-css', MAXWELL_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), MAXWELL_PRO_VERSION );

	}
}

// Run Class.
add_action( 'init', array( 'Maxwell_Pro_Customizer', 'setup' ) );
