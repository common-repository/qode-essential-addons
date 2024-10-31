<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Breadcrumbs_Title extends QodeEssentialAddons_Title {
	private static $instance;

	public function __construct() {
		$this->slug = 'breadcrumbs';
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
