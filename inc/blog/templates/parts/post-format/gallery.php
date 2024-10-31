<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$gallery_meta = get_post_meta( get_the_ID(), 'qodef_post_format_gallery_images', true );

if ( ! empty( $gallery_meta ) ) { ?>
	<div class="qodef-e-media-gallery qodef-swiper-container">
		<div class="swiper-wrapper">
			<?php
			$gallery_images = explode( ',', $gallery_meta );

			foreach ( $gallery_images as $image_id ) {
				?>
				<div class="qodef-e-media-gallery-item swiper-slide">
					<?php if ( ! is_single() ) { ?>
						<a itemprop="url" href="<?php the_permalink(); ?>">
					<?php } ?>
						<?php
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo qode_essential_addons_get_attachment_image( $image_id, 'full' );
						?>
					<?php if ( ! is_single() ) { ?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<?php qode_essential_addons_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	</div>
<?php } else {
	// Include featured image.
	qode_essential_addons_template_part( 'blog', 'templates/parts/post-info/image' );
} ?>
