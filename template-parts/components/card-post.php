<?php
/**
 * Template part for displaying posts (Standart) with Cards.
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'lyrico-blog-post-wrapper' ); ?>>
	<div class="card lyrico-blog-post">
		<div class="card-body d-flex flex-column align-items-center">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="card-image flex-shrink-0">
					<?php the_post_thumbnail( 'card-thumbnail' ); ?>
				</div>
			<?php } ?>
			<div class="card-content">
				<?php the_title( '<h2 class="h5 card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

				<div class="card-text">
					<div class="entry-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div><!-- div.media-body -->

				<a class="btn btn-<?php echo esc_attr( get_theme_mod( 'button_color_template', 'outline-dark' ) ); ?>" href="<?php echo esc_url( get_permalink() ); ?>" role="button"><?php esc_html_e( 'Read More', 'lyrico' ); ?></a>
			</div>
		</div>

		<div class="card-footer">
			<div class="entry-meta">
				<?php lyrico_posted_meta(); ?>
			</div>

			<?php echo lyrico_posted_tags(); ?>
		</div>
	</div><!-- .lyrico-blog-post -->
</article><!-- #post-<?php the_ID(); ?> -->
