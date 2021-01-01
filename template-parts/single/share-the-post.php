<?php
/**
 * The template for display share the post section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

$the_post_type = get_post_type();
if ( $the_post_type ) {
	$the_post_type_object = get_post_type_object( $the_post_type );
	$the_post_type_name   = $the_post_type_object->labels->singular_name;
}
?>
<div class="d-flex lyrico-share-post lyrico-brand-icons with-brand-colors mt-3 mt-md-0 align-items-center">
	<h4 class="mr-2 mb-0">
		<?php esc_html_e( 'Share', 'lyrico' ); ?>
	</h4>

	<?php
	$the_title = get_the_title();
	$permalink = get_permalink();

	$twitter_handler = ( get_option( 'twitter_handler' ) ? '&amp;via=' . esc_attr( get_option( 'twitter_handler' ) ) : '' );

	$twitter  = 'https://twitter.com/intent/tweet?text=' . $the_title . ' - ' . $the_post_type_name . '&amp;url=' . $permalink . $twitter_handler . '';
	$facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
	$whatsapp = 'https://api.whatsapp.com/send?text=' . $permalink;
	$email    = 'mailto:%20?subject=' . $the_title . '%20-%20' . $the_post_type_name . '&body=' . $permalink;
	?>

	<ul class="nav justify-content-center">
		<li><a href="<?php echo esc_url( $twitter ); ?>" rel="nofollow"><i class="brand-icon fab fa-twitter"></i></a></li>
		<li><a href="<?php echo esc_url( $facebook ); ?>" rel="nofollow"><i class="brand-icon fab fa-facebook-f"></i></a></li>
		<li><a href="<?php echo esc_url( $whatsapp ); ?>" rel="nofollow"><i class="brand-icon fab fa-whatsapp"></i></a></li>
		<li><a href="<?php echo esc_url( $email ); ?>" rel="nofollow"><i class="brand-icon fas fa-envelope"></i></a></li>
	</ul>
</div>
