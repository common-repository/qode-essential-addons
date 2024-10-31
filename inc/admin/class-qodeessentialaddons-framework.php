<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Framework' ) ) {
	class QodeEssentialAddons_Framework {
		private static $instance;

		public function __construct() {
			// Hook to include additional modules before plugin loaded.
			do_action( 'qode_essential_addons_action_framework_before_framework_plugin_loaded' );

			$this->require_core();

			// Make plugin available for other plugins.
			add_action( 'plugins_loaded', array( $this, 'init_framework_root' ) );

			// Hook to include additional modules when plugin loaded.
			do_action( 'qode_essential_addons_action_framework_after_framework_plugin_loaded' );
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function require_core() {
			require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/helpers/include.php';
			require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/class-qodeessentialaddons-frameworkroot.php';
		}

		public function init_framework_root() {
			do_action( 'qode_essential_addons_action_framework_load_dependent_plugins' );

			$GLOBALS['qode_essential_addons_framework'] = qode_essential_addons_framework_get_framework_root();
		}
	}

	QodeEssentialAddons_Framework::get_instance();
}
