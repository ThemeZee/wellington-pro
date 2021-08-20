<?php
/*
Plugin Name: Wellington Pro
Plugin URI: http://themezee.com/addons/wellington-pro/
Description: Adds additional features like footer widgets, custom colors, custom fonts, custom menus, and Magazine Post widgets to the Wellington theme.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.9
Text Domain: wellington-pro
Domain Path: /languages/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Wellington Pro
Copyright(C) 2021, ThemeZee.com - support@themezee.com

*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Main Wellington_Pro Class
 *
 * @package Wellington Pro
 */
class Wellington_Pro {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses Wellington_Pro::constants() Setup the constants needed
	 * @uses Wellington_Pro::includes() Include the required files
	 * @uses Wellington_Pro::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Constants.
		self::constants();

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Include Files.
		self::includes();

		// Setup Action Hooks.
		self::setup_actions();
	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {

		// Define Plugin Name.
		define( 'WELLINGTON_PRO_NAME', 'Wellington Pro' );

		// Define Version Number.
		define( 'WELLINGTON_PRO_VERSION', '1.9' );

		// Define Plugin Name.
		define( 'WELLINGTON_PRO_PRODUCT_ID', 113282 );

		// Define Update API URL.
		define( 'WELLINGTON_PRO_STORE_API_URL', 'https://themezee.com' );

		// Plugin Folder Path.
		define( 'WELLINGTON_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL.
		define( 'WELLINGTON_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File.
		define( 'WELLINGTON_PRO_PLUGIN_FILE', __FILE__ );
	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'wellington-pro', false, dirname( plugin_basename( WELLINGTON_PRO_PLUGIN_FILE ) ) . '/languages/' );

	}

	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {

		// Include Admin Classes.
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/admin/class-plugin-updater.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/admin/class-settings.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/admin/class-settings-page.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/admin/class-admin-notices.php';

		// Include Customizer Classes.
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/customizer/class-customizer.php';

		// Include Pro Features.
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-author-bio.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-block-colors.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-custom-colors.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-custom-fonts.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-footer-line.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-footer-widgets.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-header-bar.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . '/includes/modules/class-header-search.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-header-spacing.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . '/includes/modules/class-scroll-to-top.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/modules/class-widget-areas.php';

		// Include Magazine Widgets.
		require_once WELLINGTON_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-horizontal-box.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-vertical-box.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/widgets/widget-magazine-posts-list.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/widgets/widget-magazine-posts-sidebar.php';
		require_once WELLINGTON_PRO_PLUGIN_DIR . 'includes/widgets/widget-magazine-posts-single.php';
	}

	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {

		// Enqueue Wellington Pro Stylesheet.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ), 11 );

		// Add Custom CSS code to the Gutenberg editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_editor_styles' ), 11 );

		// Register additional Magazine Widgets.
		add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );

		// Add Settings link to Plugin actions.
		add_filter( 'plugin_action_links_' . plugin_basename( WELLINGTON_PRO_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );

		// Add automatic plugin updater from ThemeZee Store API.
		add_action( 'admin_init', array( __CLASS__, 'plugin_updater' ), 0 );
	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		// Enqueue RTL or default Plugin Stylesheet.
		if ( is_rtl() ) {
			wp_enqueue_style( 'wellington-pro', WELLINGTON_PRO_PLUGIN_URL . 'assets/css/wellington-pro-rtl.css', array(), WELLINGTON_PRO_VERSION );
		} else {
			wp_enqueue_style( 'wellington-pro', WELLINGTON_PRO_PLUGIN_URL . 'assets/css/wellington-pro.css', array(), WELLINGTON_PRO_VERSION );
		}

		// Enqueue Custom CSS.
		wp_add_inline_style( 'wellington-pro', self::get_custom_css() );
	}

	/**
	 * Enqueue Editor Styles
	 *
	 * @return void
	 */
	static function enqueue_editor_styles() {

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		// Enqueue Custom CSS.
		wp_add_inline_style( 'wellington-editor-styles', self::get_custom_css() );
	}

	/**
	 * Return custom CSS for color and font variables.
	 *
	 * @return void
	 */
	static function get_custom_css() {

		// Get Custom CSS.
		$custom_css = apply_filters( 'wellington_pro_custom_css_stylesheet', '' );

		// Sanitize CSS Code.
		$custom_css = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css = str_replace( '&gt;', '>', $custom_css );
		$custom_css = preg_replace( '/\n/', '', $custom_css );
		$custom_css = preg_replace( '/\t/', '', $custom_css );

		return $custom_css;
	}

	/**
	 * Register Magazine Widgets
	 *
	 * @return void
	 */
	static function register_widgets() {

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		register_widget( 'Wellington_Pro_Magazine_Horizontal_Box_Widget' );
		register_widget( 'Wellington_Pro_Magazine_Vertical_Box_Widget' );
		register_widget( 'Wellington_Pro_Magazine_Posts_List_Widget' );
		register_widget( 'Wellington_Pro_Magazine_Posts_Sidebar_Widget' );
		register_widget( 'Wellington_Pro_Magazine_Posts_Single_Widget' );
	}

	/**
	 * Add Settings link to the plugin actions
	 *
	 * @param array $actions Plugin action links.
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'themes.php?page=wellington-pro' ), __( 'Settings', 'wellington-pro' ) ) );

		return array_merge( $settings_link, $actions );
	}

	/**
	 * Plugin Updater
	 *
	 * @return void
	 */
	static function plugin_updater() {

		$options = Wellington_Pro_Settings::instance();

		if ( '' !== $options->get( 'license_key' ) ) :

			$license_key = trim( $options->get( 'license_key' ) );

			// Setup the updater.
			$wellington_pro_updater = new Wellington_Pro_Plugin_Updater( WELLINGTON_PRO_STORE_API_URL, __FILE__, array(
				'version'   => WELLINGTON_PRO_VERSION,
				'license'   => $license_key,
				'item_name' => WELLINGTON_PRO_NAME,
				'item_id'   => WELLINGTON_PRO_PRODUCT_ID,
				'author'    => 'ThemeZee',
			) );

		endif;
	}
}

// Run Plugin.
Wellington_Pro::setup();
