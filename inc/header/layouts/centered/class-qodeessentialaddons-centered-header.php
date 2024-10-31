<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Centered_Header extends QodeEssentialAddons_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'centered' );
		$this->set_search_layout( 'covers-header' );
		$this->default_header_height = apply_filters( 'qode_essential_addons_filter_centered_header_default_height', 150 );

		parent::__construct();
	}

	/**
	 * Instance of module class
	 *
	 * @return QodeEssentialAddons_Centered_Header
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
