<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_is_page_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function qode_essential_addons_is_page_title_enabled( $is_enabled ) {
		$option      = qode_essential_addons_get_option_value( 'admin', 'qodef_enable_page_title' ) !== 'no';
		$option      = apply_filters( 'qode_essential_addons_filter_is_page_title_enabled', $option );
		$meta_option = qode_essential_addons_get_option_value( 'meta-box', 'qodef_enable_page_title', '', qode_essential_addons_framework_get_page_id() );
		$option      = '' === $meta_option ? $option : ( 'yes' === $meta_option );

		if ( ! $option ) {
			$is_enabled = false;
		}

		return $is_enabled;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_enable_page_title', 'qode_essential_addons_is_page_title_enabled', 10 );
	add_filter( 'the_q_filter_enable_page_title', 'qode_essential_addons_is_page_title_enabled', 10 );
	add_filter( 'qi_filter_enable_page_title', 'qode_essential_addons_is_page_title_enabled', 10 );
	add_filter( 'qi_gutenberg_filter_enable_page_title', 'qode_essential_addons_is_page_title_enabled', 10 );
}

if ( ! function_exists( 'qode_essential_addons_get_page_title_image_params' ) ) {
	/**
	 * Function that return parameters for page title image
	 *
	 * @return array
	 */
	function qode_essential_addons_get_page_title_image_params() {
		$background_image = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_background_image' );
		$image_behavior   = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_background_image_behavior' );

		$params = array(
			'image'          => ! empty( $background_image ) ? $background_image : '',
			'image_behavior' => ! empty( $image_behavior ) ? $image_behavior : '',
		);

		return $params;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_page_title_image' ) ) {
	/**
	 * Function that render page title image html
	 */
	function qode_essential_addons_get_page_title_image() {
		$image_params = qode_essential_addons_get_page_title_image_params();

		if ( ! empty( $image_params['image'] ) && 'responsive' === $image_params['image_behavior'] ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div class="qodef-m-image">' . qode_essential_addons_get_attachment_image( $image_params['image'], 'full' ) . '</div>';
		}
	}
}

if ( ! function_exists( 'qode_essential_addons_get_page_title_content_classes' ) ) {
	/**
	 * Function that return classes for page title content area
	 *
	 * @return string
	 */
	function qode_essential_addons_get_page_title_content_classes() {
		$classes      = array();
		$image_params = qode_essential_addons_get_page_title_image_params();

		$enable_title_grid      = qode_essential_addons_get_post_value_through_levels( 'qodef_set_page_title_area_in_grid' ) !== 'no';
		$is_grid_enabled        = apply_filters( 'qode_essential_addons_filter_page_title_in_grid', $enable_title_grid );
		$enable_title_grid_meta = qode_essential_addons_get_option_value( 'meta-box', 'qodef_set_page_title_area_in_grid', '', qode_essential_addons_framework_get_page_id() );
		$is_grid_enabled        = '' === $enable_title_grid_meta ? $is_grid_enabled : ( 'yes' === $enable_title_grid_meta );

		$classes[] = $is_grid_enabled ? 'qodef-content-grid' : 'qodef-content-full-width';

		return implode( ' ', $classes );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_page_title_text' ) ) {
	/**
	 * Function that return page title text
	 *
	 * @return string
	 */
	function qode_essential_addons_get_page_title_text() {
		return apply_filters( 'qode_essential_addons_filter_page_title_text', get_option( 'blogname' ) );
	}
}
