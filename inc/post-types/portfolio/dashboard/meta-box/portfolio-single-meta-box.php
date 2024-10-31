<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_portfolio_single_meta_box() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'  => array( 'portfolio-item' ),
				'type'   => 'meta',
				'slug'   => 'portfolio-item',
				'title'  => esc_html__( 'Portfolio Settings', 'qode-essential-addons' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			$general_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-general',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'General Settings', 'qode-essential-addons' ),
					'description' => esc_html__( 'General portfolio settings', 'qode-essential-addons' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_layout',
					'title'       => esc_html__( 'Single Layout', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose default layout for portfolio single', 'qode-essential-addons' ),
					'options'     => apply_filters( 'qode_essential_addons_filter_portfolio_single_layout_options', array( '' => esc_html__( 'Default', 'qode-essential-addons' ) ) ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_content_order',
					'title'         => esc_html__( 'Set Content Order', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose whether project media or project info is displayed first', 'qode-essential-addons' ),
					'options'       => array(
						''            => esc_html__( 'Default', 'qode-essential-addons' ),
						'media-first' => esc_html__( 'Media First', 'qode-essential-addons' ),
						'info-first'  => esc_html__( 'Info First', 'qode-essential-addons' ),
					),
					'default_value' => 'media-first',
				)
			);

			$section_media = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_media_section',
					'title'       => esc_html__( 'Media Settings', 'qode-essential-addons' ),
					'description' => esc_html__( 'Media that will be displayed on portfolio page', 'qode-essential-addons' ),
				)
			);

			$media_repeater = $section_media->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_media',
					'title'       => esc_html__( 'Media Items', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter media items for this portfolio', 'qode-essential-addons' ),
					'button_text' => esc_html__( 'Add Media', 'qode-essential-addons' ),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_media_type',
					'title'         => esc_html__( 'Media Item Type', 'qode-essential-addons' ),
					'options'       => array(
						'gallery' => esc_html__( 'Gallery', 'qode-essential-addons' ),
						'image'   => esc_html__( 'Image', 'qode-essential-addons' ),
						'video'   => esc_html__( 'Video', 'qode-essential-addons' ),
						'audio'   => esc_html__( 'Audio', 'qode-essential-addons' ),
					),
					'default_value' => 'gallery',
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_gallery',
					'title'      => esc_html__( 'Upload Portfolio Images', 'qode-essential-addons' ),
					'multiple'   => 'yes',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'gallery',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_image',
					'title'      => esc_html__( 'Upload Portfolio Image', 'qode-essential-addons' ),
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'image',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_video',
					'title'       => esc_html__( 'Video URL', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your video URL', 'qode-essential-addons' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'video',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_audio',
					'title'       => esc_html__( 'Audio URL', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your audio URL', 'qode-essential-addons' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'audio',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$section_columns = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_columns_section',
					'title'       => esc_html__( 'Gallery Layout Settings', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set Gallery - Small and Big layouts settings', 'qode-essential-addons' ),
				)
			);

			$section_columns->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_columns_number',
					'title'      => esc_html__( 'Number of Columns', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
				)
			);

			$section_columns->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_space_between_items',
					'title'      => esc_html__( 'Space Between Items', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
				)
			);

			$section_info = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_info_section',
					'title'       => esc_html__( 'Info Settings', 'qode-essential-addons' ),
					'description' => esc_html__( 'Info that will be displayed on portfolio page', 'qode-essential-addons' ),
				)
			);

			$section_info->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_info_item_text_position',
					'title'         => esc_html__( 'Set Info Item Text Position', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose portfolio info item text position', 'qode-essential-addons' ),
					'options'       => array(
						''         => esc_html__( 'Default', 'qode-essential-addons' ),
						'below'    => esc_html__( 'Below', 'qode-essential-addons' ),
						'adjacent' => esc_html__( 'Adjacent', 'qode-essential-addons' ),
					),
					'default_value' => '',
				)
			);

			$info_items_repeater = $section_info->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_info_items',
					'title'       => esc_html__( 'Info Items', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter additional info for portoflio item', 'qode-essential-addons' ),
					'button_text' => esc_html__( 'Add Item', 'qode-essential-addons' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_label',
					'title'      => esc_html__( 'Item Label', 'qode-essential-addons' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_value',
					'title'      => esc_html__( 'Item Text', 'qode-essential-addons' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_link',
					'title'      => esc_html__( 'Item Link', 'qode-essential-addons' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_info_item_target',
					'title'      => esc_html__( 'Item Target', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'link_target' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_portfolio_meta_box_map', $page, $general_tab );
		}
	}

	add_action( 'qode_essential_addons_action_default_meta_boxes_init', 'qode_essential_addons_add_portfolio_single_meta_box' );
}

if ( ! function_exists( 'qode_essential_addons_include_general_meta_boxes_for_portfolio_single' ) ) {
	/**
	 * Function that add general meta box options for this module
	 */
	function qode_essential_addons_include_general_meta_boxes_for_portfolio_single() {
		$callbacks = qode_essential_addons_general_meta_box_callbacks();

		if ( ! empty( $callbacks ) ) {
			foreach ( $callbacks as $module => $callback ) {

				if ( 'page-sidebar' !== $module ) {
					add_action( 'qode_essential_addons_action_after_portfolio_meta_box_map', $callback );
				}
			}
		}
	}

	// Permission 8 is set in order to load it before default meta box function.
	add_action( 'qode_essential_addons_action_default_meta_boxes_init', 'qode_essential_addons_include_general_meta_boxes_for_portfolio_single', 8 );
}
