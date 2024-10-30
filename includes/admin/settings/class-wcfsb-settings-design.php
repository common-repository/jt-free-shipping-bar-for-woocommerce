<?php
/**
 * JT Admin Settings Design Class
 */

if ( ! class_exists( 'JT_WCFSB_Settings_Design', false ) ) :

	/**
	 * JT_WCFSB_Settings_Design Class.
	 */
	class JT_WCFSB_Settings_Design extends JT_WCFSB_Settings_Page {

		function __construct() {
			$this->id    = 'design';
			$this->label = __( 'Design', 'jt-free-shipping-bar-for-woocommerce' );

			parent::__construct();
		}

		public function get_settings_html() {
			include __DIR__ . '/views/html-admin-settings-design.php';
		}
	}

	new JT_WCFSB_Settings_Design();
endif;
