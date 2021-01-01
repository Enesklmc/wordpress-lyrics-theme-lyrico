<?php
/**
 * Media with ordering
 *
 * @package Lyrico
 * @since 1.0.0
 */

$position = get_query_var( 'media_order' );

$title_attr = the_title_attribute( 'echo=0' ) . lyrico_get_artists( array( 'echo' => false, 'wrap_before' => ' - ' ) );
?>

<div class="media ordered-lyrics-media lyrics-media p-0">
	<div class="mr-2 order-box">
		<span class="order-box-number m-auto"><?php echo intval( $position ); ?></span>
	</div>
	<div class="media-body">
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
