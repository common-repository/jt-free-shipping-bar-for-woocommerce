<?php
/**
 * JT Admin Settings Class
 */

if ( ! class_exists( 'JT_WCFSB_Admin_Settings', false ) ) :

	/**
	 * JT_WCFSB_Admin_Settings Class.
	 */
	class JT_WCFSB_Admin_Settings {

		private static $settings = array();

		public static function get_settings_pages() {
			if ( empty( self::$settings ) ) {
				$settings = array();

				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-page.php';
				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-general.php';
				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-fsb-position.php';
				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-design.php';
				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-notifications.php';
				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-effect.php';
				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-display-rules.php';
				$settings[] = include __DIR__ . '/settings/class-wcfsb-settings-report.php';

				self::$settings = apply_filters( 'jt_wcfsb_get_settings_pages', $settings );
			}

			return self::$settings;
		}

		public static function load_assets() {
			wp_enqueue_style( 'jt-settings-css' );
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_script( 'jt-settings-js' );
			wp_enqueue_script( 'wp-color-picker' );
		}

		public static function output() {
			$current_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : sanitize_text_field( 'general' );
			do_action( 'jt_wcfsb_settings_start' );

			self::load_assets();

			// Get tabs for the settings page.
			$tabs = apply_filters( 'jt_wcfsb_settings_tabs_array', array() );
			include __DIR__ . '/views/html-admin-settings.php';
		}

		public static function show_messages() {
			if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) : ?>
				<div id="message" class="updated inline"><p><strong><?php esc_html_e( 'Your settings have been saved.', 'jt-free-shipping-bar-for-woocommerce' ); ?></strong></p></div>
				<?php
			endif;
		}
	}

endif;
