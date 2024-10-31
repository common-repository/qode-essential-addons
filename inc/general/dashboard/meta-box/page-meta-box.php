<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'  => 'tab-page',
				'icon'  => 'fa fa-cog',
				'title' => esc_html__( 'Page Settings', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a background color for this page', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set an image for the page background', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_repeat',
				'title'       => esc_html__( 'Page Background Image Repeat', 'qode-essential-addons' ),
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

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_size',
				'title'       => esc_html__( 'Page Background Image Size', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set background image size', 'qode-essential-addons' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'qode-essential-addons' ),
					'contain' => esc_html__( 'Contain', 'qode-essential-addons' ),
					'cover'   => esc_html__( 'Cover', 'qode-essential-addons' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_background_position',
				'title'       => esc_html__( 'Page Background Image Position', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set background image position', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_attachment',
				'title'       => esc_html__( 'Page Background Image Attachment', 'qode-essential-addons' ),
				'description' => esc_html__( 'Choose a behavior style for the background image on this page', 'qode-essential-addons' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'qode-essential-addons' ),
					'fixed'  => esc_html__( 'Fixed', 'qode-essential-addons' ),
					'scroll' => esc_html__( 'Scroll', 'qode-essential-addons' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set padding that will be applied to page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set padding that will be applied to page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_wrapper_padding',
				'title'       => esc_html__( 'Page Wrapper Padding', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set padding that will be applied to page wrapper in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_wrapper_padding_mobile',
				'title'       => esc_html__( 'Page Wrapper Padding Mobile', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set padding that will be applied to page wrapper on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'qode-essential-addons' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Set boxed layout', 'qode-essential-addons' ),
				'default_value' => '',
				'options'       => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$boxed_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_boxed_section',
				'title'      => esc_html__( 'Boxed Layout Section', 'qode-essential-addons' ),
				'dependency' => array(
					'hide' => array(
						'qodef_boxed' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_boxed_background_color',
				'title'       => esc_html__( 'Boxed Background Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set boxed background color', 'qode-essential-addons' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_boxed_background_pattern',
				'title'       => esc_html__( 'Boxed Background Pattern', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set boxed background pattern', 'qode-essential-addons' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_boxed_background_pattern_behavior',
				'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set boxed background pattern behavior', 'qode-essential-addons' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'qode-essential-addons' ),
					'fixed'  => esc_html__( 'Fixed', 'qode-essential-addons' ),
					'scroll' => esc_html__( 'Scroll', 'qode-essential-addons' ),
				),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_boxed_background_pattern_size',
				'title'       => esc_html__( 'Boxed Background Pattern Size', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set boxed background pattern size', 'qode-essential-addons' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'qode-essential-addons' ),
					'auto'    => esc_html__( 'Auto', 'qode-essential-addons' ),
					'cover'   => esc_html__( 'Cover', 'qode-essential-addons' ),
					'contain' => esc_html__( 'Contain', 'qode-essential-addons' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'qode-essential-addons' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'qode-essential-addons' ),
				'options'     => qode_essential_addons_get_select_type_options_pool( 'content_width' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_content_behind_header',
				'title'         => esc_html__( 'Always put content behind header', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'qode-essential-addons' ),
			)
		);

		// Hook to include additional options after module options.
		do_action( 'qode_essential_addons_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'qode_essential_addons_action_after_general_meta_box_map', 'qode_essential_addons_add_general_page_meta_box', 9 );
}

if ( ! function_exists( 'qode_essential_addons_add_general_page_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function qode_essential_addons_add_general_page_meta_box_callback( $callbacks ) {
		$callbacks['page'] = 'qode_essential_addons_add_general_page_meta_box';

		return $callbacks;
	}

	add_filter( 'qode_essential_addons_filter_general_meta_box_callbacks', 'qode_essential_addons_add_general_page_meta_box_callback' );
}
