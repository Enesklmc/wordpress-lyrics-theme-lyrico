<?php
/**
 * The Single Artist template for displaying Lyrics without album
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$this_artists_id = get_the_ID();

$args = array(
	'post_type'      => 'lyrico_lyrics',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'order'          => 'DESC',
	'meta_query'     => array(
		'relation'      => 'AND',
		'album_clause'  => array(
			'key'     => 'lyrico_album',
			'compare' => 'NOT EXISTS',
		),
		'artist_clause' => array(
			'key'   => 'lyrico_artist',
			'value' => $this_artists_id,
		),
	),
);

$query = new WP_Query( $args );
?>

<?php if ( $query->have_posts() ) : ?>
	<div id="artist-lyrics-without-album" class="lyrico-module-wrapper">
		<div class="lyrico-module">
			<div class="module-header">
				<h2 class="h3"><?php esc_html_e( 'Singles & Others', 'lyrico' ); ?></h2>
			</div>
			<ul class="list-unstyled no-border-last-child mb-0">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<li class="position-relative border-bottom py-2 py-md-3">
						<?php
						printf(
							// translators: 1: song URL, 2: song name.
							'<a href="%1$s" class="d-block primary-media-title stretched-link">%2$s</a>',
							esc_url( get_permalink() ),
							esc_html( get_the_title() )
						);
						lyrico_get_artists(
							array(
								'wrap_before' => '<span class="secondary-media-title">',
								'wrap_after'  => '</span>',
							)
						);
						?>
					</li>
					<?php
				endwhile;

				wp_reset_postdata();
				?>
			</ul>
		</div><!-- .lyrico-module -->
	</div><!-- #artist-lyrics-without-album -->
<?php endif; ?>
