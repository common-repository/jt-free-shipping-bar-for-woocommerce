<?php

/**

 * Admin View: Settings Bar Position
 */



if ( ! defined( 'ABSPATH' ) ) :

	exit;

endif;

?>

<table class="form-table">

	<tbody>

		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Topbar Position', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

				<select name="jt_wcfsb_settings[bar_position]">

					<option value="top_bar" <?php selected( parent::get_field( 'bar_position' ), 'top_bar', true ); ?> ><?php esc_html_e( 'Top', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

					<option value="bottom_bar" <?php selected( parent::get_field( 'bar_position' ), 'bottom_bar', true ); ?> ><?php esc_html_e( 'Bottom', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

				</select>

			</td>

		</tr>



		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Topbar Style', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

				<select name="jt_wcfsb_settings[topbar_style]">

					<option value="style1" <?php selected( parent::get_field( 'topbar_style' ), 'style1' ); ?>><?php esc_html_e( 'Style 1', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

					<option value="style2" <?php selected( parent::get_field( 'topbar_style' ), 'style2' ); ?>><?php esc_html_e( 'Style 2', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

				</select>

				<p class="description"><?php esc_html_e( 'To override this template copy this file from <code>jt-free-shipping-bar-for-woocommerce/templates/topbar/conte-style{1-2}.php</code> to your theme folder', 'jt-free-shipping-bar-for-woocommerce' ); ?></p>

			</td>

		</tr>



		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Position on Mini Cart', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

				<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

			</td>

		</tr>



		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Position on Cart page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

				<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

			</td>

		</tr>



		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Position on Checkout page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

				<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

			</td>

		</tr>



		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Checkout page Style', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

			<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

			</td>

		</tr>



		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Show single product page', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

				<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

			</td>

		</tr>

	</tbody>

</table>