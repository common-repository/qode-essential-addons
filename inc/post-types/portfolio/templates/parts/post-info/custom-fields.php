<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$portfolio_info_items = get_post_meta( get_the_ID(), 'qodef_portfolio_info_items', true );

if ( ! empty( $portfolio_info_items ) ) {
	foreach ( $portfolio_info_items as $item ) {
		$item_label  = $item['qodef_info_item_label'];
		$item_value  = $item['qodef_info_item_value'];
		$item_link   = $item['qodef_info_item_link'];
		$item_target = ! empty( $item['qodef_info_item_target'] ) ? $item['qodef_info_item_target'] : '_blank';
		?>
		<div class="qodef-e qodef-info--info-items">
			<?php if ( ! empty( $item_label ) ) { ?>
				<p class="qodef-e-title qodef-style--meta"><?php echo esc_html( $item_label ); ?></p>
			<?php } ?>
			<?php if ( ! empty( $item_link ) ) { ?>
				<a class="qodef-e-info-item qodef--link" href="<?php echo esc_url( $item_link ); ?>" target="<?php echo esc_attr( $item_target ); ?>">
			<?php } else { ?>
				<span class="qodef-e-info-item">
			<?php } ?>
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo qode_essential_addons_framework_wp_kses_html( 'content', $item_value );
				?>
			<?php if ( empty( $item_link ) ) { ?>
				</span>
			<?php } else { ?>
				</a>
			<?php } ?>
		</div>
	<?php } ?>
	<?php
}

// Hook to include additional content after portfolio single custom fields.
do_action( 'qode_essential_addons_action_after_portfolio_single_custom_fields' );
