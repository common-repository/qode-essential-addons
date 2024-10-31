<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_is_page_footer_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function qode_essential_addons_is_page_footer_enabled( $is_enabled ) {
		$option = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_enable_page_footer' );

		if ( ! $option ) {
			$is_enabled = false;
		}

		return $is_enabled;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_enable_page_footer', 'qode_essential_addons_is_page_footer_enabled' );
	add_filter( 'the_q_filter_enable_page_footer', 'qode_essential_addons_is_page_footer_enabled' );
	add_filter( 'qi_filter_enable_page_footer', 'qode_essential_addons_is_page_footer_enabled' );
	add_filter( 'qi_gutenberg_filter_enable_page_footer', 'qode_essential_addons_is_page_footer_enabled' );
}

if ( ! function_exists( 'qode_essential_addons_set_page_footer_classes' ) ) {
	/**
	 * Function that return classes for page footer area
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_set_page_footer_classes( $classes ) {
		$skin = qode_essential_addons_get_post_value_through_levels( 'qodef_page_footer_widgets_skin' );

		if ( ! empty( $skin ) ) {
			$classes[] = 'qodef-widgets-skin--' . esc_attr( $skin );
		}

		return $classes;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_footer_holder_classes', 'qode_essential_addons_set_page_footer_classes' );
	add_filter( 'the_q_filter_footer_holder_classes', 'qode_essential_addons_set_page_footer_classes' );
	add_filter( 'qi_filter_footer_holder_classes', 'qode_essential_addons_set_page_footer_classes' );
	add_filter( 'qi_gutenberg_filter_footer_holder_classes', 'qode_essential_addons_set_page_footer_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_footer_top_area_classes' ) ) {
	/**
	 * Function that return classes for page footer top area
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function qode_essential_addons_set_footer_top_area_classes( $classes ) {
		$is_grid_enabled = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_top_area_in_grid' );

		if ( ! $is_grid_enabled ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_footer_top_area_classes', 'qode_essential_addons_set_footer_top_area_classes' );
	add_filter( 'the_q_filter_footer_top_area_classes', 'qode_essential_addons_set_footer_top_area_classes' );
	add_filter( 'qi_filter_footer_top_area_classes', 'qode_essential_addons_set_footer_top_area_classes' );
	add_filter( 'qi_gutenberg_filter_footer_top_area_classes', 'qode_essential_addons_set_footer_top_area_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_footer_bottom_area_classes' ) ) {
	/**
	 * Function that return classes for page footer bottom area
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function qode_essential_addons_set_footer_bottom_area_classes( $classes ) {
		$is_grid_enabled = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_bottom_area_in_grid' );

		if ( ! $is_grid_enabled ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_footer_bottom_area_classes', 'qode_essential_addons_set_footer_bottom_area_classes' );
	add_filter( 'the_q_filter_footer_bottom_area_classes', 'qode_essential_addons_set_footer_bottom_area_classes' );
	add_filter( 'qi_filter_footer_bottom_area_classes', 'qode_essential_addons_set_footer_bottom_area_classes' );
	add_filter( 'qi_gutenberg_filter_footer_bottom_area_classes', 'qode_essential_addons_set_footer_bottom_area_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_footer_sidebars_config' ) ) {
	/**
	 * Function that override default page footer sidebars config
	 *
	 * @param array $config
	 *
	 * @return array
	 */
	function qode_essential_addons_set_footer_sidebars_config( $config ) {
		$top_area_columns    = qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_top_area_columns' );
		$bottom_area_columns = qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_bottom_area_columns' );

		if ( ! empty( $top_area_columns ) ) {
			$config['footer_top_sidebars_number'] = $top_area_columns;
		}

		if ( ! empty( $bottom_area_columns ) ) {
			$config['footer_bottom_sidebars_number'] = $bottom_area_columns;
		}

		return $config;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_page_footer_sidebars_config', 'qode_essential_addons_set_footer_sidebars_config' );
	add_filter( 'the_q_filter_page_footer_sidebars_config', 'qode_essential_addons_set_footer_sidebars_config' );
	add_filter( 'qi_filter_page_footer_sidebars_config', 'qode_essential_addons_set_footer_sidebars_config' );
	add_filter( 'qi_gutenberg_filter_page_footer_sidebars_config', 'qode_essential_addons_set_footer_sidebars_config' );
}

if ( ! function_exists( 'qode_essential_addons_set_footer_top_area_columns_classes' ) ) {
	/**
	 * Function that set classes for page footer top area columns
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_set_footer_top_area_columns_classes( $classes ) {
		$gutter_size = qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_top_area_grid_gutter' );
		$alignment   = qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_top_area_content_alignment' );

		if ( ! empty( $gutter_size ) ) {
			$classes[] = 'qodef-gutter--' . esc_attr( $gutter_size );
		} else {
			$classes[] = 'qodef-gutter--normal';
		}

		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-alignment--' . esc_attr( $alignment );
		}

		return $classes;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_footer_top_area_columns_classes', 'qode_essential_addons_set_footer_top_area_columns_classes' );
	add_filter( 'the_q_filter_footer_top_area_columns_classes', 'qode_essential_addons_set_footer_top_area_columns_classes' );
	add_filter( 'qi_filter_footer_top_area_columns_classes', 'qode_essential_addons_set_footer_top_area_columns_classes' );
	add_filter( 'qi_gutenberg_filter_footer_top_area_columns_classes', 'qode_essential_addons_set_footer_top_area_columns_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_footer_bottom_area_columns_classes' ) ) {
	/**
	 * Function that set classes for page footer bottom area columns
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_set_footer_bottom_area_columns_classes( $classes ) {
		$gutter_size = qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_bottom_area_grid_gutter' );
		$alignment   = qode_essential_addons_get_post_value_through_levels( 'qodef_set_footer_bottom_area_content_alignment' );

		if ( ! empty( $gutter_size ) ) {
			$classes[] = 'qodef-gutter--' . esc_attr( $gutter_size );
		} else {
			$classes[] = 'qodef-gutter--normal';
		}

		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-alignment--' . esc_attr( $alignment );
		}

		return $classes;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_footer_bottom_area_columns_classes', 'qode_essential_addons_set_footer_bottom_area_columns_classes' );
	add_filter( 'the_q_filter_footer_bottom_area_columns_classes', 'qode_essential_addons_set_footer_bottom_area_columns_classes' );
	add_filter( 'qi_filter_footer_bottom_area_columns_classes', 'qode_essential_addons_set_footer_bottom_area_columns_classes' );
	add_filter( 'qi_gutenberg_filter_footer_bottom_area_columns_classes', 'qode_essential_addons_set_footer_bottom_area_columns_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_page_footer_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_page_footer_area_styles( $style ) {
		$footer_area = array( 'top', 'bottom' );

		foreach ( $footer_area as $area ) {
			$styles           = array();
			$background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_background_color' );
			$background_image = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_background_image' );

			if ( ! empty( $background_color ) ) {
				$styles['background-color'] = $background_color;
			}

			if ( ! empty( $background_image ) ) {
				$styles['background-image'] = 'url(' . esc_url( qode_essential_addons_get_attachment_image_url( $background_image, 'full' ) ) . ')';
			}

			if ( ! empty( $styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area', $styles );
			}

			$inner_styles = array();

			$columns_size     = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_columns_size' );
			$padding_top      = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_padding_top' );
			$padding_bottom   = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_padding_bottom' );
			$side_padding     = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_side_padding' );
			$top_border_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_top_border_color' );
			$top_border_width = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_top_border_width' );
			$top_border_style = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_top_border_style' );

			if ( ! empty( $columns_size ) ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $columns_size ) ) {
					$inner_styles['max-width'] = $columns_size;
				} else {
					$inner_styles['max-width'] = intval( $columns_size ) . 'px';
				}
			}

			if ( '' !== $padding_top ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $padding_top, true ) ) {
					$inner_styles['padding-top'] = $padding_top;
				} else {
					$inner_styles['padding-top'] = intval( $padding_top ) . 'px';
				}
			}

			if ( '' !== $padding_bottom ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $padding_bottom, true ) ) {
					$inner_styles['padding-bottom'] = $padding_bottom;
				} else {
					$inner_styles['padding-bottom'] = intval( $padding_bottom ) . 'px';
				}
			}

			if ( '' !== $side_padding ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $side_padding, true ) ) {
					$inner_styles['padding-left']  = $side_padding . '!important';
					$inner_styles['padding-right'] = $side_padding . '!important';
				} else {
					$inner_styles['padding-left']  = intval( $side_padding ) . 'px !important';
					$inner_styles['padding-right'] = intval( $side_padding ) . 'px !important';
				}
			}

			if ( ! empty( $top_border_color ) ) {
				$inner_styles['border-top-color'] = $top_border_color;

				if ( '' === $top_border_width ) {
					$inner_styles['border-top-width'] = '1px';
				}
			}

			if ( '' !== $top_border_width ) {
				$inner_styles['border-top-width'] = intval( $top_border_width ) . 'px';
			}

			if ( ! empty( $top_border_style ) ) {
				$inner_styles['border-top-style'] = $top_border_style;
			}

			if ( ! empty( $inner_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area-inner', $inner_styles );
			}

			$widgets_styles = array();
			$margin_bottom  = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_widgets_margin_bottom' );

			if ( ! empty( $margin_bottom ) ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $margin_bottom, true ) ) {
					$widgets_styles['margin-bottom'] = $margin_bottom;
				} else {
					$widgets_styles['margin-bottom'] = intval( $margin_bottom ) . 'px';
				}
			}

			if ( ! empty( $widgets_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area .widget', $widgets_styles );
			}

			$widgets_title_styles = array();
			$title_margin_bottom  = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_widgets_title_margin_bottom' );

			if ( ! empty( $title_margin_bottom ) ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $title_margin_bottom, true ) ) {
					$widgets_title_styles['margin-bottom'] = $title_margin_bottom;
				} else {
					$widgets_title_styles['margin-bottom'] = intval( $title_margin_bottom ) . 'px';
				}
			}

			if ( ! empty( $widgets_title_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area .widget .qodef-widget-title', $widgets_title_styles );
			}
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_page_footer_area_styles' );
}
