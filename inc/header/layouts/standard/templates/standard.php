<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

// Include logo.
qode_essential_addons_render_header_logo_image();

// Include main navigation.
qode_essential_addons_template_part( 'header', 'templates/parts/navigation' );

// Include widget area one.
qode_essential_addons_get_header_widget_area();
