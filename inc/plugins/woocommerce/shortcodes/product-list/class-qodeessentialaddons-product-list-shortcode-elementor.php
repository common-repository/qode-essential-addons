<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Product_List_Shortcode_Elementor extends QodeEssentialAddons_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'qode_essential_addons_product_list' );

		parent::__construct( $data, $args );
	}
}

if ( qode_essential_addons_framework_is_installed( 'woocommerce' ) ) {
	qode_essential_addons_register_new_elementor_widget( new QodeEssentialAddons_Product_List_Shortcode_Elementor() );
}
