<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_typography_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'typography',
				'icon'        => 'fa fa-indent',
				'title'       => esc_html__( 'Typography', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Typography Options', 'qode-essential-addons' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_typography_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_typography_options', qode_essential_addons_get_admin_options_map_position( 'typography' ) );
}
