<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_blog_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_blog_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'blog',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Blog', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Blog Options', 'qode-essential-addons' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {
			$custom_sidebars = qode_essential_addons_get_custom_sidebars();

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_before_blog_options_map', $page );

			$list_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-list',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Blog List', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after archive module options.
			do_action( 'qode_essential_addons_action_before_blog_options_archive', $list_tab );

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_archive_columns',
					'title'       => esc_html__( 'Number of Columns', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a default number of columns displayed in blog archive pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_archive_space',
					'title'       => esc_html__( 'Space Between Items', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose space between items displayed in blog archive pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a default sidebar layout for blog archive pages', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'sidebar_layouts' ),
					'default_value' => '',
				)
			);

			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_blog_archive_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'qode-essential-addons' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on blog archive pages', 'qode-essential-addons' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_blog_list_excerpt_number_of_characters',
					'title'       => esc_html__( 'Number of Characters in Excerpt', 'qode-essential-addons' ),
					'description' => esc_html__( 'Input the maximum number of characters you wish to display in excerpt for post summaries. Default value is 180', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_list_hide_read_more',
					'title'         => esc_html__( 'Hide Read More Button', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enable this option to hide read more button from posts', 'qode-essential-addons' ),
					'default_value' => 'no',
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_blog_list_read_more_options_map', $list_tab );

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_list_alignment',
					'title'         => esc_html__( 'Post Alignment', 'qode-essential-addons' ),
					'options'       => array(
						''       => esc_html__( 'Default', 'qode-essential-addons' ),
						'left'   => esc_html__( 'Left', 'qode-essential-addons' ),
						'center' => esc_html__( 'Center', 'qode-essential-addons' ),
						'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
					),
					'default_value' => '',
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_blog_list_options_map', $list_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-single',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Blog Single', 'qode-essential-addons' ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_sidebar_layout',
					'title'       => esc_html__( 'Sidebar Layout', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a default sidebar layout for blog single pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'sidebar_layouts' ),
				)
			);

			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$single_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_blog_single_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'qode-essential-addons' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on blog single pages', 'qode-essential-addons' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_blog_single_options_map', $single_tab );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_blog_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_blog_options', qode_essential_addons_get_admin_options_map_position( 'blog' ) );
}
