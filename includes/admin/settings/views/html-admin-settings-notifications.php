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

		<th scope="row"><?php esc_html_e( 'Announcement Notifications', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td class="jt-wcfsb-notice-sample">

			

			<?php foreach ( $langs as $lang_code => $lang_opttion ) : ?>

				<label>

					<img src="<?php echo esc_url( $lang_opttion['country_flag_url'] ); ?>"> <?php echo esc_html( $lang_opttion['native_name'] ); ?>

				</label>

				<textarea rows="5" cols="50" name="jt_wcfsb_settings[announcement_notifications][<?php echo esc_attr( $lang_code ); ?>]"><?php echo esc_attr( parent::get_message_field( 'announcement_notifications', $lang_code, 'Free shipping for billing over {min_amount}' ) ); ?></textarea>

			<?php endforeach; ?>

			<ul class="description" style="list-style: none">

				<li><span>{min_amount}</span>- <?php esc_html_e( 'Minimum order amount Free Shipping', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

			</ul>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Purchased Notification', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td class="jt-wcfsb-notice-sample">

			<?php foreach ( $langs as $lang_code => $lang_opttion ) : ?>

				<label>

					<img src="<?php echo esc_url( $lang_opttion['country_flag_url'] ); ?>"> <?php echo esc_html( $lang_opttion['native_name'] ); ?>

				</label>

				<textarea rows="5" cols="50" name="jt_wcfsb_settings[purchased_notifications][<?php echo esc_attr( $lang_code ); ?>]"><?php echo esc_attr( parent::get_message_field( 'purchased_notifications', $lang_code, 'You have purchased {total_amounts} of {min_amount}' ) ); ?></textarea>

			<?php endforeach; ?>

			<ul class="description" style="list-style: none">

				<li><span>{total_amounts}</span>- <?php esc_html_e( 'The total amount of your purchases', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

				<li><span>{cart_qty}</span>- <?php esc_html_e( 'Total quantity in cart.', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

				<li><span>{min_amount}</span>- <?php esc_html_e( 'Minimum order amount Free Shipping', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

				<li><span>{missing_amount}</span>- <?php esc_html_e( 'The outstanding amount of the free shipping program', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

			</ul>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Success Notifications', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td class="jt-wcfsb-notice-sample">

			<?php foreach ( $langs as $lang_code => $lang_opttion ) : ?>

				<label>

					<img src="<?php echo esc_url( $lang_opttion['country_flag_url'] ); ?>"> <?php echo esc_html( $lang_opttion['native_name'] ); ?>

				</label>

				<textarea rows="5" cols="50" name="jt_wcfsb_settings[success_notifications][<?php echo esc_attr( $lang_code ); ?>]"><?php echo esc_attr( parent::get_message_field( 'success_notifications', $lang_code, 'Congratulation! You have got free shipping. Go to {checkout_page}' ) ); ?></textarea>

			<?php endforeach; ?>

			<ul class="description" style="list-style: none">

				<li><span>{checkout_page}</span>- <?php esc_html_e( 'Cehckout page Link', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

			</ul>

		</td>

	</tr>



	<tr valign="top">

		<th scope="row"><?php esc_html_e( 'Error Notifications', 'jt-free-shipping-bar-for-woocommerce' ); ?></th>

		<td class="jt-wcfsb-notice-sample">

			<?php foreach ( $langs as $lang_code => $lang_opttion ) : ?>

				<label>

					<img src="<?php echo esc_url( $lang_opttion['country_flag_url'] ); ?>"> <?php echo esc_html( $lang_opttion['native_name'] ); ?>

				</label>

				<textarea rows="5" cols="50" name="jt_wcfsb_settings[error_notifications][<?php echo esc_attr( $lang_code ); ?>]"><?php echo esc_attr( parent::get_message_field( 'error_notifications', $lang_code, 'You are missing {missing_amount} to get Free Shipping. Continue {shopping}' ) ); ?></textarea>

			<?php endforeach; ?>

			<ul class="description" style="list-style: none">

				<li><span>{missing_amount}</span>-<?php esc_html_e( 'The outstanding amount of the free shipping program', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

				<li><span>{shopping}</span>-<?php esc_html_e( 'Link to shop page', 'jt-free-shipping-bar-for-woocommerce' ); ?></li>

			</ul>

		</td>

	</tr>

</table>