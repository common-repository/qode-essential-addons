<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_register_fullscreen_menu' ) ) {
	/**
	 * Function which add additional main menu navigation into global list
	 *
	 * @param array $menus
	 *
	 * @return array
	 */
	function qode_essential_addons_register_fullscreen_menu( $menus ) {
		$menus['fullscreen-menu-navigation'] = esc_html__( 'Fullscreen Navigation', 'qode-essential-addons' );

		return $menus;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_register_navigation_menus', 'qode_essential_addons_register_fullscreen_menu' );
	add_filter( 'the_q_filter_register_navigation_menus', 'qode_essential_addons_register_fullscreen_menu' );
	add_filter( 'qi_filter_register_navigation_menus', 'qode_essential_addons_register_fullscreen_menu' );
	add_filter( 'qi_gutenberg_filter_register_navigation_menus', 'qode_essential_addons_register_fullscreen_menu' );
}

if ( ! function_exists( 'qode_essential_addons_add_fullscreen_menu_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_fullscreen_menu_body_classes( $classes ) {
		$hide_logo = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_menu_hide_logo' );

		if ( 'yes' === $hide_logo ) {
			$classes[] = 'qodef-fullscreen-menu--hide-logo';
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_add_fullscreen_menu_body_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_fullscreen_menu_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_fullscreen_menu_styles( $style ) {
		$area_styles         = array();
		$area_inner_styles   = array();
		$background_color    = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_menu_background_color' );
		$background_image    = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_menu_background_image' );
		$background_repeat   = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_background_repeat' );
		$background_size     = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_background_size' );
		$background_position = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_background_position' );
		$menu_alignment      = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_menu_content_alignment' );

		if ( ! empty( $background_color ) ) {
			$area_styles['background-color'] = $background_color;
		}

		if ( ! empty( $background_image ) ) {
			$area_styles['background-image'] = 'url(' . esc_url( qode_essential_addons_get_attachment_image_url( $background_image, 'full' ) ) . ')';
		}

		if ( ! empty( $background_repeat ) ) {
			$area_styles['background-repeat'] = $background_repeat;
		}

		if ( ! empty( $background_size ) ) {
			$area_styles['background-size'] = $background_size;
		}

		if ( ! empty( $background_position ) ) {
			$area_styles['background-position'] = $background_position;
		}

		if ( ! empty( $menu_alignment ) ) {
			$area_styles['text-align'] = $menu_alignment;
		}

		if ( ! empty( $menu_alignment ) && 'center' === $menu_alignment ) {
			$area_inner_styles['flex-direction'] = 'column';
		}

		if ( ! empty( $menu_alignment ) && 'right' === $menu_alignment ) {
			$area_inner_styles['flex-direction'] = 'row-reverse';
		}

		if ( ! empty( $area_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-fullscreen-area', $area_styles );
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-fullscreen-area-inner', $area_inner_styles );
		}

		$opener_styles       = array();
		$opener_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_opener_color' );
		$opener_size         = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_opener_size' );
		$opener_side_padding = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_opener_side_padding' );

		if ( ! empty( $opener_color ) ) {
			$opener_styles['color'] = $opener_color;
		}

		if ( ! empty( $opener_size ) ) {
			$opener_styles['width'] = intval( $opener_size ) . 'px';
		}

		if ( ! empty( $opener_side_padding ) ) {
			$opener_styles['padding'] = '0 ' . intval( $opener_side_padding ) . 'px !important';
		}

		if ( ! empty( $opener_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-fullscreen-menu-opener', $opener_styles );
		}

		$opener_hover_styles = array();
		$opener_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_opener_hover_color' );

		if ( ! empty( $opener_hover_color ) ) {
			$opener_hover_styles['color'] = $opener_hover_color;
		}

		if ( ! empty( $opener_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-fullscreen-menu-opener:hover',
					'.qodef-fullscreen-menu-opener:focus',
				),
				$opener_hover_styles
			);
		}

		$close_icon_styles    = array();
		$close_icon_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_close_icon_color' );
		$close_icon_size      = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_close_icon_size' );
		$close_icon_top_pos   = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_close_icon_top_position' );
		$close_icon_right_pos = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_close_icon_right_position' );

		if ( ! empty( $close_icon_color ) ) {
			$close_icon_styles['color'] = $close_icon_color;
		}

		if ( ! empty( $close_icon_size ) ) {
			$close_icon_styles['width'] = intval( $close_icon_size ) . 'px';
		}

		if ( '' !== $close_icon_top_pos ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $close_icon_top_pos ) ) {
				$close_icon_styles['top'] = $close_icon_top_pos;
			} else {
				$close_icon_styles['top'] = intval( $close_icon_top_pos ) . 'px';
			}
		}

		if ( '' !== $close_icon_right_pos ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $close_icon_right_pos ) ) {
				$close_icon_styles['right'] = $close_icon_right_pos;
			} else {
				$close_icon_styles['right'] = intval( $close_icon_right_pos ) . 'px';
			}
		}

		if ( ! empty( $close_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-fullscreen-area .qodef-fullscreen-menu-close', $close_icon_styles );
		}

		$close_icon_hover_styles = array();
		$close_icon_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_close_icon_hover_color' );

		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_styles['color'] = $close_icon_hover_color;
		}

		if ( ! empty( $close_icon_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-fullscreen-area .qodef-fullscreen-menu-close:hover',
					'#qodef-fullscreen-area .qodef-fullscreen-menu-close:focus',
				),
				$close_icon_hover_styles
			);
		}

		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_styles        = qode_essential_addons_get_typography_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$first_lvl_margin        = qode_essential_addons_get_option_value( 'admin', 'qodef_fullscreen_1st_lvl_margin' );
		$first_lvl_hover_styles  = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$second_lvl_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_fullscreen_2nd_lvl' );
		$second_lvl_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_fullscreen_2nd_lvl' );

		if ( '' !== $first_lvl_margin ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $first_lvl_margin, true ) ) {
				$first_lvl_styles['margin-top']    = $first_lvl_margin;
				$first_lvl_styles['margin-bottom'] = $first_lvl_margin;
			} else {
				$first_lvl_styles['margin-top']    = intval( $first_lvl_margin ) . 'px';
				$first_lvl_styles['margin-bottom'] = intval( $first_lvl_margin ) . 'px';
			}
		}

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a', $first_lvl_styles );
		}

		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a:hover', $first_lvl_hover_styles );
		}

		$first_lvl_active_styles          = array();
		$first_lvl_active_color           = qode_essential_addons_get_option_value( 'admin', 'qodef_fullscreen_1st_lvl_active_color' );
		$first_lvl_active_text_decoration = qode_essential_addons_get_option_value( 'admin', 'qodef_fullscreen_1st_lvl_hover_text_decoration' );

		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles['color'] = $first_lvl_active_color;
		}

		if ( ! empty( $first_lvl_active_text_decoration ) ) {
			$first_lvl_active_styles['text-decoration'] = $first_lvl_active_text_decoration;
		}

		if ( ! empty( $first_lvl_active_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-fullscreen-menu > ul > li.current-menu-ancestor > a',
					'.qodef-fullscreen-menu > ul > li.current-menu-item > a',
				),
				$first_lvl_active_styles
			);
		}

		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-fullscreen-menu ul li ul li > a', $second_lvl_styles );
		}

		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-fullscreen-menu ul li ul li > a:hover', $second_lvl_hover_styles );
		}

		$second_lvl_active_styles          = array();
		$second_lvl_active_color           = qode_essential_addons_get_option_value( 'admin', 'qodef_fullscreen_2nd_lvl_active_color' );
		$second_lvl_active_text_decoration = qode_essential_addons_get_option_value( 'admin', 'qodef_fullscreen_2st_lvl_hover_text_decoration' );

		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles['color'] = $second_lvl_active_color;
		}

		if ( ! empty( $second_lvl_active_text_decoration ) ) {
			$second_lvl_active_styles['text-decoration'] = $second_lvl_active_text_decoration;
		}

		if ( ! empty( $second_lvl_active_color ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-fullscreen-menu ul li ul li.current-menu-ancestor > a',
					'.qodef-fullscreen-menu ul li ul li.current-menu-item > a',
				),
				$second_lvl_active_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_fullscreen_menu_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_fullscreen_menu_responsive_1024_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_fullscreen_menu_responsive_1024_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_fullscreen_1st_lvl_responsive_1024' );

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a', $first_lvl_styles );
		}

		$close_icon_styles    = array();
		$close_icon_top_pos   = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_close_icon_top_position_1024' );
		$close_icon_right_pos = qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_close_icon_right_position_1024' );

		if ( '' !== $close_icon_top_pos ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $close_icon_top_pos ) ) {
				$close_icon_styles['top'] = $close_icon_top_pos;
			} else {
				$close_icon_styles['top'] = intval( $close_icon_top_pos ) . 'px';
			}
		}

		if ( '' !== $close_icon_right_pos ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $close_icon_right_pos ) ) {
				$close_icon_styles['right'] = $close_icon_right_pos;
			} else {
				$close_icon_styles['right'] = intval( $close_icon_right_pos ) . 'px';
			}
		}

		if ( ! empty( $close_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-fullscreen-area .qodef-fullscreen-menu-close', $close_icon_styles );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_responsive_1024_inline_style', 'qode_essential_addons_set_fullscreen_menu_responsive_1024_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_fullscreen_menu_responsive_680_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_fullscreen_menu_responsive_680_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_fullscreen_1st_lvl_responsive_680' );

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a', $first_lvl_styles );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_responsive_680_inline_style', 'qode_essential_addons_set_fullscreen_menu_responsive_680_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_fullscreen_menu_draw_classes' ) ) {

	function qode_essential_addons_set_fullscreen_menu_draw_classes( $classes ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_classes = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_fullscreen_1st_lvl' );

		if ( ! empty( $first_lvl_classes ) ) {
			$classes [] = $first_lvl_classes;
		}

		$second_lvl_classes = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_fullscreen_2nd_lvl' );

		if ( ! empty( $second_lvl_classes ) ) {
			$classes [] = $second_lvl_classes;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_set_fullscreen_menu_draw_classes' );
}
