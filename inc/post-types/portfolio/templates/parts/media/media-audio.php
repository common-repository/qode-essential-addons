<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( isset( $media ) && ! empty( $media ) ) {
	$wrapped_start = '';
	$wrapped_end   = '';

	if ( isset( $media_type ) && 'gallery' === $media_type ) {
		$wrapped_start = '<div class="qodef-grid-item">';
		$wrapped_end   = '</div>';
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	printf( '%s%s%s', $wrapped_start, wp_audio_shortcode( array( 'src' => esc_url( $media ) ) ), $wrapped_end );
}
