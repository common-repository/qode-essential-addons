<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_page_footer_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_page_footer_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'footer',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Footer', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Footer Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Use this option to choose whether page footers are enabled or disabled by default', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$page_footer_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_footer_section',
					'title'      => esc_html__( 'Footer Area', 'qode-essential-addons' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_footer' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_footer_widgets_skin',
					'title'       => esc_html__( 'Widgets Skin', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a predefined stylization for widgets in footer area', 'qode-essential-addons' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'qode-essential-addons' ),
						'light' => esc_html__( 'Light', 'qode-essential-addons' ),
						'white' => esc_html__( 'White', 'qode-essential-addons' ),
					),
				)
			);

			// Top Footer Area Section.

			$top_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'  => 'qodef_top_footer_area_section',
					'title' => esc_html__( 'Top Footer Area', 'qode-essential-addons' ),
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_top_area_in_grid',
					'title'         => esc_html__( 'Top Footer Area In Grid', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_grid_gutter',
					'title'       => esc_html__( 'Top Footer Area Grid Gutter', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for top footer area', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_columns',
					'title'         => esc_html__( 'Top Footer Area Columns', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose number of columns for top footer area', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number', true ),
					'default_value' => '4',
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_columns_size',
					'title'       => esc_html__( 'Top Footer Area Columns Width', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a default column width for top footer area', 'qode-essential-addons' ),
					'dependency'  => array(
						'show' => array(
							'qodef_set_footer_top_area_columns' => array(
								'values'        => '1',
								'default_value' => '4',
							),
						),
					),
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_content_alignment',
					'title'       => esc_html__( 'Content Alignment', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose how you wish to align content in top footer area by default', 'qode-essential-addons' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'qode-essential-addons' ),
						'left'   => esc_html__( 'Left', 'qode-essential-addons' ),
						'center' => esc_html__( 'Center', 'qode-essential-addons' ),
						'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options before footer top area styles.
			do_action( 'qode_essential_addons_action_before_page_footer_top_area_styles_options_map', $top_footer_area_section );

			$top_footer_area_styles_section = $top_footer_area_section->add_section_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_section',
					'title' => esc_html__( 'Top Footer Area Styles', 'qode-essential-addons' ),
				)
			);

			$top_footer_area_styles_row = $top_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_row',
					'title' => '',
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_padding_top',
					'title'      => esc_html__( 'Padding Top', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_padding_bottom',
					'title'      => esc_html__( 'Padding Bottom', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_side_padding',
					'title'      => esc_html__( 'Side Padding', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_top_footer_area_background_image',
					'title'      => esc_html__( 'Background Image', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_top_footer_area_top_border_style',
					'title'      => esc_html__( 'Top Border Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			// Hook to include additional options in the end of footer top section.
			do_action( 'qode_essential_addons_action_top_footer_area_styles_row', $top_footer_area_section );

			$top_footer_area_styles_row_2 = $top_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_row_2',
					'title' => '',
				)
			);

			$top_footer_area_styles_row_2->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a size for the widget bottom margin', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);

			$top_footer_area_styles_row_2->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_widgets_title_margin_bottom',
					'title'       => esc_html__( 'Widgets Title Margin Bottom', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a size for the space between widget title and widget content', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);

			// Hook to include additional options in the end of footer top section.
			do_action( 'qode_essential_addons_action_end_of_page_footer_top_options_map', $top_footer_area_section );

			// Bottom Footer Area Section.

			$bottom_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'  => 'qodef_bottom_footer_area_section',
					'title' => esc_html__( 'Bottom Footer Area', 'qode-essential-addons' ),
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_bottom_area_in_grid',
					'title'         => esc_html__( 'Bottom Footer Area In Grid', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter',
					'title'       => esc_html__( 'Bottom Footer Area Grid Gutter', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for bottom footer area', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_bottom_area_columns',
					'title'         => esc_html__( 'Bottom Footer Area Columns', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose number of columns for bottom footer area', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number', true, array( '4', '5', '6' ) ),
					'default_value' => '2',
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_bottom_footer_area_columns_size',
					'title'       => esc_html__( 'Bottom Footer Area Columns Width', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a default column width for bottom footer area', 'qode-essential-addons' ),
					'dependency'  => array(
						'show' => array(
							'qodef_set_footer_bottom_area_columns' => array(
								'values'        => '1',
								'default_value' => '2',
							),
						),
					),
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_content_alignment',
					'title'       => esc_html__( 'Content Alignment', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose how you wish to align content in bottom footer area by default', 'qode-essential-addons' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'qode-essential-addons' ),
						'left'   => esc_html__( 'Left', 'qode-essential-addons' ),
						'center' => esc_html__( 'Center', 'qode-essential-addons' ),
						'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options before footer bottom area styles.
			do_action( 'qode_essential_addons_action_before_page_footer_bottom_area_styles_options_map', $bottom_footer_area_section );

			$bottom_footer_area_styles_section = $bottom_footer_area_section->add_section_element(
				array(
					'name'  => 'qodef_bottom_footer_area_styles_section',
					'title' => esc_html__( 'Bottom Footer Area Styles', 'qode-essential-addons' ),
				)
			);

			$bottom_footer_area_styles_row = $bottom_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_bottom_footer_area_styles_row',
					'title' => '',
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_padding_top',
					'title'      => esc_html__( 'Padding Top', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_padding_bottom',
					'title'      => esc_html__( 'Padding Bottom', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_side_padding',
					'title'      => esc_html__( 'Side Padding', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_bottom_footer_area_top_border_style',
					'title'      => esc_html__( 'Top Border Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			// Hook to include additional options in the end of footer bottom section.
			do_action( 'qode_essential_addons_action_bottom_footer_area_styles_row', $bottom_footer_area_styles_section );

			// Hook to include additional options in the end of footer bottom section.
			do_action( 'qode_essential_addons_action_end_of_page_footer_bottom_options_map', $bottom_footer_area_section );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_page_footer_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_page_footer_options', qode_essential_addons_get_admin_options_map_position( 'footer' ) );
}
