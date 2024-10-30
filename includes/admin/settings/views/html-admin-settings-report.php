<?php

/**

 * Admin View: Settings Reports
 */



if ( ! defined( 'ABSPATH' ) ) :

	exit;

endif;

?>

<table class="form-table">

	<tbody>

		<tr valign="top">

			<th scope="row"><?php esc_html_e( 'Continue Shopping click', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

			<td>

				<input type="number" readonly id="jt_wcfsb_settings[continue_shopping_clicks]" name="jt_wcfsb_settings[continue_shopping_clicks]" value="<?php echo esc_attr( parent::get_field( 'continue_shopping_clicks', '0' ) ); ?>">

				<input type="button" name="reset" value="Reset" class="button reset_val" />

			</td>

		</tr>

	</tbody>

</table>