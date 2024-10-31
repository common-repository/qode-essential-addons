<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$product_list_image = get_post_meta( get_the_ID(), 'qodef_product_list_image', true );
$has_image          = ! empty( $product_list_image ) || has_post_thumbnail();

if ( $has_image ) {
	$image_dimension = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo qode_essential_addons_get_list_shortcode_item_image( $image_dimension, $product_list_image );
}
