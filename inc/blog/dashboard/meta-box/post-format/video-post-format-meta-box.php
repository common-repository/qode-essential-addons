<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_video_post_format_meta_box' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param mixed $tab - general post format meta box section
	 */
	function qode_essential_addons_add_video_post_format_meta_box( $tab ) {

		if ( $tab ) {
			$post_format_section = $tab->add_section_element(
				array(
					'name'  => 'qodef_post_format_video_section',
					'title' => esc_html__( 'Post Format Video', 'qode-essential-addons' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_post_format_video_url',
					'title'       => esc_html__( 'Video URL', 'qode-essential-addons' ),
					'description' => esc_html__( 'Input your video link here. Here are all the supported video formats https://wordpress.org/support/article/video-shortcode/#options  https://wordpress.org/support/article/embeds/#okay-so-what-sites-can-i-embed-from', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_video_post_format_meta_box', $tab );
		}
	}

	add_action( 'qode_essential_addons_action_post_formats_meta_box_map', 'qode_essential_addons_add_video_post_format_meta_box', 2 );
}
