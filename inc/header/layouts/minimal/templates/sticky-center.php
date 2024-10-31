<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-header-sticky qodef-custom-header-layout <?php echo esc_attr( implode( ' ', apply_filters( 'qode_essential_addons_filter_sticky_header_class', array() ) ) ); ?>">
	<div class="qodef-header-sticky-inner <?php echo esc_attr( implode( ' ', apply_filters( 'qode_essential_addons_filter_header_inner_class', array(), 'sticky' ) ) ); ?>">
		<div class="qodef-header-wrapper">
			<div class="qodef-header-logo">
				<?php
				// Include logo.
				qode_essential_addons_render_header_logo_image( array( 'sticky_logo' => true ) );
				?>
			</div>

			<?php
			// Include widget area one.
			qode_essential_addons_get_header_widget_area( 'sticky-header-widget-area-one' );

			// Include main navigation.
			qode_essential_addons_template_part( 'fullscreen-menu', 'templates/full-screen-opener' );
			?>
		</div>
	</div>
	<?php do_action( 'qode_essential_addons_action_after_sticky_header' ); ?>
</div>
