<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_set_page_content_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_page_content_styles( $style ) {
		$styles = array();

		$content_margin = apply_filters( 'qode_essential_addons_filter_content_margin', 0 );

		if ( 0 !== $content_margin ) {
			$styles['margin-top'] = '-' . intval( $content_margin ) . 'px';
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-outer',
					'.error404 #qodef-page-outer',
				),
				$styles
			);
		}

		$style_mobile          = array();
		$content_margin_mobile = apply_filters( 'qode_essential_addons_filter_content_margin_mobile', 0 );

		if ( 0 !== $content_margin_mobile ) {
			$style_mobile['margin-top'] = '-' . intval( $content_margin_mobile ) . 'px';
		}

		if ( ! empty( $style_mobile ) ) {
			$style .= qode_essential_addons_framework_dynamic_style_responsive(
				array(
					'#qodef-page-outer',
					'.error404 #qodef-page-outer',
				),
				$style_mobile,
				'',
				'1024'
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_page_content_styles' );
}
