<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

// Include logo.
qode_essential_addons_render_header_logo_image();

// Include widget area one.
qode_essential_addons_get_header_widget_area();

// Include menu opener.
qode_essential_addons_template_part( 'fullscreen-menu', 'templates/full-screen-opener' );
