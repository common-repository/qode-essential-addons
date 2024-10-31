<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_blog_single_related_posts_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_blog_single_related_posts_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_single_enable_related_posts',
					'title'         => esc_html__( 'Enable Related Posts', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will show related posts section below post content on blog single pages', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			do_action( 'qode_essential_addons_action_after_blog_single_related_options_map', $page, 'qodef_blog_single_enable_related_posts' );
		}
	}

	add_action( 'qode_essential_addons_action_after_blog_single_options_map', 'qode_essential_addons_add_blog_single_related_posts_options' );
}
