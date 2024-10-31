<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Shortcodes' ) ) {
	class QodeEssentialAddons_Shortcodes {
		private static $instance;
		private $allowed_shortcodes = array();

		public function __construct() {

			// Set properties value.
			$this->set_enabled_shortcodes();

			// Include shortcode abstract classes.
			add_action( 'qode_essential_addons_action_framework_before_shortcodes_register', array( $this, 'include_shortcode_classes' ), 5 );

			// Include shortcodes.
			add_action( 'qode_essential_addons_action_framework_before_shortcodes_register', array( $this, 'include_shortcodes' ) );

			// Register shortcodes (Priority 11 set because include of files is called on default action 10).
			add_action( 'qode_essential_addons_action_framework_before_shortcodes_register', array( $this, 'register_shortcodes' ), 11 );

			// Include shortcodes widget.
			add_action( 'qode_essential_addons_action_framework_before_widgets_register', array( $this, 'include_shortcodes_widget' ) );

			// Include shortcodes media fields.
			add_action( 'qode_essential_addons_action_framework_custom_media_fields', array( $this, 'include_shortcodes_media_fields' ) );
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function get_allowed_shortcodes() {
			return $this->allowed_shortcodes;
		}

		public function set_allowed_shortcodes( $allowed_shortcodes ) {
			$this->allowed_shortcodes[] = $allowed_shortcodes;
		}

		public function set_enabled_shortcodes() {

			foreach ( glob( QODE_ESSENTIAL_ADDONS_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $shortcode ) {
				$this->set_allowed_shortcodes( $shortcode );
			}
		}

		public function include_shortcode_classes() {
			include_once QODE_ESSENTIAL_ADDONS_SHORTCODES_PATH . '/class-qodeessentialaddons-shortcode.php';
			include_once QODE_ESSENTIAL_ADDONS_SHORTCODES_PATH . '/class-qodeessentialaddons-list-shortcode.php';
		}

		public function include_shortcodes() {
			$shortcodes = $this->get_allowed_shortcodes();

			$additional_shortcodes = apply_filters( 'qode_essential_addons_filter_include_shortcodes', array() );

			$shortcodes = array_merge( $shortcodes, $additional_shortcodes );

			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					foreach ( glob( $shortcode . '/include.php' ) as $shortcode ) {
						include_once $shortcode;
					}
				}
			}
		}

		public function register_shortcodes() {
			$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

			$shortcodes = apply_filters( 'qode_essential_addons_filter_register_shortcodes', array() );

			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					$qode_essential_addons_framework->add_shortcode( new $shortcode() );
				}
			}
		}

		public function include_shortcodes_widget() {
			$shortcodes = $this->get_allowed_shortcodes();

			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					foreach ( glob( $shortcode . '/widget/include.php' ) as $widget ) {
						include_once $widget;
					}
				}
			}
		}

		public function include_shortcodes_media_fields() {
			$shortcodes = $this->get_allowed_shortcodes();

			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					foreach ( glob( $shortcode . '/media-custom-fields.php' ) as $media ) {
						include_once $media;
					}
				}
			}
		}
	}

	QodeEssentialAddons_Shortcodes::get_instance();
}
