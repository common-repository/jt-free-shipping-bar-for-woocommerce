<?php

/**

 * Admin View: Settings Effect
 */



if ( ! defined( 'ABSPATH' ) ) :

	exit;

endif;

?>



<table class="form-table">

	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Initial delay', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<input type="number" name="jt_wcfsb_settings[intial_delay]" id="jt_wcfsb_settings[intial_delay]" min="0" value="<?php echo esc_attr( parent::get_field( 'intial_delay', '1' ) ); ?>" max="10" />

			<p><small><i><?php esc_html_e( '(Enter value in second)', 'jt-free-shipping-bar-for-woocommerce' ); ?></i></small></p>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Close bar button', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Time to Disappear', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Set time to disappear', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

		</td>

	</tr>



	<tr valign="top" class="">

		<th scope="row" class="titledesc"><?php esc_html_e( 'Show gift box', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td class="forminp forminp-checkbox ">

			<label class="form-switch">

				<input type="hidden" name="jt_wcfsb_settings[enable_gift_box]" value="0" />

				<input name="jt_wcfsb_settings[enable_gift_box]" id="jt_wcfsb_settings[enable_gift_box]" type="checkbox" class="" value="1" <?php checked( parent::get_field( 'enable_gift_box' ), 1 ); ?>>

				<span for="jt_wcfsb_settings[enable_gift_box]"></span>

				<p><i><small><?php esc_html_e( '(Display gift box when customer add product to cart)', 'jt-free-shipping-bar-for-woocommerce' ); ?></small></i></p>

			</label>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Giftbox Position', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<select name="jt_wcfsb_settings[giftbox_position]">

				<option value="top_left" <?php selected( parent::get_field( 'giftbox_position', 'bottom_right' ), 'top_left', true ); ?> ><?php esc_html_e( 'Top Left', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

				<option value="top_right" <?php selected( parent::get_field( 'giftbox_position', 'bottom_right' ), 'top_right', true ); ?> ><?php esc_html_e( 'Top Right', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

				<option value="bottom_left" <?php selected( parent::get_field( 'giftbox_position', 'bottom_right' ), 'bottom_left', true ); ?> ><?php esc_html_e( 'Bottom Left', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

				<option value="bottom_right" <?php selected( parent::get_field( 'giftbox_position', 'bottom_right' ), 'bottom_right', true ); ?> ><?php esc_html_e( 'Bottom Right', 'jt-free-shipping-bar-for-woocommerce' ); ?></option>

			</select>

		</td>

	</tr>



	<tr valign="top" class="wcfsb-gift-box-option">

		<th scope="row"><?php esc_html_e( 'Gift Icon URL', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<input type="text" name="jt_wcfsb_settings[gift_icon_url]" value="<?php echo esc_attr( parent::get_field( 'gift_icon_url', JTWCFSB_URL . 'assets/images/free-shipping.png' ) ); ?>">

			<p><small><i><?php esc_html_e( 'Enter the url of gift icon.', 'jt-free-shipping-bar-for-woocommerce' ); ?></i></small></p>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Giftbox Style', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

		</td>

	</tr>

</table>