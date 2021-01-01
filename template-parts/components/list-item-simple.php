<?php
/**
 * Simple list item.
 *
 * @package Lyrico
 * @since 1.0.0
 */

?>
<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?>
	<?php
	lyrico_get_artists(
		array(
			'wrap_before' => ' - ',
		)
	);
	?>
</a>

