<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

abstract class QodeEssentialAddons_Mobile_Header {
	private $layout;
	private $layout_slug = '';
	protected $default_header_height;
	protected $header_height;

	public function __construct() {
		$this->set_header_height();
		add_filter( 'qode_essential_addons_filter_add_inline_style', array( $this, 'set_inline_mobile_header_styles' ) );
		add_filter( 'qode_essential_addons_filter_content_margin_mobile', array( $this, 'get_content_margin' ) );
		add_filter( 'qode_essential_addons_filter_title_padding_mobile', array( $this, 'get_title_padding' ) );
		add_filter( 'body_class', array( $this, 'get_mobile_header_draw_classes' ) );
	}

	public function get_layout() {
		return $this->layout;
	}

	public function set_layout( $layout ) {
		$this->layout = $layout;
	}

	public function get_layout_slug() {
		return $this->layout_slug;
	}

	public function set_layout_slug( $layout_slug ) {
		$this->layout_slug = $layout_slug;
	}

	public function set_inline_mobile_header_styles( $style ) {
		$item_styles = array();

		$height                    = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_height' );
		$background_color          = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_background_color' );
		$dropdown_background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_dropdown_background_color' );
		$dropdown_box_shadow       = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_dropdown_box_shadow' );

		if ( '' !== $height ) {
			$item_styles['height'] = intval( $height ) . 'px';
		}

		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
			$style                          .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header--' . $this->get_layout() . ' .qodef-mobile-header-navigation', array( 'background-color' => $item_styles['background-color'] ) );
		}

		if ( ! empty( $dropdown_background_color ) ) {
			$dropdown_styles['background-color'] = $dropdown_background_color . '!important';
			$style                              .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header-navigation', array( 'background-color' => $dropdown_styles['background-color'] ) );
		}

		if ( ! empty( $dropdown_box_shadow ) ) {
			$dropdown_styles['box-shadow'] = $dropdown_box_shadow . '!important';
			$style                        .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header-navigation', array( 'box-shadow' => $dropdown_styles['box-shadow'] ) );
		}

		if ( ! empty( $item_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header--' . $this->get_layout() . ' #qodef-page-mobile-header', $item_styles );
		}

		$inner_styles = array();

		$side_padding = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_side_padding' );

		if ( '' !== $side_padding ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $side_padding ) ) {
				$inner_styles['padding-left']  = $side_padding;
				$inner_styles['padding-right'] = $side_padding;
			} else {
				$inner_styles['padding-left']  = intval( $side_padding ) . 'px';
				$inner_styles['padding-right'] = intval( $side_padding ) . 'px';
			}
		}

		if ( ! empty( $inner_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header--' . $this->get_layout() . ' #qodef-page-mobile-header-inner', $inner_styles );
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header--' . $this->get_layout() . ' .qodef-mobile-header-navigation > ul:not(.qodef-content-grid)', $inner_styles );
		}

		$border_styles = array();

		$border_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_border_color' );
		$border_width = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_border_width' );
		$border_style = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_border_style' );

		if ( ! empty( $border_color ) ) {
			$border_styles['border-bottom-color'] = $border_color;

			if ( empty( $border_width ) ) {
				$border_styles['border-bottom-width'] = '1px';
			}
		}

		if ( ! empty( $border_width ) ) {
			$border_styles['border-bottom-width'] = intval( $border_width ) . 'px';
		}

		if ( ! empty( $border_style ) ) {
			$border_styles['border-bottom-style'] = $border_style;
		}

		if ( ! empty( $border_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header--' . $this->get_layout() . ' #qodef-page-mobile-header-inner', $border_styles );
		}

		$border_dropdown_styles = array();

		$dropdown_bottom_border_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_dropdown_bottom_border_color' );

		if ( ! empty( $dropdown_bottom_border_color ) ) {
			$border_dropdown_styles['border-bottom-color'] = $dropdown_bottom_border_color;

			if ( empty( $border_width ) ) {
				$border_dropdown_styles['border-bottom-width'] = '1px';
			}
		}

		if ( ! empty( $border_width ) ) {
			$border_dropdown_styles['border-bottom-width'] = intval( $border_width ) . 'px';
		}

		if ( ! empty( $border_style ) ) {
			$border_dropdown_styles['border-bottom-style'] = $border_style;
		}

		if ( ! empty( $dropdown_bottom_border_color ) ) {

			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header--' . $this->get_layout() . ' .qodef-mobile-header-navigation', $border_dropdown_styles );
		}

		$opener_styles = array();
		$opener_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_header_opener_color' );

		if ( ! empty( $opener_color ) ) {
			$opener_styles['color'] = $opener_color;
		}

		if ( ! empty( $opener_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header-opener', $opener_styles );
		}

		$opener_svg_styles = array();
		$opener_svg_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_header_opener_size' );

		if ( ! empty( $opener_svg_size ) ) {
			$opener_svg_styles['width'] = intval( $opener_svg_size ) . 'px';
		}

		if ( ! empty( $opener_svg_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-mobile-header-opener svg', $opener_svg_styles );
		}

		$opener_hover_styles = array();
		$opener_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_header_opener_hover_color' );

		if ( ! empty( $opener_hover_color ) ) {
			$opener_hover_styles['color'] = $opener_hover_color;
		}

		if ( ! empty( $opener_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-mobile-header-opener:hover',
				),
				$opener_hover_styles
			);
		}

		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_styles        = qode_essential_addons_get_typography_styles( $scope, 'qodef_mobile_menu_1st_lvl' );
		$first_lvl_hover_styles  = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_mobile_menu_1st_lvl' );
		$second_lvl_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_mobile_menu_2nd_lvl' );
		$second_lvl_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_mobile_menu_2nd_lvl' );

		$header_selector = apply_filters( 'qode_essential_addons_filter_mobile_menu_menu_header_selector', '.qodef-mobile-header-navigation' );

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( $header_selector . '> ul > li > a', $first_lvl_styles );

			if ( isset( $first_lvl_styles['color'] ) && ! empty( $first_lvl_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style( $header_selector . '> ul > li > .qodef-mobile-menu-item-icon', array( 'color' => $first_lvl_styles['color'] ) );
			}
		}

		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					$header_selector . '> ul > li > a:hover',
					$header_selector . '> ul > li > a:focus',
				),
				$first_lvl_hover_styles
			);

			if ( isset( $first_lvl_hover_styles['color'] ) && ! empty( $first_lvl_hover_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						$header_selector . '> ul > li > .qodef-mobile-menu-item-icon:hover',
						$header_selector . '> ul > li > .qodef-mobile-menu-item-icon:focus',
					),
					array( 'color' => $first_lvl_hover_styles['color'] )
				);
			}
		}

		$first_lvl_active_styles          = array();
		$first_lvl_active_color           = qode_essential_addons_get_option_value( 'admin', 'qodef_mobile_menu_1st_lvl_active_color' );
		$first_lvl_active_text_decoration = qode_essential_addons_get_option_value( 'admin', 'qodef_mobile_menu_1st_lvl_hover_text_decoration' );

		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles['color'] = $first_lvl_active_color;
		}

		if ( ! empty( $first_lvl_active_text_decoration ) ) {
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

			if ( isset( $first_lvl_active_styles['color'] ) && ! empty( $first_lvl_active_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						$header_selector . '> ul > li.current-menu-ancestor > .qodef-mobile-menu-item-icon',
						$header_selector . '> ul > li.current-menu-item > .qodef-mobile-menu-item-icon',
					),
					array( 'color' => $first_lvl_active_styles['color'] )
				);
			}
		}

		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( $header_selector . ' > ul > li ul li a', $second_lvl_styles );

			if ( isset( $second_lvl_styles['color'] ) && ! empty( $second_lvl_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style( $header_selector . '> ul > li ul li .qodef-mobile-menu-item-icon', array( 'color' => $second_lvl_styles['color'] ) );
			}
		}

		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					$header_selector . ' > ul > li ul li > a:hover',
					$header_selector . ' > ul > li ul li > a:focus',
				),
				$second_lvl_hover_styles
			);

			if ( isset( $second_lvl_hover_styles['color'] ) && ! empty( $second_lvl_hover_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						$header_selector . '> ul > li ul li .qodef-mobile-menu-item-icon:hover',
						$header_selector . '> ul > li ul li .qodef-mobile-menu-item-icon:focus',
					),
					array( 'color' => $second_lvl_hover_styles['color'] )
				);
			}
		}

		$second_lvl_active_styles          = array();
		$second_lvl_active_color           = qode_essential_addons_get_option_value( 'admin', 'qodef_mobile_menu_2nd_lvl_active_color' );
		$second_lvl_active_text_decoration = qode_essential_addons_get_option_value( 'admin', 'qodef_mobile_menu_2nd_lvl_hover_text_decoration' );

		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles['color'] = $second_lvl_active_color;
		}

		if ( ! empty( $second_lvl_active_text_decoration ) ) {
			$second_lvl_active_styles['text-decoration'] = $second_lvl_active_text_decoration;
		}

		if ( ! empty( $second_lvl_active_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					$header_selector . ' > ul > li ul li.current-menu-ancestor > a',
					$header_selector . ' > ul > li ul li.current-menu-item > a',
				),
				$second_lvl_active_styles
			);

			if ( isset( $second_lvl_active_styles['color'] ) && ! empty( $second_lvl_active_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						$header_selector . '> ul > li ul li.current-menu-ancestor > .qodef-mobile-menu-item-icon',
						$header_selector . '> ul > li ul li.current-menu-item > .qodef-mobile-menu-item-icon',
					),
					array( 'color' => $second_lvl_active_styles['color'] )
				);
			}
		}

		return $style;
	}

	public function content_behind_header() {
		$content_behind_header = qode_essential_addons_get_post_value_through_levels( 'qodef_content_behind_header' );

		return 'yes' === $content_behind_header;
	}

	public function get_content_margin( $margin ) {

		if ( $this->content_behind_header() ) {
			$margin += $this->header_height;
		}

		return $margin;
	}

	public function get_title_padding( $padding ) {

		if ( $this->content_behind_header() ) {
			$padding += $this->header_height;
		}

		return $padding;
	}

	public function set_header_height() {
		$header_height = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_layout() . '_mobile_header_height' );
		$header_height = ! empty( $header_height ) ? intval( $header_height ) : $this->default_header_height;

		$this->header_height = apply_filters( 'qode_essential_addons_filter_set_mobile_header_height', $header_height );
	}


	public function get_mobile_header_draw_classes( $classes ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$first_lvl_classes  = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_mobile_menu_1st_lvl' );
		$second_lvl_classes = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_mobile_menu_2nd_lvl' );

		if ( ! empty( $first_lvl_classes ) ) {
			$classes [] = $first_lvl_classes;
		}

		if ( ! empty( $second_lvl_classes ) ) {
			$classes [] = $second_lvl_classes;
		}

		return $classes;
	}
}
