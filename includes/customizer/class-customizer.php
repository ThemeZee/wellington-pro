<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Wellington Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Customizer Class
 */
class Wellington_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'wellington_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		$theme_options = wp_parse_args( get_option( 'wellington_theme_options', array() ), self::get_default_options() );

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
			'top_navi_color'					=> '#ffffff',
			'navi_color'						=> '#303030',
			'link_color'						=> '#ee3333',
			'title_color'						=> '#303030',
			'widget_title_color'				=> '#303030',
			'footer_widgets_color'				=> '#303030',
			'footer_color'						=> '#303030',
			'text_font' 						=> 'Gudea',
			'title_font' 						=> 'Magra',
			'navi_font' 						=> 'Gudea',
			'widget_title_font' 				=> 'Magra',
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

		wp_enqueue_script( 'wellington-pro-customizer-js', WELLINGTON_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), WELLINGTON_PRO_VERSION, true );

	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {

		wp_enqueue_style( 'wellington-pro-customizer-css', WELLINGTON_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), WELLINGTON_PRO_VERSION );

	}
}

// Run Class.
add_action( 'init', array( 'Wellington_Pro_Customizer', 'setup' ) );
