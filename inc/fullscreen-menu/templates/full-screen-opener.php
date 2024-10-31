<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<a class="qodef-fullscreen-menu-opener" href="#" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open the menu', 'qode-essential-addons' ); ?>">
	<?php
	if ( ! empty( qode_essential_addons_get_opener_icon_html_content( 'fullscreen_menu' ) ) ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_get_opener_icon_html_content( 'fullscreen_menu' );
	} else {
		qode_essential_addons_render_svg_icon( 'menu', 'qodef--initial' );
	}
	?>
</a>
