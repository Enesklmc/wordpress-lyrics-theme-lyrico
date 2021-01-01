<?php
/**
 * The Single Posts template for displaying related Posts(Lyrics, Artists, Playlists, Albums)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$tags   = wp_get_post_tags( get_the_ID() );
$genres = get_the_terms( get_the_ID(), 'lyrico_genres' );

$the_post_type        = get_post_type();
$the_post_type_object = get_post_type_object( $the_post_type );
$the_post_type_name   = $the_post_type_object->labels->name;

if ( $tags || $genres ) :
	$tag_ids = array();
	if ( $tags ) {
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->term_id;
		}
	}

	$genre_ids = array();
	if ( $genres ) {
		foreach ( $genres as $individual_genre ) {
			$genre_ids[] = $individual_genre->term_id;
		}
	}

	$args = array(
		'tax_query'           => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'lyrico_genres',
				'field'    => 'id',
				'terms'    => $genre_ids,
			),
			array(
				'taxonomy' => 'post_tag',
				'field'    => 'id',
				'terms'    => $tag_ids,
			),
		),
		'post_type'           => $the_post_type,
		'post_status'         => 'publish',
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => 8,
		'ignore_sticky_posts' => 1,
	);

	$query = new wp_query( $args );

	if ( $query->have_posts() ) :
		?>
		<div id="related-posts-module" class="lyrico-module-wrapper">
			<div class="lyrico-module">
				<div class="module-header">
					<h3>
					<?php
					printf(
						/* translators: %s: Post type name */
						esc_html__( 'Related %s', 'lyrico' ),
						esc_html( $the_post_type_name )
					);
					?>
					</h3>
				</div>

				<div class="row half-gutters related-posts-list<?php echo get_post_type() === 'lyrico_playlist' ? ' m-0' : ''; ?>">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>

						<?php if ( get_post_type() === 'lyrico_playlist' ) : ?>
						<div class="lyrico-flex-card">
							<?php get_template_part( 'template-parts/components/card', 'image-overlay' ); ?>
						</div>
						<?php else : ?>
						<div class="col-lg-6">
							<?php get_template_part( 'template-parts/components/media', 'thumbnail-text' ); ?>
						</div>
						<?php endif; ?>

						<?php
					endwhile;

					wp_reset_postdata();
					?>
				</div><!-- .related-posts-list -->
			</div><!-- .lyrico-module -->
		</div><!-- .lyrico-module-wrapper -->
	<?php endif; ?>

	<?php
endif;
