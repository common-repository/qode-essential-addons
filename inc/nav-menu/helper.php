<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_set_nav_menu_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_nav_menu_styles( $style ) {
		$styles = array();

		$dropdown_top_position = qode_essential_addons_get_post_value_through_levels( 'qodef_dropdown_top_position' );
		$dropdown_bg_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_dropdown_background_color' );
		$dropdown_box_shadow   = qode_essential_addons_get_post_value_through_levels( 'qodef_dropdown_box_shadow' );

		if ( '' !== $dropdown_top_position ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $dropdown_top_position, true ) ) {
				$styles['top'] = $dropdown_top_position;
			} else {
				$styles['top'] = intval( $dropdown_top_position ) . '%';
			}
		}

		if ( ! empty( $dropdown_bg_color ) ) {
			$styles['background-color'] = $dropdown_bg_color;
		}

		if ( ! empty( $dropdown_box_shadow ) ) {
			$styles['box-shadow'] = $dropdown_box_shadow;
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-header-navigation ul li > .sub-menu', $styles );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_nav_menu_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_nav_menu_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_nav_menu_typography_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_styles          = qode_essential_addons_get_typography_styles( $scope, 'qodef_nav_1st_lvl' );
		$first_lvl_hover_styles    = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_nav_1st_lvl' );
		$second_lvl_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_nav_2nd_lvl' );
		$second_lvl_hover_styles   = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_nav_2nd_lvl' );
		$first_lvl_decoration_draw = qode_essential_addons_framework_get_option_value( $scope, 'admin', 'qodef_nav_1st_lvl_hover_text_decoration_draw' );

		$header_selector      = apply_filters( 'qode_essential_addons_filter_nav_menu_header_selector', '.qodef-header-navigation' );
		$narrow_menu_selector = apply_filters( 'qode_essential_addons_filter_nav_menu_narrow_header_selector', '.qodef-menu-item--narrow' );

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-header .widget.woocommerce.widget_shopping_cart .widgettitle', $first_lvl_styles );
		}

		$first_lvl_side_padding = qode_essential_addons_get_option_value( 'admin', 'qodef_nav_1st_lvl_padding' );
		if ( '' !== $first_lvl_side_padding ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $first_lvl_side_padding, true ) ) {
				$first_lvl_styles['padding-left']  = $first_lvl_side_padding;
				$first_lvl_styles['padding-right'] = $first_lvl_side_padding;
			} else {
				$first_lvl_styles['padding-left']  = intval( $first_lvl_side_padding ) . 'px';
				$first_lvl_styles['padding-right'] = intval( $first_lvl_side_padding ) . 'px';
			}
		}

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( $header_selector . '> ul > li > a, #qodef-page-header .widget_qode_essential_addons_icon_svg .qodef-m-text', $first_lvl_styles );
		}

		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					$header_selector . '> ul > li > a:hover',
					$header_selector . '> ul > li > a:focus',
				),
				$first_lvl_hover_styles
			);
		}

		$first_lvl_active_styles          = array();
		$first_lvl_active_color           = qode_essential_addons_get_option_value( 'admin', 'qodef_nav_1st_lvl_active_color' );
		$first_lvl_active_text_decoration = qode_essential_addons_get_option_value( 'admin', 'qodef_nav_1st_lvl_hover_text_decoration' );

		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles['color'] = $first_lvl_active_color;
		}

		if ( ! empty( $first_lvl_active_text_decoration ) && 'yes' !== $first_lvl_decoration_draw ) {
			$first_lvl_active_styles['text-decoration'] = $first_lvl_active_text_decoration;
		}

		if ( ! empty( $first_lvl_active_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					$header_selector . '> ul > li.current-menu-ancestor > a',
					$header_selector . '> ul > li.current-menu-item > a',
				),
				$first_lvl_active_styles
			);
		}

		$first_lvl_side_margin = qode_essential_addons_get_option_value( 'admin', 'qodef_nav_1st_lvl_margin' );
		if ( '' !== $first_lvl_side_margin ) {
			$first_lvl_li_styles = array();

			if ( qode_essential_addons_framework_string_ends_with_space_units( $first_lvl_side_margin, true ) ) {
				$first_lvl_li_styles['margin-left']  = $first_lvl_side_margin;
				$first_lvl_li_styles['margin-right'] = $first_lvl_side_margin;
			} else {
				$first_lvl_li_styles['margin-left']  = intval( $first_lvl_side_margin ) . 'px';
				$first_lvl_li_styles['margin-right'] = intval( $first_lvl_side_margin ) . 'px';
			}

			$style .= qode_essential_addons_framework_dynamic_style( array( $header_selector . '> ul > li' ), $first_lvl_li_styles );
		}

		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( $header_selector . ' > ul > li' . $narrow_menu_selector . ' ul li a', $second_lvl_styles );
		}

		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					$header_selector . ' > ul > li' . $narrow_menu_selector . ' ul li:hover > a',
					$header_selector . ' > ul > li' . $narrow_menu_selector . ' ul li:focus > a',
				),
				$second_lvl_hover_styles
			);
		}

		$second_lvl_active_styles          = array();
		$second_lvl_active_color           = qode_essential_addons_get_option_value( 'admin', 'qodef_nav_2nd_lvl_active_color' );
		$second_lvl_active_text_decoration = qode_essential_addons_get_option_value( 'admin', 'qodef_nav_2nd_lvl_hover_text_decoration' );

		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles['color'] = $second_lvl_active_color;
		}

		if ( ! empty( $second_lvl_active_text_decoration && 'yes' !== $first_lvl_decoration_draw ) ) {
			$second_lvl_active_styles['text-decoration'] = $second_lvl_active_text_decoration;
		}

		if ( ! empty( $second_lvl_active_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					$header_selector . ' > ul > li' . $narrow_menu_selector . ' ul li.current-menu-ancestor > a',
					$header_selector . ' > ul > li' . $narrow_menu_selector . ' ul li.current-menu-item > a',
				),
				$second_lvl_active_styles
			);
		}

		$second_lvl_offset = qode_essential_addons_get_option_value( 'admin', 'qodef_nav_2st_lvl_offset' );
		if ( '' !== $second_lvl_offset ) {
			$offset = 0;
			if ( qode_essential_addons_framework_string_ends_with_space_units( $second_lvl_offset, true ) ) {
				$offset = $second_lvl_offset;
			} else {
				$offset = intval( $second_lvl_offset ) . 'px';
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-header-navigation ul li ul:not(.qodef-drop-down--right)',
				),
				array(
					'left' => $offset,
				)
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-header-navigation ul li ul.qodef-drop-down--right',
				),
				array(
					'right' => $offset,
				)
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_nav_menu_typography_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_nav_menu_draw_classes' ) ) {

	function qode_essential_addons_set_nav_menu_draw_classes( $classes ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_classes  = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_nav_1st_lvl' );
		$second_lvl_classes = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_nav_2nd_lvl' );

		if ( ! empty( $first_lvl_classes ) ) {
			$classes [] = $first_lvl_classes;
		}

		if ( ! empty( $second_lvl_classes ) ) {
			$classes [] = $second_lvl_classes;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_set_nav_menu_draw_classes' );
}
