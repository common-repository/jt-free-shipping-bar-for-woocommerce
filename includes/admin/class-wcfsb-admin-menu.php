<?php
/**
 * Class JT_WCFSB_Admin_Menu
 * Register plugins menus
 */

if ( ! class_exists( 'JT_WCFSB_Admin_Menu' ) ) :

	class JT_WCFSB_Admin_Menu {

		function __construct() {
			$this->event_handler();
		}

		public function event_handler() {
			add_action( 'admin_init', array( $this, 'register_settings' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 99 );

			add_action( 'wp_loaded', array( $this, 'load_settings_classes' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );

			add_filter( 'pre_update_option_jt_wcfsb_settings', array( $this, 'filter_data_before_update' ), 10, 3 );
		}

		public function admin_scripts() {
			wp_register_script( 'jt-settings-js', JTWCFSB_URL . '/assets/js/settings.js', array( 'jquery' ), JTWCFSB_VERSION );
		}

		public function admin_styles() {
			wp_register_style( 'jt-settings-css', JTWCFSB_URL . '/assets/css/settings.css', array(), JTWCFSB_VERSION );
		}

		public function admin_menu() {
			global $menu, $admin_page_hooks;
			$icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDIwMDEwOTA0Ly9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iNTEyLjAwMDAwMHB0IiBoZWlnaHQ9IjUxMi4wMDAwMDBwdCIgdmlld0JveD0iMCAwIDUxMi4wMDAwMDAgNTEyLjAwMDAwMCIKIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPgoKPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsNTEyLjAwMDAwMCkgc2NhbGUoMC4xMDAwMDAsLTAuMTAwMDAwKSIKZmlsbD0iIzAwMDAwMCIgc3Ryb2tlPSJub25lIj4KPHBhdGggZD0iTTUzOSAzMTg5IGMtMTI2IC0xOCAtMjU3IC04NyAtMzUzIC0xODQgLTcwIC03MiAtMTE3IC0xNDggLTE1MiAtMjUwCi0yNCAtNzAgLTI4IC05NSAtMjcgLTE5NSAwIC05OSA0IC0xMjYgMjcgLTE5NSA4MiAtMjM5IDI4MCAtNDA0IDUyMyAtNDM2IDUyCi02IDc0NiAtOSAyMDU4IC03IGwxOTgwIDMgODAgMjggYzIwMSA3MSAzNDQgMjE0IDQwOCA0MDcgMTEyIDMzOSAtNzIgNjk3Ci00MTggODEyIGwtNzAgMjMgLTIwMDAgMSBjLTExMDAgMSAtMjAyNSAtMiAtMjA1NiAtN3ogbTI3NjQgLTIwOCBsMTA3IC0xIDAKLTQyMyAwIC00MjMgLTE0MTcgMSAtMTQxOCAyIC02NSAyMiBjLTEyNiA0MyAtMjA2IDExNyAtMjYxIDI0MSAtMjAgNDcgLTI0IDcxCi0yNCAxNjEgMCAxMDEgMSAxMDggMzggMTgxIDYwIDEyMiAxNzggMjE2IDI5NyAyMzYgMzQgNiAyMzU5IDkgMjc0MyAzeiIvPgo8L2c+Cjwvc3ZnPgo=';

			add_menu_page(
				__( 'JT Free Shipping Bar', 'jt-free-shipping' ),
				__( 'JT Free Shipping Bar', 'jt-free-shipping' ),
				'manage_woocommerce',
				'jt-free-shipping',
				array( $this, 'setting_page' ),
				$icon,
				'55.5'
			);
			$admin_page_hooks['jt_wcfsp'] = __( 'JT Free Shipping Bar', 'jt-free-shipping' );
		}

		public function setting_page() {
			JT_WCFSB_Admin_Settings::output();
		}

		public function register_settings() {
			register_setting( 'jt_wcfsb_settings', 'jt_wcfsb_settings' );
		}

		public function filter_data_before_update( $value, $old_value, $option ) {
			$data = array_merge( (array) $old_value, (array) $value );
			return $data;
		}

		public function load_settings_classes() {
			if ( ! is_admin() || ! isset( $_GET['page'] ) || 'jt-free-shipping' !== $_GET['page'] ) :
				return;
			endif;

			JT_WCFSB_Admin_Settings::get_settings_pages();
		}
	}
	new JT_WCFSB_Admin_Menu();
endif;
