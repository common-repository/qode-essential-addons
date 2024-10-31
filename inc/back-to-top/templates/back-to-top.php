<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$custom_icon    = qode_essential_addons_get_opener_icon_html_content( 'back_to_top' );
$holder_classes = array();

if ( empty( $custom_icon ) ) {
	$holder_classes[] = 'qodef--predefined';
}
?>
<a id="qodef-back-to-top" href="#" <?php qode_essential_addons_framework_class_attribute( $holder_classes ); ?>>
	<span class="qodef-back-to-top-icon">
		<?php
		if ( ! empty( $custom_icon ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo qode_essential_addons_get_opener_icon_html_content( 'back_to_top' );
		} else {
			qode_essential_addons_render_svg_icon( 'back-to-top' );
		}
		?>
	</span>
</a>
