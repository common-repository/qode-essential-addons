<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_set_general_gutenberg_input_fields_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_gutenberg_input_fields_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$label_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_label' );

		if ( ! empty( $label_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper label',
				),
				$label_styles
			);
		}

		$input_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_input_fields' );
		$fields_bg_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_background_color' );
		$fields_border_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_color' );
		$fields_border_width  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_width' );
		$fields_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_radius' );
		$fields_border_style  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_style' );
		$fields_padding       = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_padding' );

		if ( ! empty( $fields_bg_color ) ) {
			$input_styles['background-color'] = $fields_bg_color;
		}

		if ( ! empty( $fields_border_color ) ) {
			$input_styles['border-color'] = $fields_border_color;
		}

		if ( '' !== $fields_border_width ) {
			$input_styles['border-width'] = $fields_border_width;
		}

		if ( '' !== $fields_border_radius ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $fields_border_radius, true ) ) {
				$input_styles['border-radius'] = $fields_border_radius;
			} else {
				$input_styles['border-radius'] = intval( $fields_border_radius ) . 'px';
			}
		}

		if ( ! empty( $fields_border_style ) ) {
			$input_styles['border-style'] = esc_attr( $fields_border_style );
		}

		if ( '' !== $fields_padding ) {
			$input_styles['padding'] = esc_attr( $fields_padding );
		}

		if ( ! empty( $input_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper input[type="text"]',
					'.editor-styles-wrapper input[type="email"]',
					'.editor-styles-wrapper input[type="url"]',
					'.editor-styles-wrapper input[type="password"]',
					'.editor-styles-wrapper input[type="number"]',
					'.editor-styles-wrapper input[type="tel"]',
					'.editor-styles-wrapper input[type="search"]',
					'.editor-styles-wrapper input[type="date"]',
					'.editor-styles-wrapper textarea',
					'.editor-styles-wrapper select',
					'.editor-styles-wrapper .select2-container--default .select2-selection--single',
					'.editor-styles-wrapper .select2-container--default .select2-selection--multiple',
					'.editor-styles-wrapper .wp-block-search .wp-block-search__input',
					'.editor-styles-wrapper .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper',
					'.editor-styles-wrapper .widget_block .wp-block-woocommerce-product-search input',
				),
				$input_styles
			);
		}

		// Connected with input border color, since those borders appear on blog single page, so all border colors on page should be consistent.
		if ( ! empty( $fields_border_color ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper table tr',
					'.editor-styles-wrapper table td',
					'.editor-styles-wrapper table th',
				),
				array(
					'border-color' => $fields_border_color,
				)
			);
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper .wp-block-search button',
				),
				array( 'color' => $fields_border_color )
			);
		}

		$input_focus_styles        = array();
		$fields_focus_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_focus_color' );
		$fields_bg_focus_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_background_focus_color' );
		$fields_border_focus_color = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_focus_color' );

		if ( ! empty( $fields_focus_color ) ) {
			$input_focus_styles['color'] = $fields_focus_color;
		}

		if ( ! empty( $fields_bg_focus_color ) ) {
			$input_focus_styles['background-color'] = $fields_bg_focus_color;
		}

		if ( ! empty( $fields_border_focus_color ) ) {
			$input_focus_styles['border-color'] = $fields_border_focus_color;

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper .wp-block-search button:hover',
					'.editor-styles-wrapper .wp-block-search button:focus',
				),
				array( 'color' => $fields_border_focus_color )
			);
		}

		if ( ! empty( $input_focus_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper input[type="text"]:focus',
					'.editor-styles-wrapper input[type="email"]:focus',
					'.editor-styles-wrapper input[type="url"]:focus',
					'.editor-styles-wrapper input[type="password"]:focus',
					'.editor-styles-wrapper input[type="number"]:focus',
					'.editor-styles-wrapper input[type="tel"]:focus',
					'.editor-styles-wrapper input[type="search"]:focus',
					'.editor-styles-wrapper input[type="date"]:focus',
					'.editor-styles-wrapper textarea:focus',
					'.editor-styles-wrapper select:focus',
					'.editor-styles-wrapper .select2-container--default .select2-selection--single:focus',
					'.editor-styles-wrapper .select2-container--default .select2-selection--multiple:focus',
					'.editor-styles-wrapper .wp-block-search .wp-block-search__input:focus',
				),
				$input_focus_styles
			);
		}

		$button_styles        = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_buttons' );
		$button_bg_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_background_color' );
		$button_border_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_color' );
		$button_border_width  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_width' );
		$button_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_radius' );
		$button_border_style  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_style' );
		$button_box_shadow    = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_box_shadow' );
		$button_padding       = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_padding' );

		if ( ! empty( $button_bg_color ) ) {
			$button_styles['background-color'] = $button_bg_color;
		}

		if ( ! empty( $button_border_color ) ) {
			$button_styles['border-color'] = $button_border_color;
		}

		if ( '' !== $button_border_width ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_border_width, true ) ) {
				$button_styles['border-width'] = $button_border_width;
			} else {
				$button_styles['border-width'] = intval( $button_border_width ) . 'px';
			}
			$button_styles['border-style'] = 'solid';
		}

		if ( '' !== $button_border_radius ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_border_radius, true ) ) {
				$button_styles['border-radius'] = $button_border_radius;
			} else {
				$button_styles['border-radius'] = intval( $button_border_radius ) . 'px';
			}
		}

		if ( ! empty( $button_border_style ) ) {
			$button_styles['border-style'] = esc_attr( $button_border_style );
		}

		if ( ! empty( $button_box_shadow ) ) {
			$button_styles['box-shadow'] = esc_attr( $button_box_shadow );
		}

		if ( '' !== $button_padding ) {
			$button_styles['padding'] = esc_attr( $button_padding );
		}

		if ( ! empty( $button_styles ) ) {
			if ( isset( $button_styles['margin-top'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'.editor-styles-wrapper input[type="submit"]',
					),
					array(
						'margin-top' => $button_styles['margin-top'],
					)
				);

				unset( $button_styles['margin-top'] );
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper input[type="submit"]',
					'.editor-styles-wrapper button[type="submit"]',
					'.editor-styles-wrapper .qodef-theme-button.qodef--filled',
					'.editor-styles-wrapper button.qodef-theme-button.qodef--filled',
					'.editor-styles-wrapper .wp-block-button .wp-block-button__link',
					'.editor-styles-wrapper .wp-block-button.wp-block-button__link',
				),
				$button_styles
			);
		}

		$button_hover_styles       = array();
		$button_hover_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_hover_color' );
		$button_bg_hover_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_background_hover_color' );
		$button_border_hover_color = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_hover_color' );

		if ( ! empty( $button_hover_color ) ) {
			$button_hover_styles['color'] = $button_hover_color;
		}

		if ( ! empty( $button_bg_hover_color ) ) {
			$button_hover_styles['background-color'] = $button_bg_hover_color;
		}

		if ( ! empty( $button_border_hover_color ) ) {
			$button_hover_styles['border-color'] = $button_border_hover_color;
		}

		if ( ! empty( $button_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper input[type="submit"]:hover',
					'.editor-styles-wrapper button[type="submit"]:hover',
					'.editor-styles-wrapper input[type="submit"]:focus',
					'.editor-styles-wrapper button[type="submit"]:focus',
					'.editor-styles-wrapper .qodef-theme-button.qodef--filled:hover',
					'.editor-styles-wrapper button.qodef-theme-button.qodef--filled:hover',
					'.editor-styles-wrapper .qodef-theme-button.qodef--filled:focus',
					'.editor-styles-wrapper button.qodef-theme-button.qodef--filled:focus',
					'.editor-styles-wrapper .wp-block-button .wp-block-button__link:hover',
					'.editor-styles-wrapper .wp-block-button.wp-block-button__link:hover',
					'.editor-styles-wrapper .wp-block-button .wp-block-button__link:focus',
					'.editor-styles-wrapper .wp-block-button.wp-block-button__link:focus',
				),
				$button_hover_styles
			);
		}

		$button_icon_styles = array();
		$button_icon_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_icon_size' );
		$button_icon_margin = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_icon_margin_left' );

		if ( ! empty( $button_icon_size ) ) {
			if ( qode_essential_addons_framework_string_ends_with_typography_units( $button_icon_size ) ) {
				$button_icon_styles['width'] = $button_icon_size;
			} else {
				$button_icon_styles['width'] = intval( $button_icon_size ) . 'px';
			}
		}

		if ( ! empty( $button_icon_margin ) ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_icon_margin, true ) ) {
				$button_icon_styles['margin-left'] = $button_icon_margin;
			} else {
				$button_icon_styles['margin-left'] = intval( $button_icon_margin ) . 'px';
			}
		}

		if ( ! empty( $button_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper .qodef-theme-button .qodef-theme-button-icon',
					'.editor-styles-wrapper button.qodef-theme-button .qodef-theme-button-icon',
				),
				$button_icon_styles
			);
		}

		$button_simple_icon_styles = array();
		$button_simple_icon_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_icon_color' );

		if ( ! empty( $button_simple_icon_color ) ) {
			$button_simple_icon_styles['color'] = $button_simple_icon_color;
		}

		if ( ! empty( $button_simple_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper .qodef-theme-button.qodef--simple .qodef-theme-button-icon',
					'.editor-styles-wrapper button.qodef-theme-button.qodef--simple .qodef-theme-button-icon',
				),
				$button_simple_icon_styles
			);
		}

		$button_simple_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_buttons_simple' );

		if ( ! empty( $button_simple_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper .qodef-theme-button.qodef--simple',
					'.editor-styles-wrapper button.qodef-theme-button.qodef--simple',
				),
				$button_simple_styles
			);
		}

		$button_simple_hover_styles               = array();
		$button_simple_hover_color                = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_color' );
		$button_simple_hover_text_decoration      = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_text_decoration' );
		$button_simple_hover_text_decoration_draw = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_text_decoration_draw' );

		if ( ! empty( $button_simple_hover_color ) ) {
			$button_simple_hover_styles['color'] = $button_simple_hover_color;
		}

		if ( ! empty( $hover_text_decoration ) && 'no' === $button_simple_hover_text_decoration_draw ) {
			$button_simple_hover_styles['text-decoration'] = $button_simple_hover_text_decoration;
		}

		if ( ! empty( $hover_text_decoration ) && 'no' !== $button_simple_hover_text_decoration_draw ) {
			$button_simple_hover_styles['text-decoration'] = 'none';
		}

		if ( ! empty( $button_simple_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.editor-styles-wrapper .qodef-theme-button.qodef--simple:hover',
					'.editor-styles-wrapper button.qodef-theme-button.qodef--simple:hover',
					'.editor-styles-wrapper .qodef-theme-button.qodef--simple:focus',
					'.editor-styles-wrapper button.qodef-theme-button.qodef--simple:focus',
				),
				$button_simple_hover_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_gutenberg_inline_style', 'qode_essential_addons_set_general_gutenberg_input_fields_styles' );
}
