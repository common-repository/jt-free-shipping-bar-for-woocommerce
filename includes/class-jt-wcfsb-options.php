<?php

if ( ! class_exists( 'JT_WCFSB_Options' ) ) :

	class JT_WCFSB_Options {
		private $options;

		function __construct() {
			if ( ! $this->options ) :
				$this->options = get_option( 'jt_wcfsb_settings', array() );
			endif;
		}

		public function toInt( $str ) {
			return preg_replace( '/([^0-9\\.])/i', '', $str );
		}

		public function free_shipping_option( $is_available, $package, $_this ) {
			if ( ! $this->ignore_discounts ) :
				$this->ignore_discounts = $_this->ignore_discounts;
			endif;
			return $is_available;
		}

		public function get_option( $field_name, $default = '' ) {
			if ( isset( $this->options[ $field_name ] ) ) :
				return apply_filters( 'jt_wcfsb_free_shipping_bar_get_option_' . $field_name, $this->options[ $field_name ] );
			endif;
			return $default;
		}

		public function is_active_shipping_zone() {
			global $wpdb;
			$wfspb_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}woocommerce_shipping_zone_methods WHERE method_id = %s AND is_enabled = %d", 'free_shipping', 1 );
			$zone_data   = $wpdb->get_results( $wfspb_query, OBJECT );

			if ( empty( $zone_data ) ) :
				return false;
			endif;
			return true;
		}

		public function get_message( $notification_name, $defaultMessage = '' ) {
			$lang    = function_exists( 'wpml_get_current_language' ) ? wpml_get_current_language() : 'default';
			$message = isset( $this->get_option( $notification_name )[ $lang ] ) ? $this->get_option( $notification_name )[ $lang ] : ( isset( $this->get_option( $notification_name )['default'] ) ? $this->get_option( $notification_name )['default'] : $defaultMessage );
			return $message;
		}

		public function get_checkout_page_link_html() {
			$link_color = $this->get_option( 'link_color', '#83b834' );
			return '<a style="color:' . $link_color . '" href="' . wc_get_checkout_url() . '" title="' . esc_html__( 'Checkout', 'jt-free-shipping-bar-for-woocommerce' ) . '">' . esc_html__( 'Checkout', 'jt-free-shipping-bar-for-woocommerce' ) . '</a>';
		}

		public function get_shop_page_link_html() {
			$link_color = $this->get_option( 'link_color', '#83b834' );
			return '<a id="jt_continue_shopping" style="color:' . $link_color . '" href="' . get_permalink( get_option( 'woocommerce_shop_page_id' ) ) . '">' . esc_html__( 'Continue Shopping', 'jt-free-shipping-bar-for-woocommerce' ) . '</a>';
		}

		public static function detect_ip( $country = null, $state = '', $postcode = '' ) {
			global $wpdb;

			if ( $country ) :
				$criteria  = array();
				$continent = strtoupper( wc_clean( WC()->countries->get_continent_code_for_country( $country ) ) );

				$criteria[] = $wpdb->prepare( "( ( location_type = 'country' AND location_code = %s )", $country );
				$criteria[] = ! empty( $state ) ? $wpdb->prepare( "OR ( location_type = 'state' AND location_code = %s )", $country . ':' . $state ) : '';
				$criteria[] = $wpdb->prepare( "OR ( location_type = 'continent' AND location_code = %s )", $continent );
				$criteria[] = 'OR ( location_type IS NULL ) )';

				// Postcode range and wildcard matching.
				if ( $postcode ) :
					$postcode_locations = $wpdb->get_results( "SELECT zone_id, location_code FROM {$wpdb->prefix}woocommerce_shipping_zone_locations WHERE location_type = 'postcode';" );

					if ( $postcode_locations ) :
						$zone_ids_with_postcode_rules = array_map( 'absint', wp_list_pluck( $postcode_locations, 'zone_id' ) );
						$matches                      = wc_postcode_location_matcher( $postcode, $postcode_locations, 'zone_id', 'location_code', $country );
						$do_not_match                 = array_unique( array_diff( $zone_ids_with_postcode_rules, array_keys( $matches ) ) );

						if ( ! empty( $do_not_match ) ) :
							$criteria[] = 'AND zones.zone_id NOT IN (' . implode( ',', $do_not_match ) . ')';
						endif;
					endif;
				endif;

				$matching_zone_id = $wpdb->get_var(
					"SELECT zones.zone_id FROM {$wpdb->prefix}woocommerce_shipping_zones as zones
                    INNER JOIN {$wpdb->prefix}woocommerce_shipping_zone_locations as locations ON zones.zone_id = locations.zone_id AND location_type != 'postcode'
                    WHERE " . implode( ' ', $criteria ) . '
                    ORDER BY zone_order ASC LIMIT 1'
				);

				$shipping_methods = new WC_Shipping_Zone( $matching_zone_id ? $matching_zone_id : 0 );
				$shipping_methods = $shipping_methods->get_shipping_methods();
				foreach ( $shipping_methods as $i => $shipping_method ) :
					if ( is_numeric( $i ) ) :
						if ( $shipping_method->id == 'free_shipping' && $shipping_method->enabled == 'yes' ) :
							return array(
								'min_amount'       => $shipping_method->min_amount,
								'ignore_discounts' => $shipping_method->ignore_discounts,
							);
						endif;
					endif;
				endforeach;
			endif;
			return false;
		}

		public function get_shipping_min_amount() {
			/*Get Shipping method*/
			global $wpdb;

			$country          = strtoupper( wc_clean( WC()->customer->country ) );
			$state            = strtoupper( wc_clean( WC()->customer->state ) );
			$continent        = strtoupper( wc_clean( WC()->countries->get_continent_code_for_country( $country ) ) );
			$postcode         = wc_normalize_postcode( WC()->customer->postcode );
			$cache_key        = WC_Cache_Helper::get_cache_prefix( 'shipping_zones' ) . 'wc_shipping_zone_' . md5( sprintf( '%s+%s+%s', $country, $state, $postcode ) );
			$matching_zone_id = wp_cache_get( $cache_key, 'shipping_zones' );

			if ( false === $matching_zone_id ) :

				// Work out criteria for our zone search
				$criteria   = array();
				$criteria[] = $wpdb->prepare( "( ( location_type = 'country' AND location_code = %s )", $country );
				$criteria[] = $wpdb->prepare( "OR ( location_type = 'state' AND location_code = %s )", $country . ':' . $state );
				$criteria[] = $wpdb->prepare( "OR ( location_type = 'continent' AND location_code = %s )", $continent );
				$criteria[] = 'OR ( location_type IS NULL ) )';

				// Postcode range and wildcard matching
				$postcode_locations = $wpdb->get_results( "SELECT zone_id, location_code FROM {$wpdb->prefix}woocommerce_shipping_zone_locations WHERE location_type = 'postcode';" );

				if ( $postcode_locations ) :
					$zone_ids_with_postcode_rules = array_map( 'absint', wp_list_pluck( $postcode_locations, 'zone_id' ) );
					$matches                      = wc_postcode_location_matcher( $postcode, $postcode_locations, 'zone_id', 'location_code', $country );
					$do_not_match                 = array_unique( array_diff( $zone_ids_with_postcode_rules, array_keys( $matches ) ) );

					if ( ! empty( $do_not_match ) ) :
						$criteria[] = 'AND zones.zone_id NOT IN (' . implode( ',', $do_not_match ) . ')';
					endif;
				endif;

				// Get matching zones
				$matching_zone_id = $wpdb->get_var(
					"SELECT zones.zone_id FROM {$wpdb->prefix}woocommerce_shipping_zones as zones
                    INNER JOIN {$wpdb->prefix}woocommerce_shipping_zone_locations as locations ON zones.zone_id = locations.zone_id AND location_type != 'postcode'
                    WHERE " . implode( ' ', $criteria ) . '
                    ORDER BY zone_order ASC LIMIT 1'
				);
			endif;

			$shipping_methods = new WC_Shipping_Zone( $matching_zone_id ? $matching_zone_id : 0 );
			$shipping_methods = $shipping_methods->get_shipping_methods();
			foreach ( $shipping_methods as $i => $shipping_method ) :
				if ( is_numeric( $i ) ) :
					if ( $shipping_method->id == 'free_shipping' ) :
						return array(
							'min_amount'       => $shipping_method->min_amount,
							'ignore_discounts' => $shipping_method->ignore_discounts,
						);
					else :
						continue;
					endif;
				endif;
			endforeach;
			return false;
		}

		public function get_min_amount( $zone_id ) {
			global $wpdb;
			$wfspb_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}woocommerce_shipping_zone_methods WHERE method_id = 'free_shipping' AND is_enabled = 1 AND zone_id=%d", $zone_id );
			$zone_data   = $wpdb->get_results( $wfspb_query, OBJECT );

			if ( ! empty( $zone_data ) ) :
				$first_zone      = $zone_data[0];
				$instance_id     = $first_zone->instance_id;
				$method_id       = $first_zone->method_id;
				$arr_method      = array( $method_id, $instance_id );
				$implode_method  = implode( '_', $arr_method );
				$free_option     = 'woocommerce_' . $implode_method . '_settings';
				$free_shipping_s = get_option( $free_option );
				return array(
					'min_amount'       => $free_shipping_s['min_amount'],
					'ignore_discounts' => $free_shipping_s['ignore_discounts'],
				);
			endif;
			__return_null();
		}
	}

endif;
