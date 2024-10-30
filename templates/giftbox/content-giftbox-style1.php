<?php
/**
 *  Giftbox style 1
 */
if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;
$order_min_amount = wc_price( $shipping_option['order_min_amount'] - $shipping_option['total'] ); ?>

<div id="jt-giftbox_model" class="jt-wcfsb-model-main"  style="<?php echo esc_attr( '--bg_gift_color: ' . $bg_color . '; --width: ' . $width ); ?>">
	<div class="jt-wcfsb-model-inner">    
		<div class="jt-wcfsb-model-wrap">
			<div class="rectangle rectangle-8" style="position: relative;">
				<div id="jt-wcfsb-close" class="cross-dark">
					<img src="<?php echo esc_url( JTWCFSB_URL . 'assets/images/cross-dark.png' ); ?>" alt="img">
				</div>
				<div class="content">        
					<div class="content-inner">
						<?php if ( $shipping_option['order_min_amount'] > $shipping_option['total'] ) : ?>
							<div class="pill-rounded">
								<h6 style="<?php echo esc_attr( 'color: ' . $text_color . ';font-weight: 600;font-size: 16px; margin: 0px; font-weight: normal; adding-top: 20px;' ); ?>">
									<?php esc_html_e( 'Add at least', 'jt-free-shipping-bar-for-woocommerce' ); ?>
								</h6>
								<h2 style="<?php echo esc_attr( 'color: ' . $text_color . ';font-weight: 700; padding: 0px; margin: 0px;' ); ?>">
									<?php echo wp_kses_post( $order_min_amount ); ?>
								</h2>
								<p style="<?php echo esc_attr( 'color: ' . $text_color . ';font-weight: 500;margin:0px' ); ?>">
									<?php esc_html_e( 'More to get free Shipping', 'jt-free-shipping-bar-for-woocommerce' ); ?>
								</p>
							</div>    
						<?php else : ?>  
							<div class="pill-rounded">
								<h2 style="<?php echo esc_attr( 'color: ' . $text_color . ';font-weight: 500; font-weight: 700; padding: 0px; font-size: 32px' ); ?>">
									<?php esc_html_e( 'Congratulation!', 'jt-free-shipping-bar-for-woocommerce' ); ?>
								</h2>
								<p style="<?php echo esc_attr( 'color: ' . $text_color . ';font-weight: 500;margin:0px' ); ?>">
									<?php esc_html_e( 'You have got free shipping.', 'jt-free-shipping-bar-for-woocommerce' ); ?>
								</p>
							</div>   
						<?php endif; ?>

						<div class="progress progress-4" style="<?php echo esc_attr( 'background-color:' . $bg_pcolor ); ?>">
							<div class="progress-bar progress-bar-4 progress-bar-striped" style="<?php echo esc_attr( 'width: ' . $width . '%; background-color:' . $curr_bg_pcolor ); ?>"></div>
						</div>

						<h3 style="<?php echo esc_attr( 'color: ' . $text_color . 'font-weight: 700; padding: 0px; margin: 20px 0px 0px 0px;' ); ?>">
							<?php printf( 
								esc_html__( 'Over %s', 'jt-free-shipping-bar-for-woocommerce' ), 
								wp_kses_post( wc_price( $shipping_option['order_min_amount'] ) ) 
							); ?>
						</h3>
						<img style="margin: 0 auto;" src="<?php esc_url_e( JTWCFSB_URL . 'assets/images/green-line.png' ); ?>" class="green-line" alt="img">                              
					</div>
				</div>
			</div>
		</div>  
	</div>  
	<div class="jt-bg_overlay"></div>
</div>