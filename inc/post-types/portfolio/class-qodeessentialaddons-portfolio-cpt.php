<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_register_portfolio_for_meta_options' ) ) {
	/**
	 * Function that add custom post type into global meta box allowed items array for saving meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function qode_essential_addons_register_portfolio_for_meta_options( $post_types ) {
		$post_types[] = 'portfolio-item';

		return $post_types;
	}

	add_filter( 'qode_essential_addons_filter_framework_meta_box_save', 'qode_essential_addons_register_portfolio_for_meta_options' );
	add_filter( 'qode_essential_addons_filter_framework_meta_box_remove', 'qode_essential_addons_register_portfolio_for_meta_options' );
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_custom_post_type' ) ) {
	/**
	 * Function that adds portfolio custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_custom_post_type( $cpts ) {
		$cpts[] = 'QodeEssentialAddons_Portfolio_CPT';

		return $cpts;
	}

	add_filter( 'qode_essential_addons_filter_register_custom_post_types', 'qode_essential_addons_add_portfolio_custom_post_type' );
}

if ( class_exists( 'QodeEssentialAddons_Framework_Custom_Post_Type' ) ) {
	class QodeEssentialAddons_Portfolio_CPT extends QodeEssentialAddons_Framework_Custom_Post_Type {

		public function map_post_type() {
			$name = esc_html__( 'Portfolio', 'qode-essential-addons' );
			$this->set_base( 'portfolio-item' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-grid-view' );
			$this->set_slug( 'portfolio-item' );
			$this->set_name( $name );
			$this->set_path( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio' );
			$this->set_labels(
				array(
					'name'          => esc_html__( 'Qode Portfolio', 'qode-essential-addons' ),
					'singular_name' => esc_html__( 'Portfolio Item', 'qode-essential-addons' ),
					'add_item'      => esc_html__( 'New Portfolio Item', 'qode-essential-addons' ),
					'add_new_item'  => esc_html__( 'Add New Portfolio Item', 'qode-essential-addons' ),
					'edit_item'     => esc_html__( 'Edit Portfolio Item', 'qode-essential-addons' ),
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'portfolio-category',
					'slug'          => 'portfolio-category',
					'singular_name' => esc_html__( 'Category', 'qode-essential-addons' ),
					'plural_name'   => esc_html__( 'Categories', 'qode-essential-addons' ),
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'portfolio-tag',
					'slug'          => 'portfolio-tag',
					'singular_name' => esc_html__( 'Tag', 'qode-essential-addons' ),
					'plural_name'   => esc_html__( 'Tags', 'qode-essential-addons' ),
				)
			);
			apply_filters( 'qode_essential_addons_filter_portfolio_register', $this );
		}
	}
}
