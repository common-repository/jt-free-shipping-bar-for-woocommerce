<?php
/**
 * Admin View: Settings
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

$tab_exists        = isset( $tabs[ $current_tab ] ) || has_action( 'jt_wcfsb_sections_' . $current_tab ) || has_action( 'jt_wcfsb_settings_' . $current_tab ) || has_action( 'jt_wcfsb_settings_tabs_' . $current_tab );
$current_tab_label = isset( $tabs[ $current_tab ] ) ? $tabs[ $current_tab ] : '';

?>
<div class="wrap jt-wcfsp">
	<?php do_action( 'jt_wcfsb_before_settings_' . $current_tab ); ?>
	<form method="post" id="jtsettingForm" action="options.php" enctype="multipart/form-data">
		<nav class="nav-tab-wrapper">
			<?php

			foreach ( $tabs as $slug => $label ) :
				echo '<a href="' . esc_html( admin_url( 'admin.php?page=jt-free-shipping&tab=' . esc_attr( $slug ) ) ) . '" class="nav-tab ' . ( $current_tab === $slug ? 'nav-tab-active' : '' ) . '">' . esc_html( $label ) . '</a>';
			endforeach;

			do_action( 'jt_wcfsb_settings_tabs' );

			?>
		</nav>
		<h1 class="screen-reader-text"><?php echo esc_html( $current_tab_label ); ?></h1>
		<?php

			self::show_messages();

			do_action( 'jt_sections_' . $current_tab );
			do_action( 'jt_wcfsb_settings_' . $current_tab );
			do_action( 'jt_wcfsb_settings_tabs_' . $current_tab ); // @deprecated 3.4.0 hook.
		?>
		<p class="submit">
			<?php settings_fields( 'jt_wcfsb_settings' ); ?><?php submit_button(); ?>
		</p>
	</form>
	<?php do_action( 'jt_wcfsb_after_settings_' . $current_tab ); ?>
</div>
