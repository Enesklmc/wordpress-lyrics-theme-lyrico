<?php
/**
 * Card with overlay image.
 *
 * @package Lyrico
 * @since 1.0.0
 */

$album_id = get_post_meta( get_the_ID(), 'lyrico_album', true );

?>
<div class="card-wrapper">
	<div class="card bg-dark text-white text-on-image-card rounded-0">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'card-thumbnail', array( 'class' => 'card-img w-100 h-100 rounded-0' ) ); ?>
		<?php elseif ( has_post_thumbnail( $album_id ) ) : ?>
			<?php echo get_the_post_thumbnail( $album_id, 'card-thumbnail', array( 'class' => 'card-img w-100 h-100 rounded-0' ) ); ?>
		<?php else : ?>
			<img class="card-img rounded-0 h-100" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/default/playlist.png' ) ); ?>" alt="Card image">
		<?php endif; ?>

		<div class="card-img-overlay d-flex px-3 py-2">
			<div class="card-content-wrapper">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="stretched-link card-image-overlay-primary-title"> <?php the_title(); ?></a>

			<?php
			lyrico_get_artists(
				array(
					'wrap_before' => '<span class="d-block card-image-overlay-secondary-title">',
					'wrap_after'  => '</span>',
				)
			);
			?>

			<?php if ( get_post_type() === 'lyrico_album' ) : ?>
				<?php if ( get_post_meta( get_the_ID(), 'lyrico_released_year', true ) ) : ?>
					<small class="album-year text-gray"><?php echo intval( get_post_meta( get_the_ID(), 'lyrico_released_year', true ) ); ?></small>
				<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div><!-- .card-wrapper -->
