<?php
/**
 * The Single Album template for displaying Album info/details
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$genres = get_the_terms( get_the_ID(), 'lyrico_genres' );

$released_year = get_post_meta( get_the_ID(), 'lyrico_released_year', true );
?>

<?php if ( ! empty( $genres ) || ! empty( $released_year ) ) : ?>
	<div id="album-info-module" class="lyrico-module-wrapper">
		<div class="lyrico-module">
			<table class="table table-borderless lyrico-info-table">
				<?php if ( is_array( $genres ) && ! empty( $genres ) ) : ?>
				<tr class="genres-table-row">
					<?php if ( count( wp_get_object_terms( get_the_ID(), 'lyrico_genres' ) ) === 1 ) : ?>

						<th><?php esc_html_e( 'Genre:', 'lyrico' ); ?></th>

					<?php else : ?>

						<th><?php esc_html_e( 'Genres:', 'lyrico' ); ?></th>

					<?php endif; ?>
					<td><?php lyrico_show_genres(); ?></td>
				</tr><!-- .genres-table-row -->
				<?php endif; ?>

				<?php if ( ! empty( $released_year ) ) : ?>
				<tr class="released-year-table-row">
					<th><?php esc_html_e( 'Released Year:', 'lyrico' ); ?></th>
					<td>
						<span itemprop="releasedEvent" itemscope itemtype="http://schema.org/PublicationEvent">
							<span itemprop="startDate"><?php echo esc_html( $released_year ); ?></span>
						</span>
					</td>
				</tr><!-- .released-year-table-row -->
				<?php endif; ?>
			</table>
		</div><!-- .lyrico-module -->
	</div><!-- .lyrico-module-wrapper -->
<?php endif; ?>
