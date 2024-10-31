<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

if ( ! empty( $portfolio_media ) ) { ?>
	<div class="qodef-e qodef-fslightbox-popup qodef-popup-gallery">
		<?php
		foreach ( $portfolio_media as $media ) {
			$media_type = $media['qodef_portfolio_media_type'];
			$media_name = 'qodef_portfolio_' . $media_type;

			$params          = array();
			$params['media'] = $media[ $media_name ];
			// phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
			$params['unique'] = rand( 0, 999 );

			qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/media/media', $media_type, $params );
		}
		?>
	</div>
<?php } ?>
