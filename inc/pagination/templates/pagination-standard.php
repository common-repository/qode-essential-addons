<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( 'yes' === $enable_pagination && ! is_singular( 'post' ) && isset( $query_result ) && intval( $query_result->max_num_pages ) > 1 ) {
	?>
	<div class="qodef-m-pagination qodef--standard">
		<nav class="navigation pagination" role="navigation" aria-label="<?php esc_attr_e( 'Posts', 'qode-essential-addons' ); ?>">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'qode-essential-addons' ); ?></h2>
			<div class="nav-links">
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo paginate_links(
					array(
						'prev_text' => qode_essential_addons_get_svg_icon( 'pagination-arrow-left', 'qodef-m-pagination-icon' ),
						'next_text' => qode_essential_addons_get_svg_icon( 'pagination-arrow-right', 'qodef-m-pagination-icon' ),
						'current'   => max( 1, get_query_var( is_front_page() ? 'page' : 'paged' ) ),
						'total'     => intval( $query_result->max_num_pages ),
					)
				);
				?>
			</div>
		</nav>
	</div>
<?php } ?>
