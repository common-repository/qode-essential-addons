<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Row_Meta extends QodeEssentialAddons_Framework_Row {

	public function add_repeater_element( $params ) {
		$params['type']          = 'meta-box';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		qode_essential_addons_framework_get_framework_root()->get_meta_options()->set_option( $params['name'], $params['default_value'], 'repeater' );

		return parent::add_repeater_element( $params );
	}

	public function add_field_element( $params ) {
		$params['type']          = 'meta-box';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		qode_essential_addons_framework_get_framework_root()->get_meta_options()->set_option( $params['name'], $params['default_value'], $params['field_type'] );
		parent::add_field_element( $params );
	}
}
