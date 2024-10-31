<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( isset( $media ) && ! empty( $media ) ) {
	$images = explode( ',', $media );

	foreach ( $images as $image ) {
		if ( isset( $image ) && ! empty( $image ) ) {
			$image_title = get_the_title( $image );
			$image_src   = qode_essential_addons_get_attachment_image_src( $image, 'full' );
			?>
			<div class="swiper-slide" itemprop="image" data-type="image" title="<?php echo esc_attr( $image_title ); ?>">
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo qode_essential_addons_get_attachment_image( $image, 'full' );
				?>
			</div>
			<?php
		}
	}
}
