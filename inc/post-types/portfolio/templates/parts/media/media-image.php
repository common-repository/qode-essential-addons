<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( isset( $media ) && ! empty( $media ) ) {
	$image_title = get_the_title( $media );
	$image_src   = qode_essential_addons_get_attachment_image_src( $media, 'full' );
	?>
	<a itemprop="image" class="qodef-popup-item qodef-grid-item" href="<?php echo esc_url( $image_src[0] ); ?>" data-type="image" data-fslightbox="gallery-<?php echo esc_attr( $unique ); ?>" title="<?php echo esc_attr( $image_title ); ?>">
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_get_attachment_image( $media, 'full' );
		?>
	</a>
<?php } ?>
