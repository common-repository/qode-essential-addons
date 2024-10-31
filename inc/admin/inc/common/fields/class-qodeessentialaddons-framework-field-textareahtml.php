<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Field_Textareahtml extends QodeEssentialAddons_Framework_Field_Type {

	public function render_field() {
		?>
		<textarea class="form-control qodef-field qodef--field-html" name="<?php echo esc_attr( $this->name ); ?>" rows="10"
		<?php
		if ( isset( $this->args['readonly'] ) ) {
			echo ' readonly';
		}
		?>
		>
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo qode_essential_addons_framework_wp_kses_html( 'content', $this->params['value'] );
			?>
		</textarea>
		<?php
	}
}
