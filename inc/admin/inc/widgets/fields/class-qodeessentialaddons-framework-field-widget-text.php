<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Field_Widget_Text extends QodeEssentialAddons_Framework_Field_Widget_Type {

	public function render() {
		?>
		<input class="widefat" id="<?php echo esc_attr( $this->params['id'] ); ?>" name="<?php echo esc_attr( $this->params['name'] ); ?>" type="text" value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
		<?php
	}
}
