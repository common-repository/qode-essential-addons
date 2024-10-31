<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$custom_opener_icon = qode_essential_addons_get_opener_icon_html_content( 'side_area', true );
$opener_classes     = array();

if ( empty( $custom_opener_icon ) ) {
	$opener_classes[] = 'qodef--predefined';
}
?>
<a id="qodef-side-area-close" href="javascript:void(0)" class="qodef-opener-icon qodef-m <?php echo esc_attr( implode( ' ', $opener_classes ) ); ?>">
	<span class="qodef-m-icon">
		<?php
		if ( ! empty( $custom_opener_icon ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo qode_essential_addons_get_opener_icon_html_content( 'side_area', true );
		} else {
			qode_essential_addons_render_svg_icon( 'plus' );
		}
		?>
	</span>
</a>
