<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_portfolio_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'portfolio-item',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Portfolio', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global settings related to portfolio', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {
			$list_item_layouts = apply_filters( 'qode_essential_addons_filter_portfolio_list_layouts', array() );
			$options_map       = qode_essential_addons_get_variations_options_map( $list_item_layouts );

			$archive_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-archive',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Portfolio List', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after archive module options.
			do_action( 'qode_essential_addons_action_before_portfolio_options_archive', $archive_tab );

			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_archive_item_layout',
					'title'         => esc_html__( 'Item Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a default layout for items displayed in portfolio archive pages', 'qode-essential-addons' ),
					'options'       => $list_item_layouts,
					'default_value' => $options_map['default_value'],
				)
			);

			$archive_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_archive_columns',
					'title'       => esc_html__( 'Number of Columns', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a default number of columns displayed in portfolio archive pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
				)
			);

			$archive_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_archive_space',
					'title'       => esc_html__( 'Space Between Items', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose space between items displayed in portfolio archive pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
				)
			);

			// Hook to include additional options after archive module options.
			do_action( 'qode_essential_addons_action_after_portfolio_options_archive', $archive_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-single',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Portfolio Single', 'qode-essential-addons' ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_layout',
					'title'         => esc_html__( 'Single Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a default layout for portfolio single pages', 'qode-essential-addons' ),
					'default_value' => apply_filters( 'qode_essential_addons_filter_portfolio_single_layout_default_value', '' ),
					'options'       => apply_filters( 'qode_essential_addons_filter_portfolio_single_layout_options', array() ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_portfolio_single_image_spacing',
					'title'         => esc_html__( 'Set Space Between Images', 'qode-essential-addons' ),
					'default_value' => '',
					'args'          => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
					'dependency'    => array(
						'show' => array(
							'qodef_portfolio_single_layout' => array(
								'values'        => array( 'images-big', 'images-small', 'images-big-full-width', 'images-small-full-width' ),
								'default_value' => '',
							),
						),
					),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_grid_gutter',
					'title'         => esc_html__( 'Space Between Items', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose space between media and content on portfolio single pages', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
					'default_value' => '',
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_title_tag',
					'title'       => esc_html__( 'Title Tag', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a default heading tag for portfolio item titles on portfolio single pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'title_tag' ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_content_order',
					'title'         => esc_html__( 'Set Content Order', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose whether portfolio media or portfolio content is displayed first', 'qode-essential-addons' ),
					'options'       => array(
						'media-first' => esc_html__( 'Media First', 'qode-essential-addons' ),
						'info-first'  => esc_html__( 'Info First', 'qode-essential-addons' ),
					),
					'default_value' => 'media-first',
				)
			);

			$section_info = $single_tab->add_section_element(
				array(
					'name'  => 'qodef_portfolio_info_project_section',
					'title' => esc_html__( 'Projects Info Settings', 'qode-essential-addons' ),
				)
			);

			$section_info->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_info_item_text_position',
					'title'         => esc_html__( 'Set Info Item Text Position', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose portfolio info item text position', 'qode-essential-addons' ),
					'options'       => array(
						'below'    => esc_html__( 'Below', 'qode-essential-addons' ),
						'adjacent' => esc_html__( 'Adjacent', 'qode-essential-addons' ),
					),
					'default_value' => 'below',
				)
			);

			// Hook to include additional options after single module options.
			do_action( 'qode_essential_addons_action_portfolio_info_options_single', $section_info );

			// Hook to include additional options after single module options.
			do_action( 'qode_essential_addons_action_after_portfolio_options_single', $single_tab );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_portfolio_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_portfolio_options', qode_essential_addons_get_admin_options_map_position( 'portfolio' ) );
}
