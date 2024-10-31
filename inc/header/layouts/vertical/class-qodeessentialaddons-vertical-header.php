<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Vertical_Header extends QodeEssentialAddons_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'vertical' );
		$this->set_overriding_whole_header( true );
		$this->set_search_layout( 'covers-header' );

		parent::__construct();
	}

	/**
	 * Instance of module class
	 *
	 * @return QodeEssentialAddons_Vertical_Header
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function set_nav_menu_header_selector( $selector ) {
		return '.qodef-header--vertical .qodef-header-vertical-navigation';
	}

	public function set_nav_menu_narrow_header_selector( $selector ) {
		return '';
	}
}
