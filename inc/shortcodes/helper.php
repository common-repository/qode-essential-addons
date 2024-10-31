<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_get_list_shortcode_item_image' ) ) {
	/**
	 * Function that generates thumbnail img tag for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 *
	 * @return string generated img tag
	 *
	 * @see qode_essential_addons_framework_generate_thumbnail()
	 */
	function qode_essential_addons_get_list_shortcode_item_image( $image_dimension, $attachment_id = 0 ) {
		$item_id = get_the_ID();

		if ( ! empty( $attachment_id ) ) {
			$html = qode_essential_addons_get_attachment_image( $attachment_id, $image_dimension );
		} else {
			$html = get_the_post_thumbnail( $item_id, $image_dimension );
		}

		return apply_filters( 'qode_essential_addons_filter_list_shortcode_item_image', $html, $attachment_id );
	}
}
