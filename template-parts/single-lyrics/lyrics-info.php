<?php
/**
 * The Single lyrics template for displaying lyrics info/details
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$album_id = get_post_meta( get_the_ID(), 'lyrico_album', true );

$info_table_fields = array(
	'producers'           => get_post_meta( get_the_ID(), 'lyrico_producers', true ),
	'song_length'         => get_post_meta( get_the_ID(), 'lyrico_length', true ),
	'released_year'       => get_post_meta( get_the_ID(), 'lyrico_released_year', true ),
	'album_released_year' => get_post_meta( $album_id, 'lyrico_released_year', true ),
);

$song_links = array(
	'youtube'     => get_post_meta( get_the_ID(), 'lyrico_youtube_link', true ),
	'spotify_url' => get_post_meta( get_the_ID(), 'lyrico_spotify_link', true ),
	'spotify_app' => get_post_meta( get_the_ID(), 'lyrico_spotify_app_link', true ),
	'soundcloud'  => get_post_meta( get_the_ID(), 'lyrico_soundcloud_link', true ),
);

$genres = get_the_terms( get_the_ID(), 'lyrico_genres' );
?>

<?php if ( ! empty( $genres ) || array_filter( $info_table_fields ) || array_filter( $song_links ) ) : ?>
<div id="lyrics-info-module" class="lyrico-module-wrapper">
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

			<?php if ( ! empty( $info_table_fields['producers'] ) ) : ?>
			<tr class="producers-table-row">
				<?php
				// if there is no more than one producers that seperated by comma, it's singular.
				if ( count( $info_table_fields['producers'] ) === 1 ) {
					printf( '<th>%s</th>', esc_html__( 'Producer:', 'lyrico' ) );
				} else {
					printf( '<th>%s</th>', esc_html__( 'Producers:', 'lyrico' ) );
				}
				?>
				<td>
					<?php
					lyrico_implode_and_support_schema(
						$info_table_fields['producers'],
						'<span itemprop="producer" itemscope itemtype="http://schema.org/Person">',
						'</span>'
					);
					?>
				</td>
			</tr><!-- .producers-table-row -->
			<?php endif; ?>

			<?php if ( ! empty( $info_table_fields['song_length'] ) ) : ?>
			<tr class="length-table-row">
				<th><?php esc_html_e( 'Length:', 'lyrico' ); ?></th>
				<?php
				printf(
					'<td><meta itemprop="duration" content="%1$s">%2$s</td>',
					esc_attr( lyrico_iso_length_format( $info_table_fields['song_length'] ) ),
					esc_html( $info_table_fields['song_length'] )
				);
				?>
			</tr><!-- .length-table-row -->
			<?php endif; ?>

			<?php if ( ! empty( $info_table_fields['released_year'] ) || ! empty( $info_table_fields['album_released_year'] ) ) : ?>
			<tr class="released-year-table-row">
				<th><?php esc_html_e( 'Released Year:', 'lyrico' ); ?></th>
				<td>
					<span itemprop="releasedEvent" itemscope itemtype="http://schema.org/PublicationEvent">
						<span itemprop="startDate">
							<?php echo esc_html( ! empty( $info_table_fields['released_year'] ) ? $info_table_fields['released_year'] : $info_table_fields['album_released_year'] ); ?>
						</span>
					</span>
				</td>
			</tr><!-- .released-year-table-row -->
			<?php endif; ?>

			<?php if ( array_filter( $song_links ) ) : ?>
			<tr class="listen-on-table-row">
				<th><?php esc_html_e( 'Listen on:', 'lyrico' ); ?></th>
				<td class="listen-the-song-on lyrico-brand-icons with-brand-colors">
					<?php if ( ! empty( $song_links['youtube'] ) ) : ?>
						<?php
						printf(
							'<a title="Youtube" target="_blank" href="%1$s" rel="nofollow">%2$s</a>',
							esc_url( $song_links['youtube'] ),
							'<i class="brand-icon fab fa-youtube"></i>'
						);
						?>
					<?php endif; ?>

					<?php if ( ! empty( $song_links['spotify_url'] ) ) : ?>
						<?php
						printf(
							'<a title="Spotify %1$s" target="_blank" href="%2$s" rel="nofollow">%3$s</a>',
							esc_attr__( 'Web Page', 'lyrico' ),
							esc_url( $song_links['spotify_url'] ),
							'<i class="brand-icon fab fa-spotify"><span>url</span></i>'
						);
						?>
					<?php endif; ?>

					<?php if ( ! empty( $song_links['spotify_app'] ) ) : ?>
						<?php
						printf(
							'<a title="Spotify %1$s" target="_blank" href="%2$s" rel="nofollow">%3$s</a>',
							esc_attr__( 'Application', 'lyrico' ),
							esc_html( $song_links['spotify_app'] ),
							'<i class="brand-icon fab fa-spotify"><span>app</span></i>'
						);
						?>
					<?php endif; ?>

					<?php if ( ! empty( $song_links['soundcloud'] ) ) : ?>
						<?php
						printf(
							'<a title="SoundCloud" target="_blank" href="%1$s" rel="nofollow">%2$s</a>',
							esc_url( $song_links['soundcloud'] ),
							'<i class="brand-icon fab fa-soundcloud"></i>'
						);
						?>
					<?php endif; ?>
				</td>
			</tr><!-- .listen-on-table-row -->
			<?php endif; ?>
		</table>
	</div><!-- .lyrico-module -->
</div><!-- .lyrico-module-wrapper -->
<?php endif; ?>
