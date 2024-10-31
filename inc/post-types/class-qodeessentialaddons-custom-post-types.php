<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Custom_Post_Types' ) ) {
	class QodeEssentialAddons_Custom_Post_Types {
		private static $instance;
		private $allowed_post_types = array();

		public function __construct() {

			// Set properties value.
			$this->set_enabled_post_types();

			// Include register post types file.
			add_action( 'qode_essential_addons_action_framework_before_post_types_register', array( $this, 'include_register_files' ) );

			// Register post types (Priority 11 set because include of files is called on default action 10).
			add_action( 'qode_essential_addons_action_framework_before_post_types_register', array( $this, 'register_post_types' ), 11 );

			// Include taxonomies.
			add_action( 'qode_essential_addons_action_framework_custom_taxonomy_fields', array( $this, 'include_taxonomies' ) );

			// Register taxonomies.
			add_action( 'qode_essential_addons_action_framework_custom_taxonomy_fields', array( $this, 'register_taxonomies' ), 11 );

			// Include shortcodes.
			add_action( 'qode_essential_addons_action_framework_before_shortcodes_register', array( $this, 'include_shortcodes' ) );

			// Include files.
			$this->include_files();
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function get_allowed_post_types() {
			return $this->allowed_post_types;
		}

		public function set_allowed_post_types( $allowed_post_types ) {
			$this->allowed_post_types[] = $allowed_post_types;
		}

		public function set_enabled_post_types() {

			foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/*', GLOB_ONLYDIR ) as $post_type ) {
				$this->set_allowed_post_types( $post_type );
			}

			do_action( 'qode_essential_addons_action_add_custom_post_type', $this );
		}

		public function include_register_files() {
			$post_types = $this->get_allowed_post_types();

			if ( ! empty( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					foreach ( glob( $post_type . '/*-cpt.php' ) as $post_type_load ) {
						include_once $post_type_load;
					}
				}
			}
		}

		public function register_post_types() {
			$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();
			$cpts                            = apply_filters( 'qode_essential_addons_filter_register_custom_post_types', $cpts = array() );

			if ( ! empty( $cpts ) ) {
				foreach ( $cpts as $cpt ) {
					$qode_essential_addons_framework->add_custom_post_type( new $cpt() );
				}
			}
		}

		public function include_taxonomies() {
			// Hook to includes custom post types taxonomy fields.
			do_action( 'qode_essential_addons_action_include_cpt_tax_fields' );
		}

		public function register_taxonomies() {
			// Hook to includes custom post types taxonomy fields.
			do_action( 'qode_essential_addons_action_register_cpt_tax_fields' );
		}

		public function include_shortcodes() {
			$post_types = $this->get_allowed_post_types();

			if ( ! empty( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					foreach ( glob( $post_type . '/shortcodes/*/include.php' ) as $shortcode ) {
						include_once $shortcode;
					}
				}
			}
		}

		public function include_files() {
			$post_types = $this->get_allowed_post_types();

			if ( ! empty( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					include_once $post_type . '/include.php';
				}
			}
		}
	}

	QodeEssentialAddons_Custom_Post_Types::get_instance();
}
