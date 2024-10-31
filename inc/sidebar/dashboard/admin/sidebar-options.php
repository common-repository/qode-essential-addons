<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_page_sidebar_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_page_sidebar_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'sidebar',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Sidebar', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Sidebar Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a default sidebar layout for pages', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'sidebar_layouts', false ),
					'default_value' => 'no-sidebar',
				)
			);

			$custom_sidebars = qode_essential_addons_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$page->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'qode-essential-addons' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on pages', 'qode-essential-addons' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a size for the widget bottom margin', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_widgets_title_margin_bottom',
					'title'       => esc_html__( 'Widgets Title Margin Bottom', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a size for the space between widget title and widget content', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_page_sidebar_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_page_sidebar_options', qode_essential_addons_get_admin_options_map_position( 'sidebar' ) );
}
