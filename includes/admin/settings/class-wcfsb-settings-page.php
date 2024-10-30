<?php
/**
 * JT Settings Page/Tab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'JT_WCFSB_Settings_Page', false ) ) :

	/**
	 * JT_WCFSB_Settings_Page.
	 */
	abstract class JT_WCFSB_Settings_Page {

		protected $id       = '';
		protected $label    = '';
		protected $settings = '';

		public function __construct() {
			$this->get_settings();

			add_filter( 'jt_wcfsb_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
			add_action( 'jt_wcfsb_settings_' . $this->id, array( $this, 'get_settings_html' ) );
		}

		public function get_id() {
			return $this->id;
		}

		public function get_label() {
			return $this->label;
		}

		public function get_settings() {
			return $this->settings = get_option( 'jt_wcfsb_settings' );
		}

		public function add_settings_page( $pages ) {
			$pages[ $this->id ] = $this->label;
			return $pages;
		}

		public function get_field( $field, $default = '' ) {
			if ( isset( $this->settings[ $field ] ) && $field ) :
				return $this->settings[ $field ];
			endif;
			return $default;
		}

		public function get_message_field( $field, $lang = 'default', $default = '' ) {
			if ( isset( $this->settings[ $field ] ) && isset( $this->settings[ $field ][ $lang ] ) ) :
				return stripslashes( $this->settings[ $field ][ $lang ] );
			endif;
			return stripslashes( $default );
		}
	}

endif;
