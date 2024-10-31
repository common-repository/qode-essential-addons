<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Header_Standard extends QodeEssentialAddons_Header {
	private static $instance;

	public function __construct() {
		$header_menu_position = $this->get_menu_position();

		$this->set_layout( 'standard' );
		if ( 'center' === $header_menu_position ) {
			$this->set_layout_slug( 'centered' );
		}

		$this->set_search_layout( 'covers-header' );
		$this->default_header_height = apply_filters( 'qode_essential_addons_filter_standard_header_default_height', 100 );

		add_filter( 'body_class', array( $this, 'add_body_classes' ) );

		parent::__construct();
	}

	/**
	 * Instance of module class
	 *
	 * @return QodeEssentialAddons_Header_Standard
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_menu_position() {
		return qode_essential_addons_get_post_value_through_levels( 'qodef_standard_header_menu_position' );
	}

	public function get_logo_position() {
		return qode_essential_addons_get_post_value_through_levels( 'qodef_standard_header_logo_centered' );
	}

	public function add_body_classes( $classes ) {
		$header_menu_position = $this->get_menu_position();
		$header_logo_position = $this->get_logo_position();

		$classes[] = ! empty( $header_menu_position ) ? 'qodef-header-standard--' . $header_menu_position : '';
		$classes[] = ! empty( $header_logo_position ) && 'yes' === $header_logo_position ? 'qodef-header-standard-logo-centered' : '';

		return $classes;
	}
}
