<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

abstract class QodeEssentialAddons_Search {
	private $search_layout;

	public function __construct() {
		// After qode_essential_addons_search_include_layout.
		add_action( 'wp', array( $this, 'set_variables' ), 11 );
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	public function get_search_layout() {
		return $this->search_layout;
	}

	public function set_search_layout( $search_layout ) {
		$this->search_layout = $search_layout;
	}

	public function set_variables() {
		$this->set_search_layout( QodeEssentialAddons_Headers::get_instance()->get_header_object()->get_search_layout() );
	}

	public function add_body_classes( $classes ) {
		$classes[] = 'qodef-search--' . $this->get_search_layout();

		return $classes;
	}
}
