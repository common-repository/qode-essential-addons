<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-header-wrapper">
	<div class="qodef-header-logo">
		<?php
		// Include logo.
		qode_essential_addons_render_header_logo_image();
		?>
	</div>
	<?php
	// Include widget area one.
	qode_essential_addons_get_header_widget_area();

	// Include main navigation.
	qode_essential_addons_template_part( 'fullscreen-menu', 'templates/full-screen-opener' );
	?>
</div>
