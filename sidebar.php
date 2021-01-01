<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

dynamic_sidebar( 'sidebar-1' );
