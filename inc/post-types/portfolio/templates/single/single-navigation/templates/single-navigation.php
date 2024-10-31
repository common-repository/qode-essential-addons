<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$is_enabled = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_enable_navigation' );

if ( 'yes' === $is_enabled ) {
	$through_same_category = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_navigation_through_same_category' ) === 'yes';
	?>
	<div id="qodef-single-portfolio-navigation" class="qodef-m">
		<div <?php echo qode_essential_addons_framework_get_class_attribute( apply_filters( 'qode_essential_addons_filter_portfolio_navigation_holder_classes', array() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<div <?php echo qode_essential_addons_framework_get_class_attribute( apply_filters( 'qode_essential_addons_filter_portfolio_navigation_classes', array() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php
				$post_navigation = array(
					'prev'      => array(
						'label' => '<span class="qodef-m-nav-label">' . apply_filters( 'qode_essential_addons_filter_portfolio_navigation_label_prev', esc_html__( 'Prev', 'qode-essential-addons' ) ) . '</span>',
						'icon'  => apply_filters( 'qode_essential_addons_filter_portfolio_navigation_icon_prev', qode_essential_addons_get_svg_icon( 'pagination-arrow-left', 'qodef-m-nav-icon' ) ),
					),
					'back-link' => array(),
					'next'      => array(
						'label' => '<span class="qodef-m-nav-label">' . apply_filters( 'qode_essential_addons_filter_portfolio_navigation_label_next', esc_html__( 'Next', 'qode-essential-addons' ) ) . '</span>',
						'icon'  => apply_filters( 'qode_essential_addons_filter_portfolio_navigation_icon_next', qode_essential_addons_get_svg_icon( 'pagination-arrow-right', 'qodef-m-nav-icon' ) ),
					),
				);

				if ( $through_same_category ) {
					if ( '' !== get_adjacent_post( true, '', true, 'portfolio-category' ) ) {
						$post_navigation['prev']['post'] = get_adjacent_post( true, '', true, 'portfolio-category' );
					}
					if ( '' !== get_adjacent_post( true, '', false, 'portfolio-category' ) ) {
						$post_navigation['next']['post'] = get_adjacent_post( true, '', false, 'portfolio-category' );
					}
				} else {
					if ( '' !== get_adjacent_post( false, '', true ) ) {
						$post_navigation['prev']['post'] = get_adjacent_post( false, '', true );
					}
					if ( '' !== get_adjacent_post( false, '', false ) ) {
						$post_navigation['next']['post'] = get_adjacent_post( false, '', false );
					}
				}

				$back_to_link = get_post_meta( get_the_ID(), 'qodef_portfolio_single_back_to_link', true );
				if ( '' !== $back_to_link ) {
					$post_navigation['back-link'] = array(
						'post'    => true,
						'post_id' => $back_to_link,
						'icon'    => qode_essential_addons_get_svg_icon( 'pagination-burger', 'qodef-m-nav-icon' ),
					);
				}

				foreach ( $post_navigation as $key => $value ) {
					if ( isset( $post_navigation[ $key ]['post'] ) ) {
						$current_post    = $value['post'];
						$current_post_id = isset( $value['post_id'] ) && ! empty( $value['post_id'] ) ? $value['post_id'] : $current_post->ID;
						?>
						<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( get_permalink( $current_post_id ) ); ?>">
							<?php
							if ( ! empty( $value['icon'] ) ) {
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo qode_essential_addons_framework_wp_kses_html( 'html', $value['icon'] );
							}

							if ( ! empty( $value['label'] ) ) {
								echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) );
							}
							?>
						</a>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
<?php } ?>
