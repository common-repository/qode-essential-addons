<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_set_general_gutenberg_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_gutenberg_typography_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$body_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_p', 'body' );
		$p_styles          = qode_essential_addons_get_typography_styles( $scope, 'qodef_p', 'p' );
		$link_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_link' );
		$link_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_link' );

		if ( ! empty( $body_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper .block-editor-block-list__layout',
					'.editor-styles-wrapper .mce-content-body',
					'.editor-styles-wrapper p.wp-block',
				),
				$body_styles
			);
		}

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper p',
					'.editor-styles-wrapper p.wp-block',
				),
				$p_styles
			);
		}

		if ( ! empty( $link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper a',
					'.editor-styles-wrapper p a',
				),
				$link_styles
			);
		}

		if ( ! empty( $link_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper a:hover',
					'.editor-styles-wrapper p a:hover',
					'.editor-styles-wrapper a:focus',
					'.editor-styles-wrapper p a:focus',
				),
				$link_hover_styles
			);
		}

		$headings = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
		foreach ( $headings as $heading ) {
			$heading_styles      = qode_essential_addons_get_typography_styles( $scope, 'qodef_' . $heading );
			$heading_link_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_' . $heading . '_link' );

			if ( ! empty( $heading_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'.editor-styles-wrapper ' . $heading,
						'.editor-styles-wrapper ' . $heading . '.wp-block',
						'.editor-styles-wrapper ' . $heading . '.rich-text',
					),
					$heading_styles
				);
			}

			if ( ! empty( $heading_link_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'.editor-styles-wrapper ' . $heading . ':hover',
						'.editor-styles-wrapper ' . $heading . '.wp-block:hover',
						'.editor-styles-wrapper ' . $heading . '.rich-text:hover',
						'.editor-styles-wrapper ' . $heading . ':focus',
						'.editor-styles-wrapper ' . $heading . '.wp-block:focus',
						'.editor-styles-wrapper ' . $heading . '.rich-text:focus',
					),
					$heading_link_styles
				);
			}
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_gutenberg_inline_style', 'qode_essential_addons_set_general_gutenberg_typography_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_general_gutenberg_typography_responsive_tablet_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_gutenberg_typography_responsive_tablet_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$tablet_sizes = array( '1024', '768' );
		foreach ( $tablet_sizes as $tablet_size ) {
			$p_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_p_responsive_' . $tablet_size );

			if ( ! empty( $p_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'.qode-essential-addons--tablet.editor-styles-wrapper .block-editor-block-list__layout',
						'.qode-essential-addons--tablet.editor-styles-wrapper .mce-content-body',
						'.qode-essential-addons--tablet.editor-styles-wrapper p.wp-block',
						'.qode-essential-addons--mobile.editor-styles-wrapper .block-editor-block-list__layout',
						'.qode-essential-addons--mobile.editor-styles-wrapper .mce-content-body',
						'.qode-essential-addons--mobile.editor-styles-wrapper p.wp-block',
					),
					$p_styles
				);
			}

			$headings = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
			foreach ( $headings as $heading ) {
				$heading_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_' . $heading . '_responsive_' . $tablet_size );

				if ( ! empty( $heading_styles ) ) {
					$style .= qode_essential_addons_framework_dynamic_style(
						array(
							'.qode-essential-addons--tablet.editor-styles-wrapper ' . $heading,
							'.qode-essential-addons--tablet.editor-styles-wrapper ' . $heading . '.wp-block',
							'.qode-essential-addons--tablet.editor-styles-wrapper ' . $heading . '.rich-text',
							'.qode-essential-addons--mobile.editor-styles-wrapper ' . $heading,
							'.qode-essential-addons--mobile.editor-styles-wrapper ' . $heading . '.wp-block',
							'.qode-essential-addons--mobile.editor-styles-wrapper ' . $heading . '.rich-text',
						),
						$heading_styles
					);
				}
			}
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_gutenberg_inline_style', 'qode_essential_addons_set_general_gutenberg_typography_responsive_tablet_styles', 15 );
}

if ( ! function_exists( 'qode_essential_addons_set_general_gutenberg_typography_responsive_mobile_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_gutenberg_typography_responsive_mobile_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$p_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_p_responsive_680' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qode-essential-addons--mobile.editor-styles-wrapper .block-editor-block-list__layout',
					'.qode-essential-addons--mobile.editor-styles-wrapper .mce-content-body',
					'.qode-essential-addons--mobile.editor-styles-wrapper p.wp-block',
				),
				$p_styles
			);
		}

		$headings = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
		foreach ( $headings as $heading ) {
			$heading_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_' . $heading . '_responsive_680' );

			if ( ! empty( $heading_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'.qode-essential-addons--mobile.editor-styles-wrapper ' . $heading,
						'.qode-essential-addons--mobile.editor-styles-wrapper ' . $heading . '.wp-block',
						'.qode-essential-addons--mobile.editor-styles-wrapper ' . $heading . '.rich-text',
					),
					$heading_styles
				);
			}
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_gutenberg_inline_style', 'qode_essential_addons_set_general_gutenberg_typography_responsive_mobile_styles', 20 );
}
