<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons_Framework_Import_Options' ) ) {
	class QodeEssentialAddons_Framework_Import_Options {

		/**
		 * @var QodeEssentialAddons_Framework_Import_Options of current class
		 */
		private static $instance;

		/**
		 * Instance of module class
		 *
		 * @return QodeEssentialAddons_Framework_Import_Options
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function import( $demo ) {

			if ( isset( $demo['demo_import_options'] ) ) {

				$import_values = $demo['demo_import_options'];
				$return_value  = true;

				if ( is_array( $import_values ) && count( $import_values ) > 0 ) {

					foreach ( $import_values as $import_value ) {

						if ( is_array( $import_value ) && count( $import_value ) > 0 ) {

							$response        = qode_essential_addons_decode_content( $import_value['file_url'] );
							$current_options = get_option( $import_value['option_name'] );

							if ( $current_options !== $response ) {
								if ( false !== $response ) {
									$status = update_option( $import_value['option_name'], $response );

									if ( true !== $status ) {
										$return_value = false;
									}
								}
							}
						}
					}

					if ( true === $return_value ) {
						$this->update_options_after_import( $demo );
						qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'File Imported Successfully', 'qode-essential-addons' ) );
					} else {
						qode_essential_addons_framework_get_ajax_status( 'error', esc_html__( 'Problem Occurred During Options import', 'qode-essential-addons' ) );
					}
				}
			}
		}


		public function replace_url( $element, $index, $params ) {
			$element = str_replace( $params['demo_url'], $params['url'], $element );
		}

		public function update_options_after_import( $demo ) {
			$url      = esc_url( home_url( '/' ) );
			$demo_url = esc_url( $demo['demo_preview_url'] );

			$params = array(
				'url'      => $url,
				'demo_url' => $demo_url,
			);

			$global_options = get_option( QODE_ESSENTIAL_ADDONS_OPTIONS_NAME );

			array_walk_recursive( $global_options, array( $this, 'replace_url' ), $params );

			update_option( QODE_ESSENTIAL_ADDONS_OPTIONS_NAME, $global_options );
		}
	}
}
