<?php

/**

 * Admin View: Settings General
 */



if ( ! defined( 'ABSPATH' ) ) :

	exit;

endif;

?>

<table class="form-table">

	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Hide on Page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<table>

				<tr valign="top">

					<th scope="row"><?php esc_html_e( 'Home Page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

					<td>

						<label class="form-switch">

							<input type="hidden" name="jt_wcfsb_settings[home_page]" value="0" />

							<input type="checkbox" name="jt_wcfsb_settings[home_page]" value="1" tabindex="0" <?php checked( parent::get_field( 'home_page' ), 1 ); ?> />   

							<span for="jt_wcfsb_settings[home_page]"></span>

						</label>

					</td>

				</tr>

				<tr valign="top">

					<th scope="row"><?php esc_html_e( 'Cart Page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

					<td>

						<label class="form-switch">

							<input type="hidden" name="jt_wcfsb_settings[cart_page]" value="0" />

							<input type="checkbox" name="jt_wcfsb_settings[cart_page]" value="1" tabindex="0" <?php checked( parent::get_field( 'cart_page' ), 1 ); ?> />   

							<span for="jt_wcfsb_settings[cart_page]"></span>

						</label>

					</td>

				</tr>

				<tr valign="top">

					<th scope="row"><?php esc_html_e( 'Shop Page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

					<td>

						<label class="form-switch">

							<input type="hidden" name="jt_wcfsb_settings[shop_page]" value="0" />

							<input type="checkbox" name="jt_wcfsb_settings[shop_page]" value="1" tabindex="0" <?php checked( parent::get_field( 'shop_page' ), 1 ); ?> />   

							<span for="jt_wcfsb_settings[shop_page]"></span>

						</label>

					</td>

				</tr>

				<tr valign="top">

					<th scope="row"><?php esc_html_e( 'Checkout Page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

					<td>

						<label class="form-switch">

							<input type="hidden" name="jt_wcfsb_settings[checkout_page]" value="0" />

							<input type="checkbox" name="jt_wcfsb_settings[checkout_page]" value="1" tabindex="0" <?php checked( parent::get_field( 'checkout_page' ), 1 ); ?> />   

							<span for="jt_wcfsb_settings[checkout_page]"></span>

						</label>

					</td>

				</tr>

				<tr valign="top">

					<th scope="row"><?php esc_html_e( 'Single Product Page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

					<td>

						<label class="form-switch">

							<input type="hidden" name="jt_wcfsb_settings[single_product_page]" value="0" />

							<input type="checkbox" name="jt_wcfsb_settings[single_product_page]" value="1" tabindex="0" <?php checked( parent::get_field( 'single_product_page' ), 1 ); ?> />   

							<span for="jt_wcfsb_settings[single_product_page]"></span>

						</label>

					</td>

				</tr>

				<tr valign="top">

					<th scope="row"><?php esc_html_e( 'Product category Page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

					<td>

						<label class="form-switch">

							<input type="hidden" name="jt_wcfsb_settings[product_cat_page]" value="0" />

							<input type="checkbox" name="jt_wcfsb_settings[product_cat_page]" value="1" tabindex="0" <?php checked( parent::get_field( 'product_cat_page' ), 1 ); ?> />   

							<span for="jt_wcfsb_settings[product_cat_page]"></span>

						</label>

					</td>

				</tr>

			</table>

		</td>

	</tr>

</table>