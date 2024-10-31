<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$quote_meta = get_post_meta( get_the_ID(), 'qodef_post_format_quote_text', true );
$quote_text = ! empty( $quote_meta ) ? $quote_meta : get_the_title();

if ( ! empty( $quote_text ) ) {
	$quote_author       = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author', true );
	$author_title_tag   = isset( $author_title_tag ) && ! empty( $author_title_tag ) ? $author_title_tag : 'h6';
	$show_info_on_quote = isset( $show_info_on_quote ) && 'yes' === ( $show_info_on_quote ) ? true : false;
	?>
	<div class="qodef-e-quote">
		<?php qode_essential_addons_render_svg_icon( 'quote', 'qodef-e-quote-icon' ); ?>
		<?php if ( $show_info_on_quote ) { ?>
			<div class="qodef-e-info qodef-info--top qodef-info-style">
				<?php
				// Include post category info.
				qode_essential_addons_template_part( 'blog', 'templates/parts/post-info/category' );

				// Include post author info.
				qode_essential_addons_template_part( 'blog', 'templates/parts/post-info/author' );
				?>
			</div>
		<?php } ?>
		<<?php echo qode_essential_addons_framework_sanitize_tags( $quote_link_tag ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="qodef-e-quote-text"><?php echo esc_html( $quote_text ); ?></<?php echo qode_essential_addons_framework_sanitize_tags( $quote_link_tag ); ?>>
		<?php if ( ! empty( $quote_author ) ) { ?>
			<<?php echo qode_essential_addons_framework_sanitize_tags( $author_title_tag ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="qodef-e-quote-author"><?php echo esc_html( $quote_author ); ?></<?php echo qode_essential_addons_framework_sanitize_tags( $author_title_tag ); ?>>
		<?php } ?>
		<?php if ( ! is_single() ) { ?>
			<a itemprop="url" class="qodef-e-quote-url" href="<?php the_permalink(); ?>"></a>
		<?php } ?>
	</div>
<?php } ?>
