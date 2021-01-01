<?php
/**
 * Template Name: Sidebarless Default Page
 *
 * The template for custom page without a sidebar and header.
 * Customer can build a custom page via Gutenberg.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
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
				<div id="primary-div" class="col-12">
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
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

						endwhile;
						?>
						</div><!-- .lyrico-module -->
					</div><!-- .lyrico-module-wrapper -->
				</div><!-- #primary-div -->
			</div><!-- .row -->
		</div><!-- .main-container -->
	<article>

<?php
get_footer();
