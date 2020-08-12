<?php
/**
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Wellington theme to display widgets
 *
 * @package Wellington Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Bar Class
 */
class Wellington_Pro_Header_Bar {

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

		// Display Header Bar.
		add_action( 'wellington_header_bar', array( __CLASS__, 'display_header_bar' ) );

	}

	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return void
	 */
	static function display_header_bar() {

		// Check if there are menus.
		if ( has_nav_menu( 'social' ) or has_nav_menu( 'secondary' ) ) {

			echo '<div id="header-bar" class="header-bar">';

			// Check if there is a social menu.
			if ( has_nav_menu( 'social' ) ) {

				echo '<div id="header-social-icons" class="social-icons-navigation clearfix">';

				// Display Social Icons Menu.
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'menu_class'     => 'social-icons-menu',
					'echo'           => true,
					'fallback_cb'    => '',
					'link_before'    => '<span class = "screen-reader-text">',
					'link_after'     => '</span>',
					'depth'          => 1,
				) );

				echo '</div>';

			}

			// Check if there is a top navigation menu.
			if ( has_nav_menu( 'secondary' ) ) : ?>

				<button class="secondary-menu-toggle menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
					<?php
					echo wellington_get_svg( 'menu' );
					echo wellington_get_svg( 'close' );
					?>
					<span class="menu-toggle-text screen-reader-text"><?php esc_html_e( 'Navigation', 'wellington-pro' ); ?></span>
				</button>

				<div class="secondary-navigation">

					<nav class="top-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', 'wellington-pro' ); ?>">

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								'menu_id'        => 'secondary-menu',
								'container'      => false,
							)
						);
						?>

					</nav>

				</div><!-- .secondary-navigation -->

				<?php
			endif;

			echo '</div>';
		}
	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	 */
	static function register_nav_menus() {

		// Return early if Wellington Theme is not active.
		if ( ! current_theme_supports( 'wellington-pro' ) ) {
			return;
		}

		register_nav_menus( array(
			'secondary' => esc_html__( 'Top Navigation', 'wellington-pro' ),
			'social'    => esc_html__( 'Social Icons', 'wellington-pro' ),
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Wellington_Pro_Header_Bar', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Wellington_Pro_Header_Bar', 'register_nav_menus' ), 20 );
