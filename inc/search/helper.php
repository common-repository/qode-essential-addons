<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_search_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function qode_essential_addons_search_include_widgets() {
		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/search/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_essential_addons_action_framework_before_widgets_register', 'qode_essential_addons_search_include_widgets' );
}

if ( ! function_exists( 'qode_essential_addons_search_include_layout' ) ) {
	/**
	 * Function that includes module variations
	 *
	 * @instance QodeEssentialAddons_Headers
	 */
	function qode_essential_addons_search_include_layout() {
		$header_object = QodeEssentialAddons_Headers::get_instance()->get_header_object();

		if ( ! empty( $header_object ) ) {
			$search_layout = $header_object->get_search_layout();
			$layouts       = apply_filters( 'qode_essential_addons_filter_register_search_layouts', $header_layouts_option = array() );

			if ( ! empty( $layouts ) ) {
				foreach ( $layouts as $key => $value ) {
					if ( $search_layout === $key ) {
						$value::get_instance();
					}
				}
			}
		}
	}

	add_action( 'wp', 'qode_essential_addons_search_include_layout' );
}

if ( ! function_exists( 'qode_essential_addons_set_search_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_search_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$area_styles      = array();
		$background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_search_background_color' );
		$border_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_search_border_color' );
		$border_width     = qode_essential_addons_get_post_value_through_levels( 'qodef_search_border_width' );
		$border_style     = qode_essential_addons_get_post_value_through_levels( 'qodef_search_border_style' );

		if ( ! empty( $background_color ) ) {
			$area_styles['background'] = $background_color;
		}

		if ( ! empty( $border_color ) ) {
			$area_styles['border-bottom-color'] = $border_color;
			if ( empty( $border_width ) ) {
				$area_styles['border-bottom-width'] = '1px';
			}
		}

		if ( ! empty( $border_width ) ) {
			$area_styles['border-bottom-width'] = intval( $border_width ) . 'px';
		}

		if ( ! empty( $border_style ) ) {
			$area_styles['border-bottom-style'] = $border_style;
		}

		if ( ! empty( $area_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-search-cover-form', $area_styles );
		}

		$opener_styles = array();
		$opener_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_search_opener_color' );

		if ( ! empty( $opener_color ) ) {
			$opener_styles['color'] = $opener_color;
		}

		if ( ! empty( $opener_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-search-opener', $opener_styles );
		}

		$opener_icon_styles = array();
		$opener_icon_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_search_opener_size' );

		if ( ! empty( $opener_icon_size ) ) {
			$opener_icon_styles['width'] = intval( $opener_icon_size ) . 'px';
		}

		if ( ! empty( $opener_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-search-opener .qodef-m-icon', $opener_icon_styles );
		}

		$opener_label_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_search_opener' );

		if ( ! empty( $opener_label_styles ) ) {

			if ( isset( $opener_label_styles['color'] ) ) {
				unset( $opener_label_styles['color'] );
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-search-opener .qodef-m-text',
				),
				$opener_label_styles
			);
		}

		$opener_hover_styles = array();
		$opener_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_search_opener_hover_color' );

		if ( ! empty( $opener_hover_color ) ) {
			$opener_hover_styles['color'] = $opener_hover_color;
		}

		if ( ! empty( $opener_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-search-opener:hover',
					'.qodef-search-opener:focus',
				),
				$opener_hover_styles
			);
		}

		$close_icon_styles = array();
		$close_icon_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_search_close_icon_color' );
		$close_icon_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_search_close_icon_size' );

		if ( ! empty( $close_icon_color ) ) {
			$close_icon_styles['color'] = $close_icon_color;
		}

		if ( ! empty( $close_icon_size ) ) {
			$close_icon_styles['width'] = intval( $close_icon_size ) . 'px';
		}

		if ( ! empty( $close_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-search-cover-form .qodef-m-close', $close_icon_styles );
		}

		$close_icon_hover_styles = array();
		$close_icon_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_search_close_icon_hover_color' );

		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_styles['color'] = $close_icon_hover_color;
		}

		if ( ! empty( $close_icon_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-search-cover-form .qodef-m-close:hover', $close_icon_hover_styles );
		}

		$input_field_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_search_input_field' );

		if ( ! empty( $input_field_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-search-cover-form .qodef-m-form-field',
				),
				$input_field_styles
			);
		}

		$input_field_focus_styles = array();
		$input_field_focus_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_search_input_field_focus_color' );

		if ( ! empty( $input_field_focus_color ) ) {
			$input_field_focus_styles['color'] = $input_field_focus_color;
		}

		if ( ! empty( $input_field_focus_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-search-cover-form .qodef-m-form-field:focus', $input_field_focus_styles );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_search_styles' );
}
