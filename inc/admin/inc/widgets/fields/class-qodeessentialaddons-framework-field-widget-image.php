<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Field_Widget_Image extends QodeEssentialAddons_Framework_Field_Widget_Type {

	public function render() {
		?>
		<span class="qodef-image-uploader" data-file="no">
			<span class="qodef-image-thumb">
				<?php
				if ( '' !== $this->params['value'] ) {
					$image     = qode_essential_addons_get_attachment_image_src( $this->params['value'], 'thumbnail', false );
					$image_src = ! empty( $image ) ? $image[0] : $this->params['value'];
					?>
					<img class="qodef-single-image" src="<?php echo esc_url( $image_src ); ?>" alt="<?php esc_attr_e( 'Image Thumbnail', 'qode-essential-addons' ); ?>"/>
				<?php } ?>
			</span>
			<span class="qodef-image-meta-fields qodef-hide">
				<input type="hidden" class="qodef-field qodef-image-upload-id"
					   id="<?php echo esc_attr( $this->params['id'] ); ?>"
					   name="<?php echo esc_attr( $this->params['name'] ); ?>"
					   value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
			</span>
			<a class="button button-secondary qodef-image-upload-btn" href="javascript:void(0)"
			   data-frame-title="<?php esc_attr_e( 'Select Image', 'qode-essential-addons' ); ?>"
			   data-frame-button-text="<?php esc_attr_e( 'Select Image', 'qode-essential-addons' ); ?>"><?php esc_html_e( 'Upload', 'qode-essential-addons' ); ?></a>
			<a href="javascript: void(0)"
			   class="button button-secondary qodef-image-remove-btn qodef-hide"><?php esc_html_e( 'Remove', 'qode-essential-addons' ); ?></a>
		</span>
		<?php
	}
}
