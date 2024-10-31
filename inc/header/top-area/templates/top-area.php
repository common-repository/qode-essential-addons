<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( $show_header_area ) {
	?>
	<div id="qodef-top-area">
		<div id="qodef-top-area-inner" class="<?php echo esc_attr( implode( ' ', apply_filters( 'qode_essential_addons_filter_top_area_inner_class', array() ) ) ); ?>">
			<?php
			// Include widget area top left.
			if ( is_active_sidebar( 'qodef-top-area-left' ) ) {
				?>
				<div class="qodef-widget-holder qodef-top-area-left">
					<?php qode_essential_addons_get_header_widget_area( 'top-area-left' ); ?>
				</div>
			<?php } ?>

			<?php
			// Include widget area top right.
			if ( is_active_sidebar( 'qodef-top-area-right' ) ) {
				?>
				<div class="qodef-widget-holder qodef-top-area-right">
					<?php qode_essential_addons_get_header_widget_area( 'top-area-right' ); ?>
				</div>
			<?php } ?>

			<?php do_action( 'qode_essential_addons_action_after_top_area' ); ?>
		</div>
	</div>
<?php } ?>
