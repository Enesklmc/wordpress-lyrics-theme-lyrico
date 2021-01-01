<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Lyrico
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="lyrico-module-wrapper">
	<div class="lyrico-module">
		<div class="comments-area">
			<?php if ( have_comments() ) : ?>
				<hr class="my-4 d-modular-design-none">

				<button type="button" name="button" class="btn btn-<?php echo esc_attr( get_theme_mod( 'button_color_template', 'outline-dark' ) ); ?> btn-lg w-100 show-comments-button">
					<?php
					printf(
						esc_html(
							/* translators: %1$s: Comment number, %2$s: Comment Title */
							_nx(
								'%1$s thought on &ldquo;%2$s&rdquo;',
								'%1$s thoughts on &ldquo;%2$s&rdquo;',
								get_comments_number(),
								'comments title',
								'lyrico'
							)
						),
						intval( number_format_i18n( get_comments_number() ) ),
						'<span>' . esc_html( get_the_title() ) . '</span>'
					);
					?>
				</button>
				<div class="comment-list" style="display:none;">
					<ol class="list-unstyled">
						<?php
						wp_list_comments(
							array(
								'walker'      => new TwentyNineteen_Walker_Comment(),
								'avatar_size' => 40,
								'short_ping'  => true,
								'style'       => 'ol',
							)
						);
						?>
					</ol>

					<?php
					// Show comment navigation.
					if ( have_comments() ) :
						$prev_icon = '<i class="comment-nav-icon fas fa-angle-left"></i>';
						$next_icon = '<i class="comment-nav-icon fas fa-angle-right"></i>';
						the_comments_navigation(
							array(
								'prev_text' => sprintf( '%s <span class="comment-prev-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span>', $prev_icon, __( 'Previous', 'lyrico' ), __( 'Comments', 'lyrico' ) ),
								'next_text' => sprintf( '<span class="comment-next-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span> %s', __( 'Next', 'lyrico' ), __( 'Comments', 'lyrico' ), $next_icon ),
							)
						);
					endif;
					?>
				</div><!-- .comment-list -->

			<?php else : ?>

				<hr class="my-4 d-modular-design-none">

				<h3 class="comments-title my-3"><?php echo esc_html__( 'No Comments.', 'lyrico' ); ?></h3>

			<?php endif; // Check for have_comments(). ?>

			<?php
			$commenter = wp_get_current_commenter();
			$req       = get_option( 'require_name_email' );
			$aria_req  = ( $req ? " aria-required='true'" : '' );

			$fields = array(
				'author' =>
				'<div class="row my-4"><div class="comment-form-author comment-form-input col-12 col-sm-6 my-4 my-sm-4"><input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' required/><label>' . esc_html__( 'Name', 'lyrico' ) . ( $req ? '*' : '' ) . '</label></div>',

				'email'  =>
				'<div class="comment-form-email comment-form-input col-12 col-sm-6 my-4 my-sm-4"><input class="form-control" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' required/><label>' . esc_html__( 'Email', 'lyrico' ) . ( $req ? '*' : '' ) . '</label></div></div>',

				'url'    =>
				'<div class="comment-form-url comment-form-input position-relative my-5"><input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" required/><label>' . esc_html__( 'Website', 'lyrico' ) . '</label></div>',
			);

			$comment_submit_classes = 'btn btn-' . esc_attr( get_theme_mod( 'button_color_template', 'outline-dark' ) );

			$comments_args = array(
				'fields'        => apply_filters( 'comment_form_default_fields', $fields ),
				'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s d-block w-100 rounded-0 mx-auto ' . esc_attr( $comment_submit_classes ) . '" value="%4$s" />',
				'comment_field' => '<div class="comment-form-comment comment-form-input position-relative my-5"><textarea class="form-control" id="comment" name="comment" cols="45" rows="4" aria-required="true" required></textarea><label>' . esc_html_x( 'Comment', 'noun', 'lyrico' ) . '</label></div>',
			);

			comment_form( $comments_args );
			?>
		</div><!-- .comments-area -->
	</div><!-- .lyrico-module -->
</div><!-- .lyrico-module-wrapper -->
