<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_general_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_general_meta_box() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'  => apply_filters( 'qode_essential_addons_filter_general_meta_box_scope', array( 'post', 'page' ) ),
				'type'   => 'meta',
				'slug'   => 'general',
				'title'  => esc_html__( 'Qode Settings', 'qode-essential-addons' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_general_meta_box_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_meta_boxes_init', 'qode_essential_addons_add_general_meta_box' );
}
