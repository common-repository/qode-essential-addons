<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_blog_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_blog_single_meta_box() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'  => array( 'post' ),
				'type'   => 'meta',
				'slug'   => 'blog-settings',
				'title'  => esc_html__( 'Blog Settings', 'qode-essential-addons' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			$post_formats_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-post-formats',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Post Formats', 'qode-essential-addons' ),
				)
			);

			// Hook to include options in post formats tab.
			do_action( 'qode_essential_addons_action_post_formats_meta_box_map', $post_formats_tab );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_blog_single_meta_box_map', $page );
		}
	}

	// Permission 1 is set in order to this module be at the first place.
	add_action( 'qode_essential_addons_action_default_meta_boxes_init', 'qode_essential_addons_add_blog_single_meta_box', 1 );
}
