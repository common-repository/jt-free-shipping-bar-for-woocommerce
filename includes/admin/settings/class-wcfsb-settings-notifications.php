<?php
/**
 * JT Admin Settings General Class
 *
 * @version  3.4.0
 */

if ( ! class_exists( 'JT_WCFSB_Settings_Notifications', false ) ) :

	/**
	 * JT_WCFSB_Settings_Notifications Class.
	 */
	class JT_WCFSB_Settings_Notifications extends JT_WCFSB_Settings_Page {

		function __construct() {
			$this->id    = 'notificatons';
			$this->label = __( 'Notifications', 'jt-free-shipping-bar-for-woocommerce' );

			parent::__construct();
		}

		public function get_settings_html() {
			$langs = function_exists( 'icl_get_languages' ) ? icl_get_languages( 'skip_missing=0&orderby=code' ) : array(
				'default' => array(
					'native_name'      => '',
					'country_flag_url' => '',
				),
			);
			include __DIR__ . '/views/html-admin-settings-notifications.php';
		}
	}

	new JT_WCFSB_Settings_Notifications();
endif;
