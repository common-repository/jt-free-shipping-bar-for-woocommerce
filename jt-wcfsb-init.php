<?php
/*
 * Plugin Name:       JT Free Shipping Bar for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/jt-free-shipping-bar-for-woocommerce/
 * Description:       A flexible and optimized WordPress plugin that allows you to display progressbar for free shpping on the top of the screen
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            jthemes
 * Author URI:        https://www.jthemes.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jt-free-shipping-bar-for-woocommerce
 */



defined( 'ABSPATH' ) || exit;

if ( ! defined( 'JTWCFSB_FILE' ) ) :
	define( 'JTWCFSB_FILE', __FILE__ );
endif;

if ( ! defined( 'JTWCFSB_BASENAME' ) ) :
	define( 'JTWCFSB_BASENAME', plugin_basename( JTWCFSB_FILE ) );
endif;

if ( ! defined( 'JTWCFSB_VERSION' ) ) :
	define( 'JTWCFSB_VERSION', '1.0.2' );
endif;

if ( ! defined( 'JTWCFSB_PATH' ) ) :
	define( 'JTWCFSB_PATH', plugin_dir_path( __FILE__ ) );
endif;

if ( ! defined( 'JTWCFSB_URL' ) ) :
	define( 'JTWCFSB_URL', plugin_dir_url( __FILE__ ) );
endif;

if ( ! defined( 'JTWCFSB_UPGRADE_URL' ) ) :
	define( 'JTWCFSB_UPGRADE_URL', 'https://www.jthemes.com/' );
endif;



if ( ! function_exists( 'jt_wcfsb_constructor' ) ) :

	function jt_wcfsb_constructor() {
		require_once 'includes/jt-functions.php';
		require_once 'includes/class.wcfsb-ajax-request.php';
		if ( is_admin() ) :
			require_once 'includes/admin/class-wcfsb-settings.php';
			require_once 'includes/admin/class-wcfsb-admin-menu.php';
		else :
			require_once 'includes/class-jt-wcfsb-options.php';
			require_once 'includes/public/class-jt-wcfsb-frontend.php';
		endif;
	}
	add_action( 'jt_wcfsb_init', 'jt_wcfsb_constructor' );

endif;


if ( ! function_exists( 'jt_wcfsb_woocommerce_admin_notice' ) ) :

	function jt_wcfsb_woocommerce_admin_notice() {
		?>
		<div class="error">
			<p><?php esc_html_e( 'JT Free Shipping Bar for WooCommerce is enabled but not effective. It requires WooCommerce to work.', 'jt-free-shipping-bar-for-woocommerce' ); ?></p>
		</div>
		<?php
	}

endif;


if ( ! function_exists( 'jt_wcfsb_install' ) ) :

	function jt_wcfsb_install() {
		if ( ! function_exists( 'WC' ) ) :
			add_action( 'admin_notices', 'jt_wcfsb_woocommerce_admin_notice' );
		else :
			do_action( 'jt_wcfsb_init' );
		endif;
	}
	add_action( 'plugins_loaded', 'jt_wcfsb_install', 11 );

endif;
