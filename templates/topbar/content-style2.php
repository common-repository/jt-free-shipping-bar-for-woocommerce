<?php
/***
 * Free Shipping Annoucement Message Style 2
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

$width = $width > 100 ? 100 : $width; ?>


<div class="jt-wcfsb-topbar" >
	<div id="jt-wcfsb-topbar" class="<?php echo esc_attr( 'rectangle-3 ' . $position ); ?>" style="<?php echo esc_attr( 'background-color:' . $bg_color . '; text-align: ' . $text_align . '; display: none' ); ?>">
		<div class="jt-container">
			<div class="">
				<img src="<?php echo esc_url( JTWCFSB_URL . '/assets/images/boy-with-courier.png' ); ?>" alt="img">
			</div>
			<div class="content" style="width: 100%">
				<h4 class="rectangle-3-title" style="font-weight: 600; margin: 10px 0px; font-size: 18px;"><?php echo wp_kses_post( $message ); ?></h4> 
				<div class="progress progress-2" style="<?php echo esc_attr( 'background-color:' . $progress_bg_color ); ?>">
					<div class="progress-bar progress-bar-2" style="<?php echo esc_attr( 'width:' . $width . '%; background-color:' . $curr_prog_color ); ?>">
						<div class="pricing">
							<p style="text-align: left; font-weight: 600;"><?php echo esc_html__( '$0.00', 'jt-free-shipping-bar-for-woocommerce' ); ?></p>
							<p style="text-align: right; font-weight: 600;"><?php echo wp_kses_post( wc_price( $shipping_option['total'] ) ); ?></p>
						</div>
					</div>
				</div>            
			</div> 
			<?php if ( $closebar_button ) : ?>
				<div class="closebar">&#10005;</div>   
			<?php endif; ?>     
		</div>
	</div>
</div>