<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div <?php wc_product_class( $item_classes ); ?>>
	<div class="qodef-woo-product-inner">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="qodef-woo-product-image">
				<?php qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/mark' ); ?>
				<?php qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
				<div class="qodef-woo-product-image-inner" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_image_hover_background_styles( $params ) ); ?>>
					<?php
					qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' );

					// Hook to include additional content inside product list item image.
					do_action( 'qode_essential_addons_action_product_list_item_additional_image_content' );
					?>
				</div>
			</div>
		<?php } ?>
		<div class="qodef-woo-product-content" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_content_styles( $params ) ); ?>>
			<?php qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/category', '', $params ); ?>
			<div class="qodef-woo-product-heading">
				<?php qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
				<?php qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
			</div>
			<?php qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params ); ?>
			<?php
			// Hook to include additional content inside product list item content.
			do_action( 'qode_essential_addons_action_product_list_item_additional_content' );
			?>
		</div>
		<?php qode_essential_addons_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
	</div>
</div>
