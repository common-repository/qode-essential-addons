<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Field_Attachment_Text extends QodeEssentialAddons_Framework_Field_Attachment_Type {

	public function render() {
		$html = '<input type="text" name="' . esc_attr( $this->name ) . '" value="' . esc_attr( $this->params['value'] ) . '">';

		$this->form_fields['html'] = $html;
	}
}
