<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Mobile_Header_Minimal extends QodeEssentialAddons_Mobile_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'minimal' );
		$this->default_header_height = 70;

		// Overrides default header template of theme.
		add_filter( 'the_q_filter_mobile_header_content_template', array( $this, 'load_template' ), 11 );
		add_filter( 'qi_filter_mobile_header_content_template', array( $this, 'load_template' ), 11 );

		add_action( 'wp_footer', array( $this, 'fullscreen_menu_template' ) );

		parent::__construct();
	}

	/**
	 * Instance of module class
	 *
	 * @return QodeEssentialAddons_Mobile_Header_Minimal
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function fullscreen_menu_template() {
		$header = qode_essential_addons_get_post_value_through_levels( 'qodef_header_layout' );

		if ( 'minimal' !== $header ) {
			$parameters = array(
				'fullscreen_menu_in_grid' => 'yes' === qode_essential_addons_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ),
			);

			qode_essential_addons_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
		}
	}

	public function load_template() {
		return qode_essential_addons_get_template_part( 'mobile-header/layouts/' . $this->get_layout(), 'templates/' . $this->get_layout() );
	}
}
