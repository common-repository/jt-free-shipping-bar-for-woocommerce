<?php
/**
 * JT Admin Settings fsb Position Class
 */

if ( ! class_exists( 'JT_WCFSB_Settings_FSB_Position', false ) ) :

	/**
	 * JT_WCFSB_Settings_FSB_Position Class.
	 */
	class JT_WCFSB_Settings_FSB_Position extends JT_WCFSB_Settings_Page {

		function __construct() {
			$this->id    = 'position';
			$this->label = __( 'Shipping Bar Position', 'jt-free-shipping-bar-for-woocommerce' );

			parent::__construct();
		}

		public function get_settings_html() {
			include __DIR__ . '/views/html-admin-settings-fsb-position.php';
		}
	}

	new JT_WCFSB_Settings_FSB_Position();
endif;
