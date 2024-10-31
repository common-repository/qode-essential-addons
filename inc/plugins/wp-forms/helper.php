<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_wpforms_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param int $position
	 * @param string $map
	 *
	 * @return int
	 */
	function qode_essential_addons_wpforms_set_admin_options_map_position( $position, $map ) {

		if ( 'wp-forms' === $map ) {
			$position = 85;
		}

		return $position;
	}

	add_filter( 'qode_essential_addons_filter_admin_options_map_position', 'qode_essential_addons_wpforms_set_admin_options_map_position', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_set_wpforms_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_wpforms_styles( $style ) {
		$label_styles        = array();
		$label_color         = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_label_color' );
		$label_margin_bottom = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_label_margin_bottom' );

		if ( ! empty( $label_color ) ) {
			$label_styles['color'] = $label_color;
		}

		if ( '' !== $label_margin_bottom ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $label_margin_bottom, true ) ) {
				$label_styles['margin-bottom'] = $label_margin_bottom;
			} else {
				$label_styles['margin-bottom'] = intval( $label_margin_bottom ) . 'px';
			}
		}

		if ( ! empty( $label_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'div.wpforms-container .wpforms-form label',
					'div.wpforms-container .wpforms-form .wpforms-field-label',
					'div.wpforms-container .wpforms-form .wpforms-field-number-slider-hint',
					'div.wpforms-container.wpforms-container-full .wpforms-form label',
					'div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-label',
					'div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider-hint',
				),
				$label_styles
			);
		}

		$input_styles         = array();
		$fields_color         = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_color' );
		$fields_bg_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_background_color' );
		$fields_border_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_border_color' );
		$fields_border_width  = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_border_width' );
		$fields_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_border_radius' );
		$fields_border_style  = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_border_style' );
		$fields_margin_bottom = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_margin_bottom' );
		$fields_padding       = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_padding' );

		if ( ! empty( $fields_color ) ) {
			$input_styles['color'] = $fields_color;
		}

		if ( ! empty( $fields_bg_color ) ) {
			$input_styles['background-color'] = $fields_bg_color;
		}

		if ( ! empty( $fields_border_color ) ) {
			$input_styles['border-color'] = $fields_border_color;
		}

		if ( '' !== $fields_border_width ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $fields_border_width, true ) ) {
				$input_styles['border-width'] = $fields_border_width;
			} else {
				$input_styles['border-width'] = intval( $fields_border_width ) . 'px';
			}
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

		if ( '' !== $fields_margin_bottom ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $fields_margin_bottom, true ) ) {
				$input_styles['margin-bottom'] = $fields_margin_bottom;
			} else {
				$input_styles['margin-bottom'] = intval( $fields_margin_bottom ) . 'px';
			}
		}

		if ( '' !== $fields_padding ) {
			$input_styles['padding'] = esc_attr( $fields_padding );
		}

		if ( ! empty( $input_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'div.wpforms-container .wpforms-form input:not([type=range])',
					'div.wpforms-container .wpforms-form textarea',
					'div.wpforms-container .wpforms-form select',
					'div.wpforms-container .wpforms-form .select2-container--default .select2-selection--multiple',
					'div.wpforms-container .wpforms-form .select2-container--default .select2-selection--single',
					'div.wpforms-container.wpforms-container-full .wpforms-form input:not([type=range])',
					'div.wpforms-container.wpforms-container-full .wpforms-form textarea',
					'div.wpforms-container.wpforms-container-full .wpforms-form select',
					'div.wpforms-container.wpforms-container-full .wpforms-form .select2-container--default .select2-selection--multiple',
					'div.wpforms-container.wpforms-container-full .wpforms-form .select2-container--default .select2-selection--single',
				),
				$input_styles
			);

			$range_styles = $input_styles;
			unset( $range_styles['padding'] );
			unset( $range_styles['margin-bottom'] );

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'div.wpforms-container .wpforms-form .wpforms-field-number-slider input[type=range]',
					'div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type=range]',
				),
				$input_styles
			);
		}

		$input_focus_styles        = array();
		$fields_focus_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_focus_color' );
		$fields_bg_focus_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_background_focus_color' );
		$fields_border_focus_color = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_input_fields_border_focus_color' );

		if ( ! empty( $fields_focus_color ) ) {
			$input_focus_styles['color'] = $fields_focus_color;
		}

		if ( ! empty( $fields_bg_focus_color ) ) {
			$input_focus_styles['background-color'] = $fields_bg_focus_color;
		}

		if ( ! empty( $fields_border_focus_color ) ) {
			$input_focus_styles['border-color'] = $fields_border_focus_color;
		}

		if ( ! empty( $input_focus_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'div.wpforms-container .wpforms-form input:focus',
					'div.wpforms-container .wpforms-form .wpforms-field-number-slider input[type=range]:focus',
					'div.wpforms-container .wpforms-form textarea:focus',
					'div.wpforms-container .wpforms-form select:focus',
					'div.wpforms-container.wpforms-container-full .wpforms-form input:focus',
					'div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type=range]:focus',
					'div.wpforms-container.wpforms-container-full .wpforms-form textarea:focus',
					'div.wpforms-container.wpforms-container-full .wpforms-form select:focus',
					'div.wpforms-container.wpforms-container-full .wpforms-form .select2-container--default .select2-selection--multiple',
					'div.wpforms-container.wpforms-container-full .wpforms-form .select2-container--default.select2-container--open .select2-selection--single',
					'div.wpforms-container.wpforms-container-full .wpforms-form .select2-container--default.select2-container--focus .select2-selection--single',
				),
				$input_focus_styles
			);
		}

		$button_styles        = array();
		$button_color         = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_color' );
		$button_bg_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_background_color' );
		$button_border_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_border_color' );
		$button_border_width  = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_border_width' );
		$button_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_border_radius' );
		$button_border_style  = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_border_style' );
		$button_box_shadow    = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_box_shadow' );
		$button_margin_top    = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_margin_top' );
		$button_padding       = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_padding' );

		if ( ! empty( $button_color ) ) {
			$button_styles['color'] = $button_color;
		}

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

		if ( '' !== $button_margin_top ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_margin_top, true ) ) {
				$button_styles['margin-top'] = $button_margin_top;
			} else {
				$button_styles['margin-top'] = intval( $button_margin_top ) . 'px';
			}
		}

		if ( '' !== $button_padding ) {
			$button_styles['padding'] = esc_attr( $button_padding );
		}

		if ( ! empty( $button_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'div.wpforms-container .wpforms-form button[type=submit]',
					'div.wpforms-container.wpforms-container-full .wpforms-form button[type=submit]',
				),
				$button_styles
			);
		}

		$button_hover_styles       = array();
		$button_hover_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_hover_color' );
		$button_bg_hover_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_background_hover_color' );
		$button_border_hover_color = qode_essential_addons_get_post_value_through_levels( 'qodef_wpforms_buttons_border_hover_color' );

		if ( ! empty( $button_hover_color ) ) {
			$button_hover_styles['color'] = $button_hover_color;
		}

		if ( ! empty( $button_bg_hover_color ) ) {
			$button_hover_styles['background-color'] = $button_bg_hover_color;
		}

		if ( ! empty( $button_border_hover_color ) ) {
			$button_hover_styles['border-color'] = $button_border_hover_color;
		}

		if ( '' !== $button_border_width ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_border_width, true ) ) {
				$button_hover_styles['border-width'] = $button_border_width;
			} else {
				$button_hover_styles['border-width'] = intval( $button_border_width ) . 'px';
			}
			$button_hover_styles['border-style'] = 'solid';
		}

		if ( ! empty( $button_border_style ) ) {
			$button_hover_styles['border-style'] = esc_attr( $button_border_style );
		}

		if ( ! empty( $button_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'div.wpforms-container .wpforms-form button[type=submit]:hover',
					'div.wpforms-container.wpforms-container-full .wpforms-form button[type=submit]:hover',
				),
				$button_hover_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_wpforms_styles' );
}
