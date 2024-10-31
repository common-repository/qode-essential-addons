<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<a class="qodef-fullscreen-menu-close" href="#">
	<?php
	if ( ! empty( qode_essential_addons_get_opener_icon_html_content( 'fullscreen_menu_close' ) ) ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_get_opener_icon_html_content( 'fullscreen_menu_close' );
	} else {
		qode_essential_addons_render_svg_icon( 'close', 'qodef--initial' );
	}
	?>
</a>
