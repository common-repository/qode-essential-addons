<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<a itemprop="url" class="qodef-header-logo-link <?php echo esc_attr( $logo_classes ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<?php
	// Hooks that allows you to add additional content before logo image.
	do_action( 'qode_essential_addons_before_header_logo_image' );

	// Include header logo image html.
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo qode_essential_addons_framework_wp_kses_html( 'html', $logo_image );

	// Hook to include additional content after header logo image.
	do_action( 'qode_essential_addons_after_header_logo_image' );
	?>
</a>
