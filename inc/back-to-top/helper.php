<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_is_back_to_top_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @return bool
	 */
	function qode_essential_addons_is_back_to_top_enabled() {
		return 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top' );
	}
}

if ( ! function_exists( 'qode_essential_addons_add_back_to_top_to_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = qode_essential_addons_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'qode_essential_addons_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function qode_essential_addons_load_back_to_top() {

		if ( qode_essential_addons_is_back_to_top_enabled() ) {
			$parameters = array();

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo apply_filters( 'qode_essential_addons_filter_back_to_top_template', qode_essential_addons_get_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters ) );
		}
	}

	add_action( 'wp_footer', 'qode_essential_addons_load_back_to_top' );
}

if ( ! function_exists( 'qode_essential_addons_set_back_to_top_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_back_to_top_styles( $style ) {
		$styles = array();

		$color         = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_color' );
		$bg_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_background_color' );
		$border_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_border_color' );
		$border_width  = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_border_width' );
		$border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_border_radius' );

		if ( ! empty( $color ) ) {
			$styles['color'] = $color;
		}

		if ( ! empty( $bg_color ) ) {
			$styles['background-color'] = $bg_color;
		}

		if ( ! empty( $border_color ) ) {
			$styles['border-color'] = $border_color;

			if ( empty( $border_width ) ) {
				$styles['border-width'] = '1px';
			}
		}

		if ( ! empty( $border_width ) ) {
			$styles['border-width'] = intval( $border_width ) . 'px';
		}

		if ( '' !== $border_radius ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $border_radius, true ) ) {
				$styles['border-radius'] = $border_radius;
			} else {
				$styles['border-radius'] = intval( $border_radius ) . 'px';
			}
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-back-to-top .qodef-back-to-top-icon',
				),
				$styles
			);
		}

		$hover_styles       = array();
		$hover_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_hover_color' );
		$bg_hover_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_background_hover_color' );
		$border_hover_color = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_border_hover_color' );

		if ( ! empty( $hover_color ) ) {
			$hover_styles['color'] = $hover_color;
		}

		if ( ! empty( $bg_hover_color ) ) {
			$hover_styles['background-color'] = $bg_hover_color;
		}

		if ( ! empty( $border_hover_color ) ) {
			$hover_styles['border-color'] = $border_hover_color;
		}

		if ( ! empty( $hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-back-to-top:hover .qodef-back-to-top-icon',
				),
				$hover_styles
			);
		}

		$icon_styles = array();
		$icon_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_back_to_top_icon_size' );

		if ( ! empty( $icon_size ) ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $icon_size, true ) ) {
				$icon_styles['width'] = $icon_size;
			} else {
				$icon_styles['width'] = intval( $icon_size ) . 'px';
			}
		}

		if ( ! empty( $icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-back-to-top .qodef-back-to-top-icon svg',
				),
				$icon_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_back_to_top_styles' );
}
