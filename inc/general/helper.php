<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_general_options_grid_size_classes' ) ) {
	/**
	 * Function that add grid size class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_general_options_grid_size_classes( $classes ) {
		$content_width = qode_essential_addons_get_post_value_through_levels( 'qodef_content_width' );

		if ( ! empty( $content_width ) ) {
			$classes[] = 'qodef-content-grid-' . $content_width;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_add_general_options_grid_size_classes' );
}

if ( ! function_exists( 'qode_essential_addons_is_boxed_enabled' ) ) {
	/**
	 * Function that check is option enabled
	 *
	 * @return bool
	 */
	function qode_essential_addons_is_boxed_enabled() {
		return 'yes' === qode_essential_addons_get_post_value_through_levels( 'qodef_boxed' );
	}
}

if ( ! function_exists( 'qode_essential_addons_add_general_options_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_general_options_body_classes( $classes ) {
		$content_behind_header = qode_essential_addons_get_post_value_through_levels( 'qodef_content_behind_header' );

		$classes[] = qode_essential_addons_is_boxed_enabled() ? 'qodef--boxed' : '';
		$classes[] = 'yes' === $content_behind_header ? 'qodef-content-behind-header' : '';

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_add_general_options_body_classes' );
}

if ( ! function_exists( 'qode_essential_addons_add_boxed_wrapper_classes' ) ) {
	/**
	 * Function that add additional class name for main page wrapper
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function qode_essential_addons_add_boxed_wrapper_classes( $classes ) {

		if ( qode_essential_addons_is_boxed_enabled() ) {
			$classes .= ' qodef-content-grid';
		}

		return $classes;
	}

	add_filter( 'the_q_filter_page_wrapper_classes', 'qode_essential_addons_add_boxed_wrapper_classes' );
	add_filter( 'the_two_filter_page_wrapper_classes', 'qode_essential_addons_add_boxed_wrapper_classes' );
	add_filter( 'qi_filter_page_wrapper_classes', 'qode_essential_addons_add_boxed_wrapper_classes' );
	add_filter( 'qi_gutenberg_filter_page_wrapper_classes', 'qode_essential_addons_add_boxed_wrapper_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_general_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_styles( $style ) {
		$styles = array();

		$background_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_page_background_color' );
		$background_image      = qode_essential_addons_get_post_value_through_levels( 'qodef_page_background_image' );
		$background_repeat     = qode_essential_addons_get_post_value_through_levels( 'qodef_page_background_repeat' );
		$background_size       = qode_essential_addons_get_post_value_through_levels( 'qodef_page_background_size' );
		$background_position   = qode_essential_addons_get_post_value_through_levels( 'qodef_page_background_position' );
		$background_attachment = qode_essential_addons_get_post_value_through_levels( 'qodef_page_background_attachment' );

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $background_image ) ) {
			$styles['background-image'] = 'url(' . esc_url( qode_essential_addons_get_attachment_image_url( $background_image, 'full' ) ) . ')';
		}

		if ( ! empty( $background_repeat ) ) {
			$styles['background-repeat'] = $background_repeat;
		}

		if ( ! empty( $background_size ) ) {
			$styles['background-size'] = $background_size;
		}

		if ( ! empty( $background_position ) ) {
			$styles['background-position'] = $background_position;
		}

		if ( ! empty( $background_attachment ) ) {
			$styles['background-attachment'] = $background_attachment;
		}

		if ( ! empty( $styles ) ) {

			if ( qode_essential_addons_is_boxed_enabled() ) {
				$selector = 'body.qodef--boxed #qodef-page-wrapper';
			} else {
				$selector = 'body';
			}

			$style .= qode_essential_addons_framework_dynamic_style( $selector, $styles );
		}

		if ( qode_essential_addons_is_boxed_enabled() ) {
			$boxed_styles = array();

			$boxed_background_color    = qode_essential_addons_get_post_value_through_levels( 'qodef_boxed_background_color' );
			$boxed_background_pattern  = qode_essential_addons_get_post_value_through_levels( 'qodef_boxed_background_pattern' );
			$boxed_background_behavior = qode_essential_addons_get_post_value_through_levels( 'qodef_boxed_background_pattern_behavior' );
			$boxed_background_size     = qode_essential_addons_get_post_value_through_levels( 'qodef_boxed_background_pattern_size' );

			if ( ! empty( $boxed_background_color ) ) {
				$boxed_styles['background-color'] = $boxed_background_color;
			}

			if ( ! empty( $boxed_background_pattern ) ) {
				$boxed_styles['background-image']    = 'url(' . esc_url( qode_essential_addons_get_attachment_image_url( $boxed_background_pattern, 'full' ) ) . ')';
				$boxed_styles['background-position'] = '0 0';
				$boxed_styles['background-repeat']   = 'repeat';
			}

			if ( '' !== $boxed_background_size ) {
				$boxed_styles['background-size'] = $boxed_background_size;
			}

			if ( 'fixed' === $boxed_background_behavior ) {
				$boxed_styles['background-attachment'] = 'fixed';
			}

			if ( ! empty( $boxed_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style( 'body.qodef--boxed', $boxed_styles );
			}
		}

		$page_content_style = array();

		$page_content_padding = qode_essential_addons_get_post_value_through_levels( 'qodef_page_content_padding' );

		if ( '' !== $page_content_padding ) {
			$page_content_style['padding'] = $page_content_padding;
		}

		if ( ! empty( $page_content_style ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-inner', $page_content_style );
		}

		$page_content_style_mobile = array();

		$page_content_padding_mobile = qode_essential_addons_get_post_value_through_levels( 'qodef_page_content_padding_mobile' );

		if ( '' !== $page_content_padding_mobile ) {
			$page_content_style_mobile['padding'] = $page_content_padding_mobile;
		}

		if ( ! empty( $page_content_style_mobile ) ) {
			$style .= qode_essential_addons_framework_dynamic_style_responsive( '#qodef-page-inner', $page_content_style_mobile, '', '1024' );
		}

		$page_wrapper_style = array();

		$page_wrapper_padding      = qode_essential_addons_get_post_value_through_levels( 'qodef_page_wrapper_padding' );
		$page_wrapper_margin       = qode_essential_addons_get_post_value_through_levels( 'qodef_page_wrapper_margin' );
		$page_wrapper_border_color = qode_essential_addons_get_post_value_through_levels( 'qodef_page_wrapper_border_color' );
		$page_wrapper_border_width = qode_essential_addons_get_post_value_through_levels( 'qodef_page_wrapper_border_width' );
		$page_wrapper_border_style = qode_essential_addons_get_post_value_through_levels( 'qodef_page_wrapper_border_style' );

		if ( '' !== $page_wrapper_padding ) {
			$page_wrapper_style['padding'] = $page_wrapper_padding;
		}

		if ( '' !== $page_wrapper_margin ) {
			$page_wrapper_style['margin'] = $page_wrapper_margin;

			if ( qode_essential_addons_is_boxed_enabled() ) {
				$page_wrapper_style['margin-left']  = 'auto';
				$page_wrapper_style['margin-right'] = 'auto';
			}
		}

		if ( ! empty( $page_wrapper_border_color ) ) {
			$page_wrapper_style['border-color'] = $page_wrapper_border_color;

			if ( empty( $page_wrapper_border_width ) ) {
				$page_wrapper_style['border-width'] = '1px';
			}
		}

		if ( ! empty( $page_wrapper_border_width ) ) {
			$page_wrapper_style['border-width'] = intval( $page_wrapper_border_width ) . 'px';
		}

		if ( ! empty( $page_wrapper_border_style ) ) {
			$page_wrapper_style['border-style'] = $page_wrapper_border_style;
		}

		if ( ! empty( $page_wrapper_style ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-wrapper', $page_wrapper_style );
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-header--fixed-display #qodef-page-header', $page_wrapper_style );
		}

		$page_wrapper_style_mobile = array();

		$page_wrapper_padding_mobile = qode_essential_addons_get_post_value_through_levels( 'qodef_page_wrapper_padding_mobile' );
		$page_wrapper_margin_mobile  = qode_essential_addons_get_post_value_through_levels( 'qodef_page_wrapper_margin_mobile' );

		if ( '' !== $page_wrapper_padding_mobile ) {
			$page_wrapper_style_mobile['padding'] = $page_wrapper_padding_mobile;
		}

		if ( '' !== $page_wrapper_margin_mobile ) {
			$page_wrapper_style_mobile['margin'] = $page_wrapper_margin_mobile;
		}

		if ( ! empty( $page_wrapper_style_mobile ) ) {
			$style .= qode_essential_addons_framework_dynamic_style_responsive( '#qodef-page-wrapper', $page_wrapper_style_mobile, '', '1024' );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_general_styles' );
}
