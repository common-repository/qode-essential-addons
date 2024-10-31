<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Mobile_Headers {
	private static $instance;
	private $layout_meta;
	private $layouts;
	private $mobile_header_object;

	public function __construct() {

		// Includes header layouts.
		$this->include_elements();

		// Set module variables.
		// wp hook is set because we need to wait global wp_query object to instance in order to get page id.
		add_action( 'wp', array( $this, 'set_variables' ) );

		// Add module body classes.
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_layout_meta() {
		return $this->layout_meta;
	}

	public function set_layout_meta( $layout_meta ) {
		$this->layout_meta = $layout_meta;
	}

	public function get_layouts() {
		return $this->layouts;
	}

	public function set_layouts( $layouts ) {
		$this->layouts = $layouts;
	}

	public function get_mobile_header_object() {
		return $this->mobile_header_object;
	}

	public function set_mobile_header_object( $mobile_header_object ) {
		$this->mobile_header_object = $mobile_header_object;
	}

	public function include_elements() {

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/mobile-header/dashboard/*/*.php' ) as $admin ) {
			include_once $admin;
		}
		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/mobile-header/layouts/*/include.php' ) as $layout ) {
			include_once $layout;
		}
	}

	public function set_variables() {
		$layout_meta = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_header_layout' );
		$layouts     = apply_filters( 'qode_essential_addons_filter_register_mobile_header_layouts', $header_layouts_option = array() );

		$this->set_layout_meta( $layout_meta );
		$this->set_layouts( $layouts );

		if ( ! empty( $layout_meta ) && ! empty( $layouts ) ) {
			foreach ( $layouts as $key => $value ) {
				if ( $layout_meta === $key ) {

					$this->set_mobile_header_object( $value::get_instance() );
				}
			}
		}
	}

	public function add_body_classes( $classes ) {
		$header_layout = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_header_layout' );
		$classes[]     = ! empty( $header_layout ) ? 'qodef-mobile-header--' . $header_layout : '';

		return $classes;
	}
}

QodeEssentialAddons_Mobile_Headers::get_instance();
