<?php
/**
 * The template for displaying all single pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package Lyrico
 * @since 1.0.0
 */

get_header();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php get_template_part( 'template-parts/header/page', 'header' ); ?>

		<div class="container main-container">
			<div class="row">
				<div id="primary-div" class="col-md-8">
					<div class="lyrico-module-wrapper">
						<div class="lyrico-module">
							<?php
							while ( have_posts() ) :
								the_post();
								?>
								<div class="entry-content">
									<?php
									the_content();

									wp_link_pages(
										array(
											'before'      => '<hr class="my-4"><div class="page-links my-4 text-center"><span class="page-links-title">' . esc_html__( 'Pages:', 'lyrico' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span class="page-link-number">',
											'link_after'  => '</span>',
										)
									);
									?>
								</div><!-- .entry-content -->
								<?php
							endwhile; // End of the loop.
							?>
						</div><!-- .lyrico-moduler -->
					</div><!-- .lyrico-module-wrapper -->

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div><!-- #primary-div -->

				<?php if ( get_theme_mod( 'page_content_layout', 'sidebar-right' ) !== 'no-sidebar' ) : ?>
				<div id="secondary-div" class="col-md-4">
					<?php get_sidebar(); ?>
				</div><!-- #secondary-div -->
				<?php endif; ?>
			</div><!-- .row -->
		</div><!-- .main-container -->
	</article>

<?php
get_footer();
