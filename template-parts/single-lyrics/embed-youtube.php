<?php
/**
 * The Single lyrics template for displaying youtube video
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$spotify_url = get_post_meta( get_the_ID(), 'lyrico_spotify_link', true );
$youtube_url = get_post_meta( get_the_ID(), 'lyrico_youtube_link', true );
?>

<?php if ( ! empty( $youtube_url ) ) : ?>
<div id="lyrics-embed-youtube-video" class="lyrico-module-wrapper">
	<div class="lyrico-module p-0 overflow-hidden">
		<div id="lyrics-embed-video">
			<button id="close-embed-video" class="btn btn-dark btn-sm p-0 rounded-0 mb-1">
				<i class="fas fa-times"></i>
			</button>

			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="<?php echo esc_url( convert_youtube_embed( $youtube_url ) ); ?>"></iframe>
			</div>
		</div><!-- #lyrics-embed-video -->
	</div><!-- .lyrico-embed-youtube-video -->
</div>
<?php endif; ?>

<?php if ( ! empty( $spotify_url ) ) : ?>
<div id="lyrics-embed-spotify" class="lyrico-module-wrapper">
	<div class="lyrico-module p-0">
			<?php
			printf(
				'<iframe src="%s" width="300" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>',
				esc_url( create_spotify_embed( $spotify_url ) )
			);
			?>
	</div><!-- .lyrico-embed-youtube-video -->
</div><!-- #lyrics-embed-spotify -->
<?php endif; ?>
