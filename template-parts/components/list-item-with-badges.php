<?php
/**
 * Template part for displaying post title with Post type badge.
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>
<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
	<a class="stretched-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?><?php lyrico_get_artists( array( 'wrap_before' => ' - ' ) ); ?></a>
	<?php
	$the_post_type = get_post_type();
	if ( $the_post_type ) {
		$the_post_type_object = get_post_type_object( $the_post_type );
		$the_post_type_name   = $the_post_type_object->labels->singular_name;
		echo '<span class="badge badge-secondary">' . esc_html( $the_post_type_name ) . '</span>';
	}
	?>
</li>
