<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_back_to_top_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_back_to_top_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_back_to_top',
					'title'         => esc_html__( 'Enable Back to Top', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$back_to_top_type = array_merge(
				array( '' => esc_html__( 'Default', 'qode-essential-addons' ) ),
				apply_filters( 'qode_essential_addons_premium_filter_back_to_top_option', array() )
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_back_to_top_type',
					'title'         => esc_html__( 'Back to Top Type', 'qode-essential-addons' ),
					'options'       => $back_to_top_type,
					'args'          => array(
						'custom_class' => ( count( $back_to_top_type ) === 1 ) ? 'qodef-hidden' : '',
					),
					'default_value' => '',
					'dependency'    => array(
						'show' => array(
							'qodef_back_to_top' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							),
						),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_back_to_top_icon_svg_path',
					'title'       => esc_html__( 'Back to Top Icon SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your back to top icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
					'dependency'  => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			do_action( 'qode_essential_addons_action_before_back_to_top_row_options_map', $page );

			$back_to_top_section = $page->add_section_element(
				array(
					'name'       => 'qodef_back_to_top_section',
					'title'      => esc_html__( 'Back to Top Styles', 'qode-essential-addons' ),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							),
						),
					),
				)
			);

			$back_to_top_row = $back_to_top_section->add_row_element(
				array(
					'name' => 'qodef_back_to_top_row',
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_background_hover_color',
					'title'      => esc_html__( 'Background Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_border_color',
					'title'      => esc_html__( 'Border Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_border_hover_color',
					'title'      => esc_html__( 'Border Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_back_to_top_border_width',
					'title'      => esc_html__( 'Border Width', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_back_to_top_border_radius',
					'title'      => esc_html__( 'Border Radius', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_back_to_top_icon_size',
					'title'      => esc_html__( 'Icon Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top_type' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);

			do_action( 'qode_essential_addons_action_back_to_top_row_options_map', $back_to_top_row );

			do_action( 'qode_essential_addons_action_after_back_to_top_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_after_general_options_map', 'qode_essential_addons_add_back_to_top_options' );
}
