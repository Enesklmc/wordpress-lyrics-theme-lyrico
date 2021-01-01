<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>
<div class="lyrico-module-wrapper">
	<div class="lyrico-module">
		<section class="no-results not-found">
			<header class="module-header">
				<h1 class="h4"><?php esc_html_e( 'Nothing Found', 'lyrico' ); ?></h1>
			</header><!-- .page-header -->

			<div class="module-content">
				<?php
				if ( is_home() && current_user_can( 'publish_posts' ) ) :

					printf(
						'<p>' . wp_kses(
							/* translators: 1: link to WP admin new post page. */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lyrico' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						) . '</p>',
						esc_url( admin_url( 'post-new.php' ) )
					);

				elseif ( is_search() ) :
					?>
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lyrico' ); ?></p>
					<?php
				else :
					?>
					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lyrico' ); ?></p>
					<?php
					get_search_form();

				endif;
				?>
			</div><!-- .page-content -->
		</section><!-- .no-results -->
	</div>
</div>

