<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<?php $params['single_image_class'] = 'swiper-slide'; ?>
<div class="qodef-demo-sliders">
	<div class="qodef-swiper-container">
		<div class="swiper-counter"><p><span>1/<?php echo count( $demo['demo_additional_images_urls'] ) + 1; ?></span> <?php echo esc_html( 'pages' ); ?></p></div>
		<div class="swiper-wrapper">
			<?php
				qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/image', '', $params );
			foreach ( $demo['demo_additional_images_urls'] as $demo_additional_image_url ) {
				?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( $demo_additional_image_url ); ?>" alt="<?php echo esc_attr( $demo['demo_name'] ); ?>" />
			</div>
				<?php
			}
			?>
		</div>
		<div class="swiper-button-prev">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="13px" viewBox="-27.571 -3 14 13" enable-background="new -27.571 -3 14 13" xml:space="preserve">
				<polygon points="-21.333,10 -20.638,9.276 -25.691,4.012 -13.571,4.012 -13.571,2.988 -25.691,2.988 -20.638,-2.276 -21.333,-3 -27.571,3.5 "/>
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="13px" viewBox="-27.571 -3 14 13" enable-background="new -27.571 -3 14 13" xml:space="preserve">
				<polygon points="-19.81,-3 -20.504,-2.276 -15.451,2.988 -27.571,2.988 -27.571,4.012 -15.451,4.012 -20.504,9.276 -19.81,10 -13.571,3.5 "/>
			</svg>
		</div>
	</div>
</div>