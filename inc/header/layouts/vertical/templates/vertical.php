<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<header id="qodef-page-header">
	<div id="qodef-page-header-inner">
		<?php
		// Include logo.
		qode_essential_addons_render_header_logo_image();

		// Include divided left navigation.
		qode_essential_addons_template_part( 'header', 'layouts/vertical/templates/navigation' );

		// Include widget area one.
		qode_essential_addons_get_header_widget_area();

		// Hook to include additional content after page header inner.
		do_action( 'qode_essential_addons_action_after_header' );
		?>
	</div>
</header>
