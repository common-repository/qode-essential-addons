<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div <?php qode_essential_addons_framework_class_attribute( $holder_classes ); ?> <?php qode_essential_addons_framework_inline_attrs( $data_attr ); ?> <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_holder_styles( $params ) ); ?>>
	<div class="qodef-grid-inner">
		<?php
		// Include global masonry template from theme.
		qode_essential_addons_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// Include items.
		qode_essential_addons_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php
	// Include global pagination from theme.
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo apply_filters( 'qode_essential_addons_filter_list_pagination', qode_essential_addons_get_template_part( 'pagination', 'templates/pagination', 'standard', $params ), $params );

	do_action( 'qode_essential_addons_include_additional_list_html', $params );
	?>
</div>
