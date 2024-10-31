<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_wpforms_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_wpforms_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'wp-forms',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'WP Forms', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global WP Forms Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {

			$input_fields_section = $page->add_section_element(
				array(
					'name'  => 'qodef_wpforms_input_fields_section',
					'title' => esc_html__( 'Input Fields', 'qode-essential-addons' ),
				)
			);

			$label_row = $input_fields_section->add_row_element(
				array(
					'name'  => 'qodef_wpforms_label_row',
					'title' => esc_html__( 'Label Style', 'qode-essential-addons' ),
				)
			);

			$label_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_label_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$label_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_label_margin_bottom',
					'title'      => esc_html__( 'Margin Bottom', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$input_fields_row = $input_fields_section->add_row_element(
				array(
					'name'  => 'qodef_wpforms_input_fields_row',
					'title' => esc_html__( 'Input Fields Style', 'qode-essential-addons' ),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_input_fields_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_input_fields_focus_color',
					'title'      => esc_html__( 'Focus Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_input_fields_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_input_fields_background_focus_color',
					'title'      => esc_html__( 'Background Focus Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_input_fields_border_color',
					'title'      => esc_html__( 'Border Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_input_fields_border_focus_color',
					'title'      => esc_html__( 'Border Focus Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_input_fields_border_width',
					'title'      => esc_html__( 'Border Width', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_input_fields_border_radius',
					'title'      => esc_html__( 'Border Radius', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_wpforms_input_fields_border_style',
					'title'      => esc_html__( 'Border Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_input_fields_margin_bottom',
					'title'      => esc_html__( 'Margin Bottom', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$input_fields_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_input_fields_padding',
					'title'      => esc_html__( 'Padding', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row = $input_fields_section->add_row_element(
				array(
					'name'  => 'qodef_wpforms_button_row',
					'title' => esc_html__( 'Button Style', 'qode-essential-addons' ),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_buttons_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_buttons_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_buttons_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_buttons_background_hover_color',
					'title'      => esc_html__( 'Background Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_buttons_border_color',
					'title'      => esc_html__( 'Border Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_wpforms_buttons_border_hover_color',
					'title'      => esc_html__( 'Border Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_buttons_border_width',
					'title'      => esc_html__( 'Border Width', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_buttons_border_radius',
					'title'      => esc_html__( 'Border Radius', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_wpforms_buttons_border_style',
					'title'      => esc_html__( 'Border Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_buttons_box_shadow',
					'title'      => esc_html__( 'Box Shadow', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_buttons_margin_top',
					'title'      => esc_html__( 'Margin Top', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$button_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_wpforms_buttons_padding',
					'title'      => esc_html__( 'Padding', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_wpforms_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_wpforms_options', qode_essential_addons_get_admin_options_map_position( 'wp-forms' ) );
}
