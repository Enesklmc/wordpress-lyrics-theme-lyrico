<?php
/**
 * Lyrico functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lyrico
 * @since 1.0.0
 */

/*
* Theme Setup
*/
if ( ! function_exists( 'lyrico_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lyrico_setup() {
		load_theme_textdomain( 'lyrico', get_theme_file_path( '/languages' ) );

		// Add Custom Background.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => '#dcdcdc',
				'default-image' => '',
			)
		);

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'smaller-thumbnail', 120, 120, true );
		add_image_size( 'card-thumbnail', 200, 200, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 720;

		// This theme uses wp_nav_menu() in only one locations.
		register_nav_menus(
			array(
				'top'    => esc_html__( 'Top Menu', 'lyrico' ),
				'footer' => esc_html__( 'Footer Menu', 'lyrico' ),
			)
		);

		// Add support for Custom logo.
		$defaults = array(
			'height'      => 30,
			'width'       => 30,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $defaults );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'search-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Teal', 'lyrico' ),
					'slug'  => 'teal',
					'color' => '#1abc9c',
				),
				array(
					'name'  => __( 'Dark Teal', 'lyrico' ),
					'slug'  => 'dark-teal',
					'color' => '#16a085',
				),
				array(
					'name'  => __( 'Green', 'lyrico' ),
					'slug'  => 'green',
					'color' => '#2ecc71',
				),
				array(
					'name'  => __( 'Dark Green', 'lyrico' ),
					'slug'  => 'dark-green',
					'color' => '#27ae60',
				),
				array(
					'name'  => __( 'Blue', 'lyrico' ),
					'slug'  => 'blue',
					'color' => '#3498db',
				),
				array(
					'name'  => __( 'Dark Blue', 'lyrico' ),
					'slug'  => 'dark-blue',
					'color' => '#2980b9',
				),
				array(
					'name'  => __( 'Purple', 'lyrico' ),
					'slug'  => 'purple',
					'color' => '#9b59b6',
				),
				array(
					'name'  => __( 'Dark Purple', 'lyrico' ),
					'slug'  => 'dark-purple',
					'color' => '#8e44ad',
				),
				array(
					'name'  => __( 'Yellow', 'lyrico' ),
					'slug'  => 'yellow',
					'color' => '#f1c40f',
				),
				array(
					'name'  => __( 'Dark Yellow', 'lyrico' ),
					'slug'  => 'dark-yellow',
					'color' => '#f39c12',
				),
				array(
					'name'  => __( 'Orange', 'lyrico' ),
					'slug'  => 'orange',
					'color' => '#e67e22',
				),
				array(
					'name'  => __( 'Dark Orange', 'lyrico' ),
					'slug'  => 'dark-orange',
					'color' => '#d35400',
				),
				array(
					'name'  => __( 'Red', 'lyrico' ),
					'slug'  => 'red',
					'color' => '#e74c3c',
				),
				array(
					'name'  => __( 'Dark Red', 'lyrico' ),
					'slug'  => 'dark-red',
					'color' => '#c0392b',
				),
				array(
					'name'  => __( 'Clouds', 'lyrico' ),
					'slug'  => 'clouds',
					'color' => '#ecf0f1',
				),
				array(
					'name'  => __( 'Silver', 'lyrico' ),
					'slug'  => 'silver',
					'color' => '#bdc3c7',
				),
				array(
					'name'  => __( 'Gray', 'lyrico' ),
					'slug'  => 'gray',
					'color' => '#95a5a6',
				),
				array(
					'name'  => __( 'Dark Gray', 'lyrico' ),
					'slug'  => 'dark-gray',
					'color' => '#7f8c8d',
				),
				array(
					'name'  => __( 'Midnight', 'lyrico' ),
					'slug'  => 'midnight',
					'color' => '#34495e',
				),
				array(
					'name'  => __( 'Dark', 'lyrico' ),
					'slug'  => 'dark',
					'color' => '#343a40',
				),
				array(
					'name'  => __( 'Midnight Gradient', 'lyrico' ),
					'slug'  => 'gradient-midnight',
					'color' => '#000',
				),
			)
		);

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

	}
	add_action( 'after_setup_theme', 'lyrico_setup' );
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lyrico_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'lyrico' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'lyrico' ),
			'before_widget' => '<div class="widget-wrapper"><section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section></div>',
			'before_title'  => '<div class="widget-title"><h5 class="m-0">',
			'after_title'   => '</h5></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Home Page Sidebar', 'lyrico' ),
			'id'            => 'sidebar-home',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on Lyrico home page template.', 'lyrico' ),
			'before_widget' => '<div class="widget-wrapper"><section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section></div>',
			'before_title'  => '<div class="widget-title"><h5 class="m-0">',
			'after_title'   => '</h5></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'lyrico' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'lyrico' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h5>',
			'after_title'   => '</h5><hr /></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'lyrico' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'lyrico' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h5>',
			'after_title'   => '</h5><hr /></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'lyrico' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'lyrico' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h5>',
			'after_title'   => '</h5><hr /></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 4', 'lyrico' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'lyrico' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h5>',
			'after_title'   => '</h5><hr /></div>',
		)
	);
}
add_action( 'widgets_init', 'lyrico_widgets_init' );

/**
 * Enqueue scripts & styles.
 */
require get_theme_file_path( 'inc/enqueue.php' );

/**
 * Ajax functions.
 */
require get_theme_file_path( 'inc/ajax-functions.php' );

/**
 * Bootstrap 4 Navwalker.
 */
require get_theme_file_path( 'inc/class-wp-bootstrap-navwalker.php' );

/**
 * Custom Customizer Controls.
 */
require get_theme_file_path( 'inc/customizer-custom-controls.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( 'inc/customizer.php' );

/**
 * Custom template tags for the theme.
 */
require get_theme_file_path( 'inc/template-tags.php' );

/**
 * Custom template functions for the theme.
 */
require get_theme_file_path( 'inc/template-functions.php' );

/**
 * Custom Comment Walker template.
 */
require get_theme_file_path( 'inc/class-twentynineteen-walker-comment.php' );

/*
* TGM plug-in
*/
require get_theme_file_path( 'inc/tgm/example.php' );
