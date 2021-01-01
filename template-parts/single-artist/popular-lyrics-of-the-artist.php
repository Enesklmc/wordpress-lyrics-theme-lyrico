<?php
/**
 * The Single Artist template for displaying Popular lyrics that belong the artist
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$this_artists_id = get_the_ID();

$args = array(
	'post_type'           => 'lyrico_lyrics',
	'post_status'         => 'publish',
	'posts_per_page'      => 10,
	'ignore_sticky_posts' => 1,
	'meta_query'          => array(
		'relation'      => 'AND',
		'artist_clause' => array(
			'key'   => 'lyrico_artist',
			'value' => $this_artists_id,
		),
		'post_views'    => array(
			'key'     => 'lyrico_post_views',
			'compare' => 'EXIST',
			'type'    => 'NUMERIC',
		),
	),
	'orderby'             => 'post_views',
	'order'               => 'DESC',
);

$query = new WP_Query( $args );
?>

<?php if ( $query->have_posts() ) : ?>
	<div id="artist-popular-lyrics" class="lyrico-module-wrapper">
		<div class="lyrico-module">
			<div class="module-header">
				<h2 class="h3">
					<?php
					printf(
						/* translators: %s: Name of a artist */
						esc_html__( 'Popular Lyrics Of %s', 'lyrico' ),
						esc_html( get_the_title() )
					);
					?>
				</h2>
			</div>
			<div class="row half-gutters">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="col-lg-6">
						<?php get_template_part( 'template-parts/components/media', 'thumbnail-text' ); ?>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div><!-- .row -->
		</div><!-- .lyrico-module -->
	</div><!-- #artist-popular-lyrics -->
<?php endif; ?>
