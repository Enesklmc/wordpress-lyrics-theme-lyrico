<?php
/**
 * Displays the single post and custom post types header
 *
 * @package lyrico
 * @since 1.0.0
 */

$album_id = get_post_meta( get_the_ID(), 'lyrico_album', true );

$post_type_class = 'lyrico-post-type-' . str_replace( '_', '-', get_post_type() );
?>

<div data-template="<?php echo 'lyrico-gradient-' . esc_attr( get_theme_mod( 'header_background_template', 'midnight-city' ) ); ?>" class="lyrico-site-header single-header-container <?php echo esc_attr( $post_type_class ); ?> container-fluid <?php echo 'lyrico-gradient-' . esc_attr( get_theme_mod( 'header_background_template', 'midnight-city' ) ); ?>">
	<div class="position-relative">
		<header class="media">
			<div class="image-wrapper">
				<?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail(
						'thumbnail',
						array(
							'class'    => 'mx-auto mb-3 mb-md-0 mr-md-3 thumbnail-image',
							'itemprop' => 'image',
						)
					);
				elseif ( has_post_thumbnail( $album_id ) ) :
					echo get_the_post_thumbnail(
						$album_id,
						'thumbnail',
						array(
							'class'    => 'mx-auto mb-3 mb-md-0 mr-md-3 thumbnail-image',
							'itemprop' => 'image',
						)
					);
				endif;
				?>
			</div>

			<div class="media-body">
				<?php
				$the_post_type = get_post_type();

				if ( $the_post_type && 'post' !== $the_post_type ) {
					$the_post_type_object = get_post_type_object( $the_post_type );
					$the_post_type_name   = $the_post_type_object->labels->singular_name;

					printf(
						'<span class="badge lyrico-header-post-type mb-md-2">%s</span>',
						esc_html( $the_post_type_name )
					);
				}
				?>

				<?php if ( is_singular( 'lyrico_artist' ) ) : ?>
					<h1>
						<span itemprop="name"><?php echo esc_html( get_the_title() ); ?></span>
					</h1>
				<?php elseif ( is_singular( 'lyrico_lyrics' ) || is_singular( 'lyrico_album' ) ) : ?>
					<h1 itemprop="name">
						<?php echo esc_html( get_the_title() ); ?>
					</h1>
					<?php
					lyrico_get_artists(
						array(
							'wrap_before'   => '<h2 class="mt-1 h3">',
							'wrap_after'    => '</h2>',
							'before_artist' => '<span itemprop="byArtist" itemscope itemtype="http://schema.org/MusicGroup"><span itemprop="name">',
							'after_artist'  => '</span></span>',
							'link_for_each' => true,
						)
					);
					?>
					<?php if ( is_singular( 'lyrico_lyrics' ) && ! empty( $album_id ) ) { ?>
						<h3 class="h6 album-name mb-0" itemprop="inAlbum" itemscope itemtype="http://schema.org/MusicAlbum">
							<i class="fas fa-compact-disc mr-1"></i>

							<a itemprop="url" href="<?php echo esc_attr( get_the_permalink( $album_id ) ); ?>">
								<span itemprop="name"><?php echo esc_html( get_the_title( $album_id ) ); ?></span>
							</a>
						</h3>
					<?php } ?>
				<?php else : ?>
					<h1 class="h1 m-0" itemprop="name"><?php the_title(); ?></h1>

					<div class="single-post-header-meta">
						<?php lyrico_posted_on(); ?>
					</div>

					<?php
					$categories_list = get_the_category_list( ' ' );
					if ( $categories_list ) {
						printf(
							/* translators: 1: All categories. */
							'<div class="lyrico-header-post-categories mt-2 mt-md-3">%1$s</div>',
							$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						);
					}
					?>
				<?php endif; ?>
			</div> <!-- .media-body -->
		</header>
		<?php lyrico_edit_link(); ?>
	</div>
</div>
