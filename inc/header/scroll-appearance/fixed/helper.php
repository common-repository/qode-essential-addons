<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function qode_essential_addons_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'qode-essential-addons' );

		return $options;
	}

	add_filter( 'qode_essential_addons_filter_header_scroll_appearance_option', 'qode_essential_addons_add_fixed_header_option' );
}
