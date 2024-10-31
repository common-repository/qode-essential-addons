<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-e qodef-info--date">
	<p class="qodef-e-title qodef-style--meta"><?php esc_html_e( 'date', 'qode-essential-addons' ); ?></p>
	<p itemprop="dateCreated" class="entry-date updated"><?php the_time( get_option( 'date_format' ) ); ?></p>
</div>
