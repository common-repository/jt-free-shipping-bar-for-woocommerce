<?php
/**
 * Class JT_WCFSB_Frontend
 */

if ( ! class_exists( 'JT_WCFSB_Frontend' ) ) :

	class JT_WCFSB_Frontend {
		protected $settings;
		protected $ignore_discounts;

		function __construct() {
			$this->settings = new JT_WCFSB_Options();
			$this->event_handler();
		}

		public function event_handler() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_script_frontend' ), 100 );
			add_action( 'wp_footer', array( $this, 'show_bar_conditional' ), 90 );
			add_action( 'wp_footer', array( $this, 'show_giftbox' ), 95 );
			add_filter( 'woocommerce_shipping_free_shipping_is_available', array( $this, 'free_shipping_option' ), 10, 3 );
		}

		public function enqueue_script_frontend() {
			wp_enqueue_style( 'main-jt-wcfsb', JTWCFSB_URL . 'assets/css/jt-wcfsb.css', array(), JTWCFSB_VERSION, 'all' );
			wp_register_script( 'main-jt-wcfsb', JTWCFSB_URL . 'assets/js/jt-wcfsb.js', array(), JTWCFSB_VERSION, true );
			wp_localize_script(
				'main-jt-wcfsb',
				'wcfsb',
				array(
					'initdelay'            => $this->settings->get_option( 'intial_delay' ),
					'is_time_to_disappear' => $this->settings->get_option( 'is_time_to_disappear' ),
					'time_to_disappear'    => $this->settings->get_option( 'time_to_disappear' ),
					'ajax_url'             => admin_url( 'admin-ajax.php' ),
					'nonce'                => wp_create_nonce( 'report-nonce' ),
				)
			);
			wp_enqueue_script( 'main-jt-wcfsb' );
		}

		public function free_shipping_option( $is_available, $package, $_this ) {
			if ( ! $this->ignore_discounts ) :
				$this->ignore_discounts = $_this->ignore_discounts;
			endif;
			return $is_available;
		}

		public function show_bar_conditional() {
			if ( ! is_admin() ) :
				$enable = $this->settings->get_option( 'enable' );
				if ( $enable && $this->settings->is_active_shipping_zone() && $this->is_topbar_hide() && $this->is_topbar_hide_on_mobile() ) :
					$this->show_bar();
				endif;
			endif;
		}

		public function get_free_shipping_bar_pricing_data() {
			$response     = array();
			$total        = WC()->cart->get_displayed_subtotal();
			$default_zone = $this->settings->get_option( 'shipping_zone' );
			$customer     = WC()->session->get( 'customer' );
			$country      = isset( $customer['shipping_country'] ) ? $customer['shipping_country'] : '';
			$state        = isset( $customer['shipping_state'] ) ? $customer['shipping_state'] : '';
			$postcode     = isset( $customer['shipping_postcode'] ) ? $customer['shipping_postcode'] : '';

			if ( $country ) :
				$result           = JT_WCFSB_Options::detect_ip( $country, $state, $postcode );
				$order_min_amount = isset( $result['min_amount'] ) ? $result['min_amount'] : false;
				$ignore_discounts = isset( $result['ignore_discounts'] ) ? $result['ignore_discounts'] : false;

				if ( ! $order_min_amount && $default_zone ) :
					$result                       = $this->settings->get_min_amount( $default_zone );
					$response['order_min_amount'] = $result['min_amount'];
					$response['ignore_discounts'] = $result['ignore_discounts'];
					$response['order_min_amount'] = $this->settings->toInt( $result['min_amount'] );

				endif;

			elseif ( $default_zone ) :
				$result                       = $this->settings->get_min_amount( $default_zone );
				$response['order_min_amount'] = $result['min_amount'];
				$response['ignore_discounts'] = $result['ignore_discounts'];
				$response['order_min_amount'] = $this->settings->toInt( $result['min_amount'] );

			else :
				$result                       = $this->settings->get_shipping_min_amount();
				$response['order_min_amount'] = $result['min_amount'];
				$response['ignore_discounts'] = $result['ignore_discounts'];

			endif;

			if ( WC()->cart->display_prices_including_tax() ) :
				$total = $total - WC()->cart->get_discount_tax();
			endif;

			if ( isset( $response['ignore_discounts'] ) && 'no' == $response['ignore_discounts'] ) :
				$total = $total - WC()->cart->get_discount_total();
			endif;
			$total             = round( $total, wc_get_price_decimals() );
			$response['total'] = $total;
			return $response;
		}

		public function show_bar() {
			$this->settings  = $this->settings;
			$progress_effect = $this->settings->get_option( 'progress_effect' );

			$shipping_option = $this->get_free_shipping_bar_pricing_data();
			$cart_qty        = WC()->cart->cart_contents_count;

			if ( ! isset( $shipping_option['order_min_amount'] ) ) :
				return;
			endif;

			if ( $shipping_option['total'] == 0 ) :
				$message_text = $this->get_announcement_message( $shipping_option['order_min_amount'] );
				$this->get_notification_topbar( $message_text, $shipping_option );
				return;
			endif;

			if ( $shipping_option['total'] < $shipping_option['order_min_amount'] ) :
				$missing_amount = $shipping_option['order_min_amount'] - $shipping_option['total'];

				if ( is_checkout() || is_cart() ) :
					$message_text = $this->get_error_message( $shipping_option['total'], $shipping_option['order_min_amount'] );
				else :
					if ( ! is_cart() && WC()->cart->display_prices_including_tax() ) :
						$missing_amount = $this->settings->get_price_including_tax( $missing_amount );
					endif;
					$message_text = $this->get_pruchased_message( $shipping_option['total'], $shipping_option['order_min_amount'], $cart_qty, $missing_amount );
				endif;
			else :
				$missing_amount = 0;
				$message_text   = $this->get_success_message();
			endif;

			$this->get_notification_topbar( $message_text, $shipping_option, $missing_amount );
		}

		public function get_notification_topbar( $message, $shipping_option, $missing_amount = 0 ) {
			$topbar_style    = $this->settings->get_option( 'topbar_style', 'style1' );
			$position        = $this->settings->get_option( 'bar_position', 'top_bar' );
			$enable_progress = $this->settings->get_option( 'enable_progress' );
			$bg_color        = $this->settings->get_option( 'bg_color', '#d2f2ff' );

			$progress_bg_color = $this->settings->get_option( 'progress_bg_color', '#e7e7ef' );
			$curr_prog_color   = $this->settings->get_option( 'curr_progress_color', '#e7e7ef' );

			$text_color          = $this->settings->get_option( 'text_color', '#3e3f5e' );
			$progress_text_color = $this->settings->get_option( 'progress_text_color', '#3e3f5e' );
			$text_align          = $this->settings->get_option( 'text_align', 'center' );
			$font_size           = $this->settings->get_option( 'font_size', '18' );
			$closebar_button     = $this->settings->get_option( 'closebar_button', false );
			$width               = $shipping_option['total'] / $shipping_option['order_min_amount'] * 100;

			jt_get_temlpate(
				'topbar/content-' . $topbar_style . '.php',
				array(
					'message'             => $message,
					'missing_amount'      => $missing_amount,
					'position'            => $position,
					'closebar_button'     => $closebar_button,
					'enable_progress'     => $enable_progress,
					'bg_color'            => $bg_color,
					'text_color'          => $text_color,
					'progress_text_color' => $progress_text_color,
					'text_align'          => $text_align,
					'font_size'           => $font_size,
					'shipping_option'     => $shipping_option,
					'width'               => $width,
					'progress_bg_color'   => $progress_bg_color,
					'curr_prog_color'     => $curr_prog_color,
				),
			);
		}

		public function get_pruchased_message( $total, $order_min_amount, $cart_qty, $missing_amount ) {
			$message_purchased = $this->settings->get_message( 'purchased_notifications', 'You have purchased {total_amounts} of {min_amount}' );

			$message = str_replace(
				array( '{total_amounts}', '{min_amount}', '{cart_qty}', '{missing_amount}' ),
				array( wc_price( $total ), wc_price( $order_min_amount ), $cart_qty, wc_price( $missing_amount ) ),
				'<div id="jt-wcfsb-main-content">' . wp_unslash( $message_purchased ) . '</div>'
			);
			return apply_filters( 'jt_notifications_text_purchased_message', $message, $total, $order_min_amount, $cart_qty, $missing_amount );
		}

		public function get_error_message( $total, $order_min_amount ) {
			$message_error  = $this->settings->get_message( 'error_notifications', 'You are missing {missing_amount} to get Free Shipping.{shopping}' );
			$missing_amount = $order_min_amount - $total;

			$message = str_replace(
				array( '{missing_amount}', '{shopping}' ),
				array( wc_price( $missing_amount ), $this->settings->get_shop_page_link_html() ),
				'<div id="jt-wcfsb-main-content">' . wp_unslash( $message_error ) . '</div>'
			);
			return apply_filters( 'jt_notifications_text_error_message', $message, $total, $order_min_amount );
		}

		public function get_success_message( $color = '' ) {
			$message_success = $this->settings->get_message( 'success_notifications', 'Congratulation! You have got free shipping. Go to {checkout_page}' );
			$message         = str_replace(
				'{checkout_page}',
				$this->settings->get_checkout_page_link_html(),
				'<div style="color: ' . $color . '" id="jt-wcfsb-main-content">' . wp_unslash( $message_success ) . '</div>'
			);
			return apply_filters( 'jt_notifications_text_success_message', $message );
		}

		public function get_announcement_message( $order_min_amount, $color = '' ) {
			$announce_system = $this->settings->get_message( 'announcement_notifications', 'Free shipping for billing over {min_amount}' );
			$message         = str_replace(
				'{min_amount}',
				wc_price( $order_min_amount ),
				'<div style="color: ' . $color . '" id="jt-wcfsb-main-content">' . wp_unslash( $announce_system ) . '</div>'
			);
			return apply_filters( 'jt_notifications_text_announcement_message', $message, $order_min_amount );
		}

		public function show_giftbox() {
			$enable = $this->settings->get_option( 'enable' );

			if ( ! $enable ) {
				return;
			}

			$shipping_option  = $this->get_free_shipping_bar_pricing_data();
			$giftbox_style    = $this->settings->get_option( 'giftbox_style', 'style1' );
			$width            = $shipping_option['total'] / $shipping_option['order_min_amount'] * 100;
			$show_giftbox     = $this->settings->get_option( 'enable_gift_box' );
			$bg_pcolor        = $this->settings->get_option( 'progress_bg_color', '#aaaaaa' );
			$curr_bg_pcolor   = $this->settings->get_option( 'curr_progress_color', '#7f54b3' );
			$bg_color         = $this->settings->get_option( 'bg_color', '#d2f2ff' );
			$text_color       = $this->settings->get_option( 'text_color', '#d2f2ff' );
			$giftbox_position = $this->settings->get_option( 'giftbox_position', 'bottom_right' );

			if ( $show_giftbox && $enable ) :
				jt_get_temlpate(
					'giftbox/content-giftbox-icon.php',
					array(
						'giftbox_position' => $giftbox_position,
					)
				);
				jt_get_temlpate(
					'giftbox/content-giftbox-' . $giftbox_style . '.php',
					array(
						'shipping_option' => $shipping_option,
						'width'           => $width,
						'bg_color'        => $bg_color,
						'text_color'      => $text_color,
						'bg_pcolor'       => $bg_pcolor,
						'curr_bg_pcolor'  => $curr_bg_pcolor,
						'giftbox_style'   => $giftbox_style,
					)
				);
			endif;
			return false;
		}

		public function is_topbar_hide_on_mobile() {
			$enable_mobile_tab = $this->settings->get_option( 'enable_mobile_tab', false );
			if ( wp_is_mobile() ) {
				return $enable_mobile_tab ? true : false;
			}
			return true;
		}

		public function is_topbar_hide() {
			$home_page           = $this->settings->get_option( 'home_page', false );
			$cart_page           = $this->settings->get_option( 'cart_page', false );
			$shop_page           = $this->settings->get_option( 'shop_page', false );
			$checkout_page       = $this->settings->get_option( 'checkout_page', false );
			$single_product_page = $this->settings->get_option( 'single_product_page', false );
			$product_cat_page    = $this->settings->get_option( 'product_cat_page', false );

			if ( is_front_page() ) {
				return $home_page ? false : true;
			}

			if ( is_cart() ) {
				return $cart_page ? false : true;
			}

			if ( is_shop() ) {
				return $shop_page ? false : true;
			}

			if ( is_checkout() ) {
				return $checkout_page ? false : true;
			}

			if ( is_product() ) {
				return $single_product_page ? false : true;
			}

			if ( is_product_category() ) {
				return $product_cat_page ? false : true;
			}

			return true;
		}
	}
	new JT_WCFSB_Frontend();
endif;
