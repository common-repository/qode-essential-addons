<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_quote_post_format_meta_box' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param mixed $tab - general post format meta box section
	 */
	function qode_essential_addons_add_quote_post_format_meta_box( $tab ) {

		if ( $tab ) {
			$post_format_section = $tab->add_section_element(
				array(
					'name'  => 'qodef_post_format_quote_section',
					'title' => esc_html__( 'Post Format Quote', 'qode-essential-addons' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type' => 'textarea',
					'name'       => 'qodef_post_format_quote_text',
					'title'      => esc_html__( 'Quote Text', 'qode-essential-addons' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_post_format_quote_author',
					'title'      => esc_html__( 'Quote Author', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_quote_post_format_meta_box', $tab );
		}
	}

	add_action( 'qode_essential_addons_action_post_formats_meta_box_map', 'qode_essential_addons_add_quote_post_format_meta_box', 5 );
}
