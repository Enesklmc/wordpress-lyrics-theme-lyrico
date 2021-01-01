<?php
/**
 * The Single Artist template for displaying Albums and Lyrics that belong the artist
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$this_artists_id = get_the_ID();

$args = array(
	'post_type'      => 'lyrico_album',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
	'meta_query'     => array(
		'relation'      => 'AND',
		'artist_clause' => array(
			'key'   => 'lyrico_artist',
			'value' => $this_artists_id,
		),
		'released_year' => array(
			'key'     => 'lyrico_released_year',
			'compare' => 'EXISTS',
			'type'    => 'NUMERIC',
		),
	),
	'orderby'        => 'released_year',
);

$query = new WP_Query( $args );
?>

<?php if ( $query->have_posts() ) : ?>
<div id="artist-albums-and-lyrics" class="lyrico-module-wrapper">
	<div class="lyrico-module">
		<div class="module-header">
			<h2 class="h3"><?php esc_html_e( 'Albums and Lyrics', 'lyrico' ); ?></h2>
		</div><!-- .module-header -->

		<div class="accordion artist-albums" id="accordion-albums">
			<?php
			$album_ordering = 0;
			while ( $query->have_posts() ) :
				$query->the_post();

				$album_songs_ordering = 0;

				$album_ordering++;

				$the_album_id = get_the_ID();

				$nested_args = array(
					'post_type'      => 'lyrico_lyrics',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'meta_query'     => array(
						'relation'       => 'AND',
						'album_clause'   => array(
							'key'   => 'lyrico_album',
							'value' => $the_album_id,
						),
						'artist_clause'  => array(
							'key'   => 'lyrico_artist',
							'value' => $this_artists_id,
						),
						'order_in_album' => array(
							'key'     => 'lyrico_order_in_album',
							'compare' => 'EXIST',
							'type'    => 'NUMERIC',
						),
					),
					'orderby'        => 'order_in_album',
					'order'          => 'ASC',
				);

				$nested_query = new WP_Query( $nested_args );
				?>
				<?php if ( $nested_query->have_posts() ) : ?>
				<div class="card">
					<?php
						$card_header_attributes = sprintf(
							'id=heading-%1$s data-target=#collapse-%1$s aria-controls=collapse-%1$s',
							$album_ordering
						);
					?>
					<div class="card-header p-3" data-toggle="collapse" aria-expanded="false" role="navigation" <?php echo esc_attr( $card_header_attributes ); ?>>
						<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
						<div class="image-wrapper">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'smaller-thumbnail', array( 'class' => 'artist-albums-image' ) ); ?>
						</div>
						<?php else : ?>
						<img alt="default-album" src="<?php echo esc_attr( get_theme_file_uri( 'assets/images/default/album.png' ) ); ?>" class="artist-albums-image">
						<?php endif; // check if album has post thumbnail. ?>

						<small class="lyrico-text-secondary d-block"><?php echo esc_html( get_post_meta( $the_album_id, 'lyrico_released_year', true ) ); ?></small>

						<h5 class="mb-0"><?php the_title(); ?></h5>

						<span class="fas fa-chevron-down accordion-card-header-arrow"></span>
					</div><!-- .card-header -->

					<?php
						$card_collapse_attributes = sprintf(
							'id=collapse-%1$s aria-labelledby=heading-%1$s',
							$album_ordering
						);
					?>
					<div class="collapse" data-parent="#accordion-albums" <?php echo esc_attr( $card_collapse_attributes ); ?>>
						<div class="card-body p-0">
							<ul class="list-group list-group-flush">
								<?php
								while ( $nested_query->have_posts() ) :
									$album_songs_ordering++;
									$nested_query->the_post();
									printf(
										// translators 1: Song order, 2: Song link, 3: Song title.
										'<li class="list-group-item"><span class="mr-3 lyrico-text-secondary">%1$s</span><a href="%2$s" class="stretched-link">%3$s</a></li>',
										intval( $album_songs_ordering ),
										esc_url( get_permalink() ),
										esc_html( get_the_title() )
									);
								endwhile;

								printf(
									// translators 1: Go to the album Url, 2: Button text, 3: Angle right icon.
									'<li class="list-group-item"><a href="%1$s" class="stretched-link float-right">%2$s%3$s</a></li>',
									esc_url( get_permalink( $the_album_id ) ),
									esc_html__( 'Go to the Album Page', 'lyrico' ),
									'<i class="fas fa-chevron-right ml-2"></i>'
								);

								wp_reset_postdata();
								?>
							</ul>
						</div><!-- .card-body -->
					</div><!-- #collapse-<?php echo intval( $album_ordering ); ?> -->
				</div><!-- .card -->
				<?php endif; ?>
			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>
		</div><!-- .accordion -->
	</div><!-- .lyrico-module -->
</div><!-- #artist-albums-and-lyrics -->
<?php endif; ?>
