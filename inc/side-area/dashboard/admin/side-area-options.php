<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_side_area_options' ) ) {
	/**
	 * Function that add global options for current module
	 */
	function qode_essential_addons_side_area_options() {
		$qode_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'side-area',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Side Area', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Side Area Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_side_area_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_side_area_background_image',
					'title'      => esc_html__( 'Background Image', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_side_area_cover_background_color',
					'title'      => esc_html__( 'Cover Background Color', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_side_area_padding',
					'title'       => esc_html__( 'Padding', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set padding that will be applied to side area in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_side_area_content_alignment',
					'title'      => esc_html__( 'Content Alignment', 'qode-essential-addons' ),
					'options'    => array(
						''       => esc_html__( 'Default', 'qode-essential-addons' ),
						'left'   => esc_html__( 'Left', 'qode-essential-addons' ),
						'center' => esc_html__( 'Center', 'qode-essential-addons' ),
						'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_side_area_widgets_skin',
					'title'       => esc_html__( 'Widgets Skin', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a predefined stylization for side area widget elements', 'qode-essential-addons' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'qode-essential-addons' ),
						'light' => esc_html__( 'Light', 'qode-essential-addons' ),
						'white' => esc_html__( 'White', 'qode-essential-addons' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_side_area_icon_svg_path',
					'title'       => esc_html__( 'Side Area Open Icon SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your side area open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_side_area_close_icon_svg_path',
					'title'       => esc_html__( 'Side Area Close Icon SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your side area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
				)
			);

			$opener_section = $page->add_section_element(
				array(
					'name'  => 'qodef_side_area_opener_section',
					'title' => esc_html__( 'Side Area Open Icon', 'qode-essential-addons' ),
				)
			);

			$opener_section_row = $opener_section->add_row_element(
				array(
					'name'  => 'qodef_side_area_opener_row',
					'title' => esc_html__( 'Open Icon Styles', 'qode-essential-addons' ),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_side_area_opener_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_side_area_opener_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_side_area_opener_size',
					'title'      => esc_html__( 'Icon Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_side_area_opener_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_side_opener_side_padding',
					'title'      => esc_html__( 'Icon Side Padding', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$close_icon_section = $page->add_section_element(
				array(
					'name'  => 'qodef_side_area_close_icon_section',
					'title' => esc_html__( 'Side Area Close Icon', 'qode-essential-addons' ),
				)
			);

			$close_icon_section_row = $close_icon_section->add_row_element(
				array(
					'name'  => 'qodef_side_area_close_icon_row',
					'title' => esc_html__( 'Close Icon Styles', 'qode-essential-addons' ),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_side_area_close_icon_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_side_area_close_icon_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_side_area_close_icon_size',
					'title'      => esc_html__( 'Icon Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_side_area_close_icon_top_position',
					'title'      => esc_html__( 'Top Position', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px or %', 'qode-essential-addons' ),
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_side_area_close_icon_right_position',
					'title'      => esc_html__( 'Right Position', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px or %', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_side_area_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_side_area_options', qode_essential_addons_get_admin_options_map_position( 'side-area' ) );
}
