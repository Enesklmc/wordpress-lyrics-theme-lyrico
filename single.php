<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php get_template_part( 'template-parts/header/single-post', 'header' ); ?>

		<div class="container main-container">
			<div class="row">
				<div id="primary-div" class="col-md-8">
					<?php
					while ( have_posts() ) :
						the_post();

						// Add +1 page view each time the page is visited.
						lyrico_save_post_views( get_the_ID() );
						?>
						<div class="lyrico-module-wrapper">
							<div class="lyrico-module">
								<div class="entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->

								<?php
								wp_link_pages(
									array(
										'before'      => '<hr class="my-4"><div class="page-links my-4 text-center"><span class="page-links-title">' . esc_html__( 'Pages:', 'lyrico' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span class="page-link-number">',
										'link_after'  => '</span>',
									)
								);
								?>

								<hr class="my-4">

								<div class="lyrico-post-meta d-md-flex flex-wrap align-items-center px-3">
									<?php lyrico_posted_by(); ?>
									<?php get_template_part( 'template-parts/single/share-the-post' ); ?>
									<div class="col-12 p-0 mt-3">
										<?php echo lyrico_posted_tags(); ?>
									</div>
								</div>

								<?php
								if ( is_singular( 'attachment' ) ) {
									// Parent post navigation.
									the_post_navigation(
										array(
											/* translators: %s: parent post link */
											'prev_text' => sprintf( esc_html__( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'lyrico' ), '%title' ),
										)
									);
								} elseif ( is_singular( 'post' ) ) {
									echo '<hr class="my-4">';

									// Previous/next post navigation.
									the_post_navigation(
										array(
											'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'lyrico' ) . '</span> ' .
												'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'lyrico' ) . '</span>' .
												'<span class="post-title">%title</span>',
											'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Post', 'lyrico' ) . '</span> ' .
												'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'lyrico' ) . '</span>' .
												'<span class="post-title">%title</span>',
										)
									);
								} elseif ( is_singular( 'lyrico_playlist' ) ) {
									echo '<hr class="my-4">';

									// Previous/next playlist navigation.
									the_post_navigation(
										array(
											'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Playlist', 'lyrico' ) . '</span> ' .
												'<span class="screen-reader-text">' . esc_html__( 'Next playlist:', 'lyrico' ) . '</span>' .
												'<span class="post-title">%title</span>',
											'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Playlist', 'lyrico' ) . '</span> ' .
												'<span class="screen-reader-text">' . esc_html__( 'Previous playlist:', 'lyrico' ) . '</span>' .
												'<span class="post-title">%title</span>',
										)
									);
								}
								?>
							</div><!-- .lyrico-module -->
						</div><!-- .lyrico-module-wrapper -->
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					endwhile;
					?>
				</div><!-- #primary-div -->

				<?php if ( get_theme_mod( 'blog_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
				<div id="secondary-div" class="col-md-4">
					<?php get_sidebar(); ?>
				</div><!-- #secondary-div -->
				<?php endif; ?>
			</div><!-- .row -->
		</div><!-- .main-container -->
	</article>

<?php
get_footer();
