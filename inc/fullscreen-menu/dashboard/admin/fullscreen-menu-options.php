<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_fullscreen_menu_options' ) ) {
	/**
	 * Function that add global options for current module
	 */
	function qode_essential_addons_fullscreen_menu_options() {
		$qode_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'fullscreen-menu',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Fullscreen Menu', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Fullscreen Menu Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {

			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-fullscreen-menu-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'qode-essential-addons' ),
				)
			);

			$general_section = $general_tab->add_section_element(
				array(
					'name' => 'qodef_fullscreen_general_section',
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_fullscreen_menu_in_grid',
					'title'         => esc_html__( 'Fullscreen Menu in Grid', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_fullscreen_menu_hide_logo',
					'title'         => esc_html__( 'Fullscreen Menu Hide Logo', 'qode-essential-addons' ),
					'default_value' => 'no',
				)
			);

			$general_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_menu_background_color',
					'title'      => esc_html__( 'Background Color', 'qode-essential-addons' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_fullscreen_menu_background_image',
					'title'      => esc_html__( 'Background Image', 'qode-essential-addons' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_fullscreen_background_repeat',
					'title'       => esc_html__( 'Background Image Repeat', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a repeat style for the background image', 'qode-essential-addons' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'qode-essential-addons' ),
						'no-repeat' => esc_html__( 'No Repeat', 'qode-essential-addons' ),
						'repeat'    => esc_html__( 'Repeat', 'qode-essential-addons' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'qode-essential-addons' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'qode-essential-addons' ),
					),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_fullscreen_background_size',
					'title'       => esc_html__( 'Background Image Size', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set background image size', 'qode-essential-addons' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'qode-essential-addons' ),
						'auto'    => esc_html__( 'Auto', 'qode-essential-addons' ),
						'contain' => esc_html__( 'Contain', 'qode-essential-addons' ),
						'cover'   => esc_html__( 'Cover', 'qode-essential-addons' ),
					),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_fullscreen_background_position',
					'title'       => esc_html__( 'Background Image Position', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set background image position', 'qode-essential-addons' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_menu_content_alignment',
					'title'      => esc_html__( 'Menu Alignment', 'qode-essential-addons' ),
					'options'    => array(
						''       => esc_html__( 'Default', 'qode-essential-addons' ),
						'left'   => esc_html__( 'Left', 'qode-essential-addons' ),
						'center' => esc_html__( 'Center', 'qode-essential-addons' ),
						'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_fullscreen_menu_content_alignment_options_map', $general_section );

			$general_section->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_fullscreen_menu_icon_svg_path',
					'title'       => esc_html__( 'Fullscreen Menu Open Icon SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your full screen menu open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_fullscreen_menu_close_icon_svg_path',
					'title'       => esc_html__( 'Fullscreen Menu Close Icon SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your full screen menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
				)
			);

			$opener_section = $general_tab->add_section_element(
				array(
					'name'  => 'qodef_fullscreen_opener_section',
					'title' => esc_html__( 'Fullscreen Menu Icon Styles', 'qode-essential-addons' ),
				)
			);

			$opener_section_row = $opener_section->add_row_element(
				array(
					'name'  => 'qodef_fullscreen_opener_row',
					'title' => esc_html__( 'Open Icon Styles', 'qode-essential-addons' ),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_opener_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_opener_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_opener_size',
					'title'      => esc_html__( 'Icon Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_opener_side_padding',
					'title'      => esc_html__( 'Icon Side Padding', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$close_icon_section_row = $opener_section->add_row_element(
				array(
					'name'  => 'qodef_fullscreen_close_icon_row',
					'title' => esc_html__( 'Close Icon Styles', 'qode-essential-addons' ),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_close_icon_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_close_icon_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_close_icon_size',
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
					'name'       => 'qodef_fullscreen_close_icon_top_position',
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
					'name'       => 'qodef_fullscreen_close_icon_right_position',
					'title'      => esc_html__( 'Right Position', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px or %', 'qode-essential-addons' ),
					),
				)
			);

			$close_icon_section_responsive_row = $opener_section->add_row_element(
				array(
					'name'  => 'qodef_fullscreen_close_icon_responsive_row',
					'title' => esc_html__( 'Responsive Close Icon Styles', 'qode-essential-addons' ),
				)
			);

			$close_icon_section_responsive_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_close_icon_top_position_1024',
					'title'      => esc_html__( 'Responsive Top Position', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px or %', 'qode-essential-addons' ),
					),
				)
			);

			$close_icon_section_responsive_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_close_icon_right_position_1024',
					'title'      => esc_html__( 'Responsive Right Position', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px or %', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_fullscreen_menu_options_map', $page, $general_tab );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_fullscreen_menu_options', qode_essential_addons_get_admin_options_map_position( 'fullscreen-menu' ) );
}
