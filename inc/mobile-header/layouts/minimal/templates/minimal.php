<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

// Include mobile logo.
qode_essential_addons_render_mobile_header_logo_image();

// Include mobile opener.
qode_essential_addons_template_part( 'fullscreen-menu', 'templates/full-screen-opener' );
