<?php
/**
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Wellington theme to display widgets
 *
 * @package Wellington Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Footer Widgets Class
 */
class Wellington_Pro_Footer_Widgets {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		// Display footer widgets.
		add_action( 'wellington_before_footer', array( __CLASS__, 'display_widgets' ), 20 );

	}

	/**
	 * Displays Footer Widgets
	 *
	 * Hooks into the wellington_before_footer action hook in footer area.
	 */
	static function display_widgets() {

		// Check if there are footer widgets.
		if ( is_active_sidebar( 'footer-column-1' )
			or is_active_sidebar( 'footer-column-2' )
			or is_active_sidebar( 'footer-column-3' )
			or is_active_sidebar( 'footer-column-4' ) ) : ?>

			<div id="footer-widgets-bg" class="footer-widgets-background">

				<div id="footer-widgets-wrap" class="footer-widgets-wrap container">

					<div id="footer-widgets" class="footer-widgets clearfix"  role="complementary">

						<?php if ( is_active_sidebar( 'footer-column-1' ) ) : ?>

							<div class="footer-widget-column widget-area">
								<?php dynamic_sidebar( 'footer-column-1' ); ?>
							</div>

						<?php endif; ?>

						<?php if ( is_active_sidebar( 'footer-column-2' ) ) : ?>

							<div class="footer-widget-column widget-area">
								<?php dynamic_sidebar( 'footer-column-2' ); ?>
							</div>

						<?php endif; ?>

						<?php if ( is_active_sidebar( 'footer-column-3' ) ) : ?>

							<div class="footer-widget-column widget-area">
								<?php dynamic_sidebar( 'footer-column-3' ); ?>
							</div>

						<?php endif; ?>

						<?php if ( is_active_sidebar( 'footer-column-4' ) ) : ?>

							<div class="footer-widget-column widget-area">
								<?php dynamic_sidebar( 'footer-column-4' ); ?>
							</div>

						<?php endif; ?>

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

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		// Register Footer Column 1 widget area.
		register_sidebar( array(
			'name' => __( 'Footer Column 1', 'wellington-pro' ),
			'id' => 'footer-column-1',
			'description' => __( 'Appears on the first footer column.', 'wellington-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		) );

		// Register Footer Column 2 widget area.
		register_sidebar( array(
			'name' => __( 'Footer Column 2', 'wellington-pro' ),
			'id' => 'footer-column-2',
			'description' => __( 'Appears on the second footer column.', 'wellington-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		) );

		// Register Footer Column 3 widget area.
		register_sidebar( array(
			'name' => __( 'Footer Column 3', 'wellington-pro' ),
			'id' => 'footer-column-3',
			'description' => __( 'Appears on the third footer column.', 'wellington-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		) );

		// Register Footer Column 4 widget area.
		register_sidebar( array(
			'name' => __( 'Footer Column 4', 'wellington-pro' ),
			'id' => 'footer-column-4',
			'description' => __( 'Appears on the fourth footer column.', 'wellington-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Wellington_Pro_Footer_Widgets', 'setup' ) );

// Register widgets in backend.
add_action( 'widgets_init', array( 'Wellington_Pro_Footer_Widgets', 'register_widgets' ), 20 );
