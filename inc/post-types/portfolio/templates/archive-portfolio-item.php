<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

get_header();

$params            = array();
$params['content'] = 'shortcode';

// Include cpt content template.
qode_essential_addons_template_part( 'post-types/portfolio', 'templates/content', '', $params );

get_footer();
