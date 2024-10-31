<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( isset( $media ) && ! empty( $media ) ) {
	// Wrapper elements.
	$wrapped_start = '';
	$wrapped_end   = '';

	if ( isset( $media_type ) && 'gallery' === $media_type ) {
		$wrapped_start = '<div class="qodef-grid-item">';
		$wrapped_end   = '</div>';
	}
	// Video player settings.
	$settings = apply_filters(
		'qode_essential_addons_filter_video_format_settings',
		array(
			'loop' => true,
		)
	);

	$oembed = wp_oembed_get( $media );
	if ( ! empty( $oembed ) ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '%s%s%s', $wrapped_start, wp_oembed_get( $media, $settings ), $wrapped_end );
	} else {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '%s%s%s', $wrapped_start, wp_video_shortcode( array_merge( array( 'src' => esc_url( $media ) ), $settings ) ), $wrapped_end );
	}
}
