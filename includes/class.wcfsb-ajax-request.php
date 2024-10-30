<?php
/**
 * Class JT_WCFSB_Ajax_Handler
 */

if ( ! class_exists( 'JT_WCFSB_Ajax_Handler' ) ) :

	class JT_WCFSB_Ajax_Handler {

		function __construct() {
			$this->event_handler();
		}

		public function event_handler() {
			add_action( 'wp_ajax_increment_report_continue_shopping', array( __CLASS__, 'report_continue_shopping' ) );
			add_action( 'wp_ajax_nopriv_increment_report_continue_shopping', array( __CLASS__, 'report_continue_shopping' ) );
		}

		public static function report_continue_shopping() {
			$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
			$response      = array(
				'success' => false,
				'url'     => $shop_page_url,
			);

			if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'report-nonce' ) ) :
				$settings                             = get_option( 'jt_wcfsb_settings', array() );
				$settings['continue_shopping_clicks'] = $settings['continue_shopping_clicks'] + 1;

				update_option( 'jt_wcfsb_settings', $settings );
				$response = array(
					'success' => true,
					'url'     => $shop_page_url,
				);
			endif;
			wp_send_json( $response );
		}
	}
	new JT_WCFSB_Ajax_Handler();
endif;
