<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

// Load title image template.
qode_essential_addons_get_page_title_image();
?>
<div class="qodef-m-content <?php echo esc_attr( qode_essential_addons_get_page_title_content_classes() ); ?>">
	<<?php echo qode_essential_addons_framework_sanitize_tags( $title_tag ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="qodef-m-title entry-title">
		<?php echo wp_kses_post( qode_essential_addons_get_page_title_text() ); ?>
	</<?php echo qode_essential_addons_framework_sanitize_tags( $title_tag ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	// Load subtitle template.
	qode_essential_addons_template_part( 'title/layouts/standard', 'templates/parts/subtitle', '', qode_essential_addons_get_standard_title_layout_subtitle_text() );
	?>
</div>
