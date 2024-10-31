<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_WooCommerce' ) ) {
	class QodeEssentialAddons_WooCommerce {
		private static $instance;

		public function __construct() {

			if ( qode_essential_addons_framework_is_installed( 'woocommerce' ) ) {
				// Include files.
				$this->include_files();
			}
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function include_files() {

			// Include helper functions.
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/helper.php';

			// Include options.
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/dashboard/admin/woocommerce-options.php';
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/dashboard/admin/woocommerce-info-options.php';
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/dashboard/meta-box/product-meta-box.php';

			// Include shortcodes.
			add_action( 'qode_essential_addons_action_framework_before_shortcodes_register', array( $this, 'include_shortcodes' ) );

			// Include widgets.
			add_action( 'qode_essential_addons_action_framework_before_widgets_register', array( $this, 'include_widgets' ) );

			// Include plugin addons.
			foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/plugins/*/include.php' ) as $plugin ) {
				include_once $plugin;
			}
		}

		public function include_shortcodes() {
			foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/shortcodes/*/include.php' ) as $shortcode ) {
				include_once $shortcode;
			}
		}

		public function include_widgets() {
			foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/widgets/*/include.php' ) as $widget ) {
				include_once $widget;
			}
		}
	}

	QodeEssentialAddons_WooCommerce::get_instance();
}
