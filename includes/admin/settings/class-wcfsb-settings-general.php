<?php
/**
 * JT Admin Settings General Class
 */

if ( ! class_exists( 'JT_WCFSB_Settings_General', false ) ) :

	/**
	 * JT_WCFSB_Settings_General Class.
	 */
	class JT_WCFSB_Settings_General extends JT_WCFSB_Settings_Page {

		function __construct() {
			$this->id    = 'general';
			$this->label = __( 'General', 'jt-free-shipping-bar-for-woocommerce' );

			parent::__construct();
		}
		
		public function get_default_shipping_zone() {
			$zones                    = array();
			$zone                     = new \WC_Shipping_Zone( 0 );
			$zones[ $zone->get_id() ] = $zone->get_data();
			$zones[ $zone->get_id() ]['formatted_zone_location'] = $zone->get_formatted_location();
			$zones[ $zone->get_id() ]['shipping_methods']        = $zone->get_shipping_methods();

			// Add user configured zones
			$zones = array_merge( $zones, WC_Shipping_Zones::get_zones() );
			foreach ( $zones as $each_zone ) :
				if ( $each_zone['id'] != 0 ) :
					$zone_name        = $each_zone['zone_name'];
					$shipping_methods = $each_zone['shipping_methods'];

					if ( is_array( $shipping_methods ) && count( $shipping_methods ) ) :
						foreach ( $shipping_methods as $free_shipping ) :

							if ( $free_shipping->id == 'free_shipping' ) :
								$zone_id = isset( $each_zone['zone_id'] ) ? $each_zone['zone_id'] : ''; ?>
								<option value="<?php echo esc_attr( $zone_id ); ?>" <?php selected( parent::get_field( 'shipping_zone' ), $zone_id ); ?> >
									<?php echo esc_html( $zone_name ); ?>
								</option>
								<?php
							endif;

						endforeach;
					endif;
				endif;
			endforeach;
		}

		public function get_settings_html() {
			include __DIR__ . '/views/html-admin-settings-general.php';
		}
	}

	new JT_WCFSB_Settings_General();
endif;
