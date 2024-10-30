<?php
/**
 * JT Admin Settings General Class
 *
 * @version  3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

if ( ! class_exists( 'JT_WCFSB_Settings_DisplayRules', false ) ) :

	/**
	 * JT_WCFSB_Settings_DisplayRules Class.
	 */
	class JT_WCFSB_Settings_DisplayRules extends JT_WCFSB_Settings_Page {

		function __construct() {
			$this->id    = 'display_rules';
			$this->label = __( 'Display Rules', 'jt-free-shipping-bar-for-woocommerce' );

			parent::__construct();
		}

		public function get_settings_html() {
			include __DIR__ . '/views/html-admin-settings-display-rules.php';
		}
	}

	new JT_WCFSB_Settings_DisplayRules();
endif;
