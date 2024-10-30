<?php
/**
 * JT Admin Settings General Class
 */

if ( ! class_exists( 'JT_WCFSB_Settings_Effect', false ) ) :

	/**
	 * JT_WCFSB_Settings_Effect Class.
	 */
	class JT_WCFSB_Settings_Effect extends JT_WCFSB_Settings_Page {

		function __construct() {
			$this->id    = 'effect';
			$this->label = __( 'Effect', 'jt-free-shipping-bar-for-woocommerce' );

			parent::__construct();
		}

		public function get_settings_html() {
			include __DIR__ . '/views/html-admin-settings-effect.php';
		}
	}

	new JT_WCFSB_Settings_Effect();
endif;
