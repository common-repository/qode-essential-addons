<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_sticky_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function qode_essential_addons_add_sticky_header_option( $options ) {
		$options['sticky'] = esc_html__( 'Sticky', 'qode-essential-addons' );

		return $options;
	}

	add_filter( 'qode_essential_addons_filter_header_scroll_appearance_option', 'qode_essential_addons_add_sticky_header_option' );
}

if ( ! function_exists( 'qode_essential_addons_sticky_header_global_js_var' ) ) {
	/**
	 * Function that extend global js variables
	 *
	 * @param array $global_variables
	 *
	 * @return array
	 */
	function qode_essential_addons_sticky_header_global_js_var( $global_variables ) {
		$header_scroll_appearance = qode_essential_addons_get_post_value_through_levels( 'qodef_header_scroll_appearance' );

		if ( 'sticky' === $header_scroll_appearance ) {
			$sticky_scroll_amount_meta = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_scroll_amount' );
			$sticky_scroll_amount      = '' !== $sticky_scroll_amount_meta ? intval( $sticky_scroll_amount_meta ) : 0;

			$global_variables['qodefStickyHeaderScrollAmount'] = $sticky_scroll_amount;
		}

		return $global_variables;
	}

	add_filter( 'qode_essential_addons_filter_localize_main_js', 'qode_essential_addons_sticky_header_global_js_var' );
}

if ( ! function_exists( 'qode_essential_addons_register_sticky_header_areas' ) ) {
	/**
	 * Function that registers widget area for sticky header
	 */
	function qode_essential_addons_register_sticky_header_areas() {
		register_sidebar(
			array(
				'id'            => 'qodef-sticky-header-widget-area-one',
				'name'          => esc_html__( 'Sticky Header - Widget Area', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Widgets added here will appear in sticky header widget area', 'qode-essential-addons' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-sticky-header-widget-area-one" data-area="sticky-header-widget-one">',
				'after_widget'  => '</div>',
			)
		);
	}

	add_action( 'qode_essential_addons_action_additional_header_widgets_area', 'qode_essential_addons_register_sticky_header_areas', 7 );
}

if ( ! function_exists( 'qode_essential_addons_set_sticky_area_header_widget_area' ) ) {
	/**
	 * This function add additional header widgets area into global list
	 *
	 * @param array $widget_area_map
	 *
	 * @return array
	 */
	function qode_essential_addons_set_sticky_area_header_widget_area( $widget_area_map ) {

		if ( 'sticky-header-widget-area-one' === $widget_area_map['header_layout'] ) {
			$widget_area_map['is_enabled']          = true;
			$widget_area_map['default_widget_area'] = 'qodef-sticky-header-widget-area-one';
			$widget_area_map['custom_widget_area']  = '';
		}

		return $widget_area_map;
	}

	add_filter( 'qode_essential_addons_filter_header_widget_area', 'qode_essential_addons_set_sticky_area_header_widget_area' );
}

if ( ! function_exists( 'qode_essential_addons_set_sticky_header_logo_svg_path' ) ) {
	/**
	 * This function set header logo svg path for current scroll appearance type
	 *
	 * @param string $logo_svg_path
	 * @param array $parameters
	 *
	 * @return string
	 */
	function qode_essential_addons_set_sticky_header_logo_svg_path( $logo_svg_path, $parameters ) {
		$sticky_logo_svg_path = qode_essential_addons_get_post_value_through_levels( 'qodef_logo_sticky_svg_path' );

		if ( ! empty( $sticky_logo_svg_path ) && isset( $parameters['sticky_logo'] ) && ! empty( $parameters['sticky_logo'] ) ) {
			$logo_svg_path = $sticky_logo_svg_path;
		}

		return $logo_svg_path;
	}

	add_filter( 'qode_essential_addons_filter_header_logo_svg_path', 'qode_essential_addons_set_sticky_header_logo_svg_path', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_set_sticky_header_logo_image' ) ) {
	/**
	 * This function set header logo image for current scroll appearance type
	 *
	 * @param array $available_logo_images
	 * @param array $parameters
	 *
	 * @return array
	 */
	function qode_essential_addons_set_sticky_header_logo_image( $available_logo_images, $parameters ) {

		if ( isset( $parameters['sticky_logo'] ) && ! empty( $parameters['sticky_logo'] ) ) {
			$available_logo_images         = array();
			$available_logo_images['main'] = 'sticky';
		}

		return $available_logo_images;
	}

	add_filter( 'qode_essential_addons_filter_available_header_logo_images', 'qode_essential_addons_set_sticky_header_logo_image', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_set_additional_sticky_header_classes' ) ) {
	/**
	 * This function add additional sticky header area inner classes
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_set_additional_sticky_header_classes( $classes ) {
		$header_appearance = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_appearance' );
		$classes[]         = 'qodef-appearance--' . ( ! empty( $header_appearance ) ? esc_attr( $header_appearance ) : 'down' );

		return $classes;
	}

	add_filter( 'qode_essential_addons_filter_sticky_header_class', 'qode_essential_addons_set_additional_sticky_header_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_sticky_header_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_sticky_header_area_styles( $style ) {
		$styles = array();

		$header_height    = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_height' );
		$background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_background_color' );

		if ( ! empty( $header_height ) ) {
			$styles['height'] = intval( $header_height ) . 'px';
		}

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-header-sticky', $styles );
		}

		$inner_styles = array();

		$side_padding = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_side_padding' );
		$border_color = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_border_color' );
		$border_width = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_border_width' );
		$border_style = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_border_style' );
		$box_shadow   = qode_essential_addons_get_post_value_through_levels( 'qodef_sticky_header_box_shadow' );

		if ( '' !== $side_padding ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $side_padding ) ) {
				$inner_styles['padding-left']  = $side_padding;
				$inner_styles['padding-right'] = $side_padding;
			} else {
				$inner_styles['padding-left']  = intval( $side_padding ) . 'px';
				$inner_styles['padding-right'] = intval( $side_padding ) . 'px';
			}
		}

		if ( ! empty( $border_color ) ) {
			$inner_styles['border-bottom-color'] = $border_color;

			if ( empty( $border_width ) ) {
				$inner_styles['border-bottom-width'] = '1px';
			}
		}

		if ( ! empty( $border_width ) ) {
			$inner_styles['border-bottom-width'] = intval( $border_width ) . 'px';
		}

		if ( ! empty( $border_style ) ) {
			$inner_styles['border-bottom-style'] = $border_style;
		}

		if ( ! empty( $box_shadow ) ) {
			$inner_styles['box-shadow'] = $box_shadow;
		}

		if ( ! empty( $inner_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-header-sticky .qodef-header-sticky-inner', $inner_styles );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_sticky_header_area_styles' );
}
