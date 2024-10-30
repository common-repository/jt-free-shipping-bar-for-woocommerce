<?php

/**

 * Admin View: Settings General
 */



if ( ! defined( 'ABSPATH' ) ) :

	exit;

endif;

?>

<table class="form-table">

	<tr valign="top" class="">

		<th scope="row" class="titledesc"><?php esc_html_e( 'Enable', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td class="forminp forminp-checkbox">

			<label class="form-switch">

				<input type="hidden" name="jt_wcfsb_settings[enable]" value="0" />

				<input name="jt_wcfsb_settings[enable]" id="jt_wcfsb_settings[enable]" type="checkbox" class="" value="1" <?php checked( parent::get_field( 'enable' ), 1 ); ?> />

				<span for="jt_wcfsb_settings[enable]"></span>

			</label>

			<p><small><i><?php esc_html_e( 'Enable/Disable display progressbar', 'jt-free-shipping-bar-for-woocommerce' ); ?></i></small></p>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Free Shipping Zone', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<select class="fluid dropdown required" name="jt_wcfsb_settings[shipping_zone]">

				<?php $this->get_default_shipping_zone(); ?>

			</select>

			<p class="description"><?php esc_html_e( 'Please select zone default what you set Free Shiping method.', 'jt-free-shipping-bar-for-woocommerce' ); ?>

				(*)require</p>

		</td>

	</tr>





	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Mobile', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td>

			<a class="jt__button" target="_blank" href="<?php echo esc_url( JTWCFSB_UPGRADE_URL ); ?>"><?php esc_html_e( 'BUY PRO', 'jt-free-shipping-bar-for-woocommerce' ); ?></a>

		</td>

	</tr>

</table>