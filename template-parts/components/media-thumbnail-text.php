<?php
/**
 * Media with Album Thumbnail
 *
 * @package Lyrico
 * @since 1.0.0
 */

$album_id = get_post_meta( get_the_ID(), 'lyrico_album', true );

$media_class = '';
if ( has_post_thumbnail( $album_id ) ) {
	$media_class = ' has-thumbnail';
}

$title_attr = the_title_attribute( 'echo=0' ) . lyrico_get_artists( array( 'echo' => false, 'wrap_before' => ' - ' ) );
?>

<div class="media thumbnail-lyrics-media lyrics-media p-0<?php echo esc_attr( $media_class ); ?>">
	<div class="media-body d-flex align-items-center">
		<div class="media-border"></div>
		<div class="media-content">
			<a title="<?php echo esc_attr( $title_attr ); ?>" href="<?php echo esc_url( get_permalink() ); ?>" class="primary-media-title d-block stretched-link"><?php the_title(); ?></a>
			<?php
			lyrico_get_artists(
				array(
					'wrap_before' => '<span class="secondary-media-title">',
					'wrap_after'  => '</span>',
				)
			);
			?>
		</div>
	</div>

	<?php
	if ( has_post_thumbnail() ) :
		the_post_thumbnail( 'smaller-thumbnail' );
	elseif ( has_post_thumbnail( $album_id ) ) :
		echo get_the_post_thumbnail( $album_id, 'smaller-thumbnail' );
	endif;
	?>
</div><!-- .lyrics-media -->
