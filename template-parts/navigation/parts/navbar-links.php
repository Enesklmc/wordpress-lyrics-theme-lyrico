<?php
/**
 * Navbar links for navbar-1, navbar-2, navbar-3
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lyrico
 * @since 1.0.0
 */

wp_nav_menu(
	array(
		'theme_location' => 'top',
		'depth'          => 2,
		'container'      => false,
		'menu_class'     => 'navbar-nav navbar-links',
		'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
		'walker'         => new WP_Bootstrap_Navwalker(),
	)
);

