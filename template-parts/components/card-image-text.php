<?php
/**
 * Card with overlay image.
 *
 * @package Lyrico
 * @since 1.0.0
 */

$album_id = get_post_meta( get_the_ID(), 'lyrico_album', true );
?>
<div class="card-wrapper mr-2">
	<div class="card border-0 rounded-0">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'card-thumbnail', array( 'class' => 'card-img w-100 h-100 rounded-0' ) ); ?>
		<?php elseif ( has_post_thumbnail( $album_id ) ) : ?>
			<?php echo get_the_post_thumbnail( $album_id, 'card-thumbnail', array( 'class' => 'card-img w-100 h-100 rounded-0' ) ); ?>
		<?php else : ?>
			<img class="card-img rounded-0 h-100" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/default/playlist.png' ) ); ?>" alt="Card image">
		<?php endif; ?>

		<div class="card-content-wrapper px-2 py-1 text-center">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="stretched-link playlist-title"> <?php the_title(); ?></a>

			<?php
			lyrico_get_artists(
				array(
					'wrap_before' => '<span class="d-block image-card-secondary-title">',
					'wrap_after'  => '</span>',
				)
			);
			?>

			<?php if ( get_post_type() === 'lyrico_album' ) : ?>
				<?php if ( get_post_meta( get_the_ID(), 'lyrico_released_year', true ) ) : ?>
					<small class="text-gray"><?php echo intval( get_post_meta( get_the_ID(), 'lyrico_released_year', true ) ); ?></small>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->
