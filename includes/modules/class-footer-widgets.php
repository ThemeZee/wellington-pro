<?php
/**
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Maxwell theme to display widgets
 *
 * @package Maxwell Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Footer Widgets Class
 */
class Maxwell_Pro_Footer_Widgets {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Maxwell Theme is not active.
		if ( ! current_theme_supports( 'maxwell-pro' ) ) {
			return;
		}

		// Display widgets.
		add_action( 'maxwell_before_footer', array( __CLASS__, 'display_widgets' ) );

	}

	/**
	 * Displays Footer Widgets
	 *
	 * Hooks into the maxwell_before_footer action hook in footer area.
	 */
	static function display_widgets() {

		// Check if there are footer widgets.
		if ( is_active_sidebar( 'footer' ) ) : ?>

			<div id="footer-widgets-wrap" class="footer-widgets-wrap">

				<div id="footer-widgets" class="footer-widgets container">

					<div id="footer-widgets-columns" class="footer-widgets-columns clearfix"  role="complementary">

						<?php dynamic_sidebar( 'footer' ); ?>

					</div>

				</div>

			</div>

		<?php endif;

	}

	/**
	 * Register all Footer Widget areas
	 *
	 * @return void
	 */
	static function register_widgets() {

		// Return early if Maxwell Theme is not active.
		if ( ! current_theme_supports( 'maxwell-pro' ) ) {
			return;
		}

		// Register Footer widget area.
		register_sidebar( array(
			'name' => esc_html__( 'Footer', 'maxwell-pro' ),
			'id' => 'footer',
			'description' => esc_html__( 'Appears on the footer area.', 'maxwell-pro' ),
			'before_widget' => '<div class="footer-widget-column"><aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside></div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Maxwell_Pro_Footer_Widgets', 'setup' ) );

// Register widgets in backend.
add_action( 'widgets_init', array( 'Maxwell_Pro_Footer_Widgets', 'register_widgets' ), 20 );
