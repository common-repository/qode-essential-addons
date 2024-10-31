<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Field_Textarea extends QodeEssentialAddons_Framework_Field_Type {

	public function render_field() {
		?>
		<textarea class="form-control qodef-field" name="<?php echo esc_attr( $this->name ); ?>" rows="10" placeholder="<?php echo isset( $this->args['placeholder'] ) ? esc_attr( esc_html( $this->args['placeholder'] ) ) : ''; ?>"
			<?php
			if ( isset( $this->args['readonly'] ) ) {
				echo ' readonly';
			}
			?>
		><?php echo esc_html( $this->params['value'] ); ?></textarea>
		<?php
	}
}
