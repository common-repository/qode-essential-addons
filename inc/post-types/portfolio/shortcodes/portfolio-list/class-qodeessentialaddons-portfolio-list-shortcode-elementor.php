<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Portfolio_List_Shortcode_Elementor extends QodeEssentialAddons_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'qode_essential_addons_portfolio_list' );

		parent::__construct( $data, $args );
	}
}

qode_essential_addons_register_new_elementor_widget( new QodeEssentialAddons_Portfolio_List_Shortcode_Elementor() );
