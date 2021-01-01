<?php
/**
 * The Single lyrics template for displaying songs from the album
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$this_lyrics_id = get_the_ID();
$album_id       = get_post_meta( get_the_ID(), 'lyrico_album', true );

$args = array(
	'post_type'      => 'lyrico_lyrics',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'meta_query'     => array(
		'relation'       => 'AND',
		'album_clause'   => array(
			'key'   => 'lyrico_album',
			'value' => $album_id,
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

$query = new WP_Query( $args );
?>

<?php if ( $query->found_posts > 1 ) : ?>
<div id="other-songs-from-the-album-module" class="lyrico-module-wrapper">
	<div class="lyrico-module p-0">
		<div class="media p-2 p-md-3 other-songs-from-the-album-header align-items-center">
			<div class="px-3 media-body d-flex flex-column align-self-stretch justify-content-center">
				<?php
				$the_album = sprintf(
					/* translators: 1: album url. 2: album name. */
					'<a href="%1$s">%2$s</a>',
					esc_url( get_the_permalink( $album_id ) ),
					esc_html( get_the_title( $album_id ) )
				);
				printf(
					/* translators: %s: Name of the Album */
					esc_html__( 'Other Songs From %s', 'lyrico' ),
					wp_kses(
						$the_album,
						array(
							'a' => array(
								'href'  => array(),
								'class' => array(),
							),
						)
					)
				);
				?>
			</div>

			<?php if ( has_post_thumbnail( $album_id ) ) : ?>
			<div class="image-wrapper">
				<?php echo get_the_post_thumbnail( $album_id, 'smaller-thumbnail', array( 'class' => 'ml-2 border rounded' ) ); ?>
			</div>
			<?php endif; // check if album has post thumbnail. ?>
		</div><!-- .other-songs-from-the-album-header -->

		<?php if ( $query->have_posts() ) : ?>
		<ol class="other-songs-from-the-album-list pt-3 m-0">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				?>

				<?php if ( get_the_ID() === $this_lyrics_id ) : ?>
				<li class="py-2 current-song-in-the-album">
					<span><?php echo esc_html( get_the_title() ); ?></span>
				</li>
				<?php else : ?>
				<li class="py-2">
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
				</li>
				<?php endif; ?>

				<?php
			endwhile;

			wp_reset_postdata();
			?>
		</ol><!-- .other-songs-from-the-album-list -->
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
