<?php
/**
 * Media with only text without thumbnail
 *
 * @package Lyrico
 * @since 1.0.0
 */

$title_attr = the_title_attribute( 'echo=0' ) . lyrico_get_artists( array( 'echo' => false, 'wrap_before' => ' - ' ) );
?>

<div class="media only-text-media lyrics-media p-0 border rounded">
	<div class="media-body mx-2 p-3">
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
</div><!-- .lyrics-media -->

