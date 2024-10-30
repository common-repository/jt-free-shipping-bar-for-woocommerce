<?php
/**
 * General core functions available on both the front-end and admin.
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jt_get_temlpate' ) ) :

	function jt_get_temlpate( $template_name, $args = array(), $default_path = '' ) {
		$template_path = 'jt-free-shipping-bar-for-woocommerce-pro/';

		if ( empty( $default_path ) ) :
			$default_path = JTWCFSB_PATH . 'templates/';
		endif;

		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				$template_name,
			)
		);

		if ( empty( $template ) ) :
			$template = $default_path . $template_name;
		endif;
		if ( ! file_exists( $template ) ) :
			return new WP_Error(
				'error',
				sprintf(
					__( '%s does not exist.' ),
					'<code>' . $template . '</code>'
				)
			);
		endif;

		do_action( 'jt-before_template_part', $template, $args, $default_path );

		if ( ! empty( $args ) && is_array( $args ) ) :
			extract( $args );
		endif;
		include $template;

		do_action( 'jt-after_template_part', $template, $args, $default_path );
	}

endif;
