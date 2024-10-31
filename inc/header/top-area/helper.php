<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_dependency_for_top_area_options' ) ) {
	/**
	 * Function which return dependency values for global module options
	 *
	 * @return array
	 */
	function qode_essential_addons_dependency_for_top_area_options() {
		return apply_filters( 'qode_essential_addons_filter_top_area_hide_option', $hide_dep_options = array() );
	}
}

if ( ! function_exists( 'qode_essential_addons_register_top_area_header_areas' ) ) {
	/**
	 * Function which register widget areas for current module
	 */
	function qode_essential_addons_register_top_area_header_areas() {

		register_sidebar(
			array(
				'id'            => 'qodef-top-area-left',
				'name'          => esc_html__( 'Header Top Area - Left', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Widgets added here will appear on the left side in top header area', 'qode-essential-addons' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-area-left" data-area="top-area-left">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'qodef-top-area-right',
				'name'          => esc_html__( 'Header Top Area - Right', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Widgets added here will appear on the right side in top header area', 'qode-essential-addons' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-area-right" data-area="top-area-right">',
				'after_widget'  => '</div>',
			)
		);
	}

	add_action( 'qode_essential_addons_action_additional_header_widgets_area', 'qode_essential_addons_register_top_area_header_areas' );
}

if ( ! function_exists( 'qode_essential_addons_set_top_area_header_widget_area' ) ) {
	/**
	 * This function add additional header widgets area into global list
	 *
	 * @param array $widget_area_map
	 *
	 * @return array
	 */
	function qode_essential_addons_set_top_area_header_widget_area( $widget_area_map ) {

		if ( 'top-area-left' === $widget_area_map['header_layout'] ) {
			$widget_area_map['is_enabled']          = true;
			$widget_area_map['default_widget_area'] = 'qodef-top-area-left';
			$widget_area_map['custom_widget_area']  = '';
		} elseif ( 'top-area-right' === $widget_area_map['header_layout'] ) {
			$widget_area_map['is_enabled']          = true;
			$widget_area_map['default_widget_area'] = 'qodef-top-area-right';
			$widget_area_map['custom_widget_area']  = '';
		}

		return $widget_area_map;
	}

	add_filter( 'qode_essential_addons_filter_header_widget_area', 'qode_essential_addons_set_top_area_header_widget_area' );
}

if ( ! function_exists( 'qode_essential_addons_set_top_area_header_inner_classes' ) ) {
	/**
	 * Function that return classes for top header area
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_set_top_area_header_inner_classes( $classes ) {
		$skin      = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_widgets_skin' );
		$alignment = qode_essential_addons_get_post_value_through_levels( 'qodef_set_top_area_header_content_alignment' );

		if ( ! empty( $skin ) ) {
			$classes[] = 'qodef-widgets-skin--' . esc_attr( $skin );
		}

		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-alignment--' . esc_attr( $alignment );
		}

		return $classes;
	}

	add_filter( 'qode_essential_addons_filter_top_area_inner_class', 'qode_essential_addons_set_top_area_header_inner_classes' );
}
