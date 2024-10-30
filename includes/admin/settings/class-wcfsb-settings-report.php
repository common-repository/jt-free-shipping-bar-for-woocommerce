<?php
/**
 * JT Admin Settings Reports Class
 */

if ( ! class_exists( 'JT_WCFSB_Settings_Reports', false ) ) :

	/**
	 * JT_WCFSB_Settings_Reports Class.
	 */
	class JT_WCFSB_Settings_Reports extends JT_WCFSB_Settings_Page {

		function __construct() {
			$this->id    = 'reports';
			$this->label = __( 'Reports', 'jt-free-shipping-bar-for-woocommerce' );

			parent::__construct();
		}


		public function get_settings_html() {
			include __DIR__ . '/views/html-admin-settings-report.php';
		}
	}

	new JT_WCFSB_Settings_Reports();
endif;
