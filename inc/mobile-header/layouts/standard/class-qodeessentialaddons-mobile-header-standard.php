<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Mobile_Header_Standard extends QodeEssentialAddons_Mobile_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'standard' );
		$this->default_header_height = 70;

		parent::__construct();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
