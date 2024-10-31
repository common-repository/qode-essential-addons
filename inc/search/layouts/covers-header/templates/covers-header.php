<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$custom_icon = qode_essential_addons_get_opener_icon_html_content( 'search', true );

$icon_classes = array();
if ( empty( $custom_icon ) ) {
	$icon_classes[] = 'qodef--predefined';
}
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-search-cover-form" method="get">
	<div class="qodef-m-inner">
		<input type="text" placeholder="<?php esc_attr_e( 'Enter keywords...', 'qode-essential-addons' ); ?>" name="s" class="qodef-m-form-field" autocomplete="off" required/>
		<a href="javascript:void(0)" class="qodef-m-close qodef-opener-icon qodef-m <?php echo esc_attr( implode( ' ', $icon_classes ) ); ?>">
			<span class="qodef-m-icon">
				<?php
				if ( ! empty( $custom_icon ) ) {
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo qode_essential_addons_get_opener_icon_html_content( 'search', true );
				} else {
					qode_essential_addons_render_svg_icon( 'plus' );
				}
				?>
			</span>
		</a>
	</div>
</form>
