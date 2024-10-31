<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( isset( $media ) && ! empty( $media ) ) {
	$images = explode( ',', $media );

	foreach ( $images as $image ) {
		$params           = array();
		$params['media']  = $image;
		$params['unique'] = $unique;
		qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/media/media', 'image', $params );
	}
}
