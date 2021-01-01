<?php
/**
 * Displays the footer widget area
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) :
	?>
	<div class="row pt-3 pb-2">
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<aside class="widget-area col-12 col-lg" aria-label="<?php esc_attr_e( 'Footer-1', 'lyrico' ); ?>">
				<div class="widget-column footer-widget-1">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			</aside><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<aside class="widget-area col-12 col-lg" aria-label="<?php esc_attr_e( 'Footer-2', 'lyrico' ); ?>">
				<div class="widget-column footer-widget-2">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
			</aside><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<aside class="widget-area col-12 col-lg" aria-label="<?php esc_attr_e( 'Footer-3', 'lyrico' ); ?>">
				<div class="widget-column footer-widget-3">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
			</aside><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
			<aside class="widget-area col-12 col-lg" aria-label="<?php esc_attr_e( 'Footer-4', 'lyrico' ); ?>">
				<div class="widget-column footer-widget-4">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			</aside><!-- .widget-area -->
		<?php endif; ?>

	</div>
	<hr class="footer-hr mb-3 mt-2">
	<?php
endif;
