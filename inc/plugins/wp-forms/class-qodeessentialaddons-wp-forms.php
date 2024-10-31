<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_WP_Forms' ) ) {
	class QodeEssentialAddons_WP_Forms {
		private static $instance;

		public function __construct() {

			if ( qode_essential_addons_framework_is_installed( 'wp_forms' ) ) {
				// Init.
				$this->init();
			}
		}

		/**
		 * Instance of module class
		 *
		 * @return QodeEssentialAddons_WP_Forms
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function init() {

			// Include helper functions.
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/wp-forms/helper.php';

			// Include options.
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/wp-forms/dashboard/admin/wp-forms-options.php';
		}
	}

	QodeEssentialAddons_WP_Forms::get_instance();
}
