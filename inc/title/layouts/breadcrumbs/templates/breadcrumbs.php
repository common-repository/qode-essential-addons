<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

// Load title image template.
qode_essential_addons_get_page_title_image();
?>
<div class="qodef-m-content <?php echo esc_attr( qode_essential_addons_get_page_title_content_classes() ); ?>">
	<?php
	// Load breadcrumbs template.
	qode_essential_addons_breadcrumbs();
	?>
</div>
