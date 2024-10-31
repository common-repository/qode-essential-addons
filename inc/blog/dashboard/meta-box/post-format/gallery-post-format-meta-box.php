<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_gallery_post_format_meta_box' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param mixed $tab - general post format meta box section
	 */
	function qode_essential_addons_add_gallery_post_format_meta_box( $tab ) {

		if ( $tab ) {
			$post_format_section = $tab->add_section_element(
				array(
					'name'  => 'qodef_post_format_gallery_section',
					'title' => esc_html__( 'Post Format Gallery', 'qode-essential-addons' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_post_format_gallery_images',
					'title'       => esc_html__( 'Gallery Images', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose your gallery images for your post', 'qode-essential-addons' ),
					'multiple'    => 'yes',
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_gallery_post_format_meta_box', $tab );
		}
	}

	add_action( 'qode_essential_addons_action_post_formats_meta_box_map', 'qode_essential_addons_add_gallery_post_format_meta_box', 1 );
}
