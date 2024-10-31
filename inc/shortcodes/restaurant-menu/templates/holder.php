<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div <?php qode_essential_addons_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-inner">
		<?php
		$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'p';

		foreach ( $items as $item ) {
			?>
			<div class="qodef-m-item qodef-e">
				<?php if ( ! empty( $item['item_title'] ) ) : ?>
					<div class="qodef-e-heading">
						<<?php echo qode_essential_addons_framework_sanitize_tags( $title_tag ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="qodef-e-heading-title" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>><?php echo wp_kses_post( $item['item_title'] ); ?></<?php echo qode_essential_addons_framework_sanitize_tags( $title_tag ); ?>>
						<div class="qodef-e-heading-line" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_line_styles( $params ) ); ?>></div>
						<?php if ( ! empty( $item['item_price'] ) ) : ?>
							<p class="qodef-e-heading-price" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_price_styles( $params ) ); ?>><?php echo esc_html( $item['item_price'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $item['item_description'] ) ) : ?>
					<p class="qodef-e-description" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_description_styles( $params ) ); ?>><?php echo wp_kses_post( $item['item_description'] ); ?></p>
				<?php endif; ?>
			</div>
		<?php } ?>
	</div>
</div>
