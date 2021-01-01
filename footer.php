<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>

	</div><!-- #content -->

	<div class="site-footer-container container-fluid">
		<div class="row">
			<footer id="site-footer" class="container">

				<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

				<div class="site-info clearfix">

					<?php lyrico_show_footer_brand(); ?>

					<?php
					if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
					}
					?>

					<?php if ( has_nav_menu( 'footer' ) ) : ?>
						<nav class="footer-navigation my-4" aria-label="<?php esc_attr_e( 'Footer Menu', 'lyrico' ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'menu_class'     => 'footer-menu nav nav-pills nav-fill justify-content-center',
									'depth'          => 1,
								)
							);
							?>
						</nav><!-- .footer-navigation -->
					<?php endif; ?>
				</div><!-- .site-info -->

				<?php if ( ! empty( get_theme_mod( 'footer_copyright_text', 'Copyright. 2019 Lyrico.' ) ) ) : ?>
				<div class="my-4 footer-copyright-text w-100 text-center">
					<?php echo esc_html( get_theme_mod( 'footer_copyright_text', 'Copyright. 2019 Lyrico.' ) ); ?>
				</div>
				<?php endif; ?>
			</footer><!-- #site-footer -->
		</div><!-- .row -->
	</div><!-- .site-footer-container -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php if ( get_theme_mod( 'go_top_button', 0 ) === 1 ) : ?>
	<button type="button" id="go-top-button" class="btn border-0 btn-dark"><i class="fas fa-angle-up"></i></button>
<?php endif; ?>
</body>
</html>
