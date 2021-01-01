<?php
/**
 * The Single Artist template for displaying Artist info/details
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$info_table_fields = array(
	'founding_year'     => get_post_meta( get_the_ID(), 'lyrico_founding_year', true ),
	'dissolution_year'  => get_post_meta( get_the_ID(), 'lyrico_dissolution_year', true ),
	'founding_location' => get_post_meta( get_the_ID(), 'lyrico_founding_location', true ),
	'related_website'   => get_post_meta( get_the_ID(), 'lyrico_related_website', true ),
);

$genres = get_the_terms( get_the_ID(), 'lyrico_genres' );
?>

<?php if ( ! empty( $genres ) || array_filter( $info_table_fields ) ) : ?>
	<div id="artist-info-module" class="lyrico-module-wrapper">
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

				<?php if ( ! empty( $info_table_fields['founding_year'] ) ) : ?>
				<tr class="founding-year-table-row">
					<th><?php esc_html_e( 'Founding Year:', 'lyrico' ); ?></th>
					<td>
						<span itemprop="foundingDate"><?php echo esc_html( $info_table_fields['founding_year'] ); ?></span>
					</td>
				</tr><!-- .founding-year-table-row -->
				<?php endif; ?>

				<?php if ( ! empty( $info_table_fields['dissolution_year'] ) ) : ?>
				<tr class="dissolution-year-table-row">
					<th><?php esc_html_e( 'Dissolution Year:', 'lyrico' ); ?></th>
					<td>
						<span itemprop="dissolutionDate"><?php echo esc_html( $info_table_fields['dissolution_year'] ); ?></span>
					</td>
				</tr><!-- .dissolution-year-table-row -->
				<?php endif; ?>

				<?php if ( ! empty( $info_table_fields['founding_location'] ) ) : ?>
				<tr class="founded-location-table-row">
					<th><?php esc_html_e( 'Founded Location:', 'lyrico' ); ?></th>
					<td>
						<span itemprop="foundingLocation"><?php echo esc_html( $info_table_fields['founding_location'] ); ?></span>
					</td>
				</tr><!-- .founded-location-table-row -->
				<?php endif; ?>

				<?php if ( ! empty( $info_table_fields['related_website'] ) ) : ?>
				<tr class="related-website-table-row">
					<th><?php esc_html_e( 'Website:', 'lyrico' ); ?></th>
					<td>
						<a target="_blank" itemprop="sameAs" href="<?php echo esc_url( $info_table_fields['related_website'] ); ?>"><?php echo esc_url( $info_table_fields['related_website'] ); ?></a>
					</td>
				</tr><!-- .related-website-table-row -->
				<?php endif; ?>
			</table>
		</div><!-- .lyrico-module -->
	</div><!-- .lyrico-module-wrapper -->
<?php endif; ?>
