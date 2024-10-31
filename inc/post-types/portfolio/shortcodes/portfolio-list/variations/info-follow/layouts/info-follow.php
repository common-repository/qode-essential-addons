<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
		<div class="qodef-e-image">
			<?php qode_essential_addons_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<div class="qodef-e-content-inner" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_content_styles( $params ) ); ?>>
				<?php if ( 'category-first' === $content_order ) { ?>
					<div class="qodef-e-category-holder">
						<?php qode_essential_addons_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
					</div>
					<div class="qodef-e-title-holder" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
						<?php qode_essential_addons_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
					</div>
				<?php } else { ?>
					<div class="qodef-e-title-holder" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
						<?php qode_essential_addons_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
					</div>
					<div class="qodef-e-category-holder">
						<?php qode_essential_addons_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</article>
