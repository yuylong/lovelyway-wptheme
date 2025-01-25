<?php
/**
 * fashion functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fashion Blogging
 */
if ( ! function_exists( 'fashion_blogging_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fashion_blogging_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'fashion-blogging-thumbnail-mobile', 350, 350, true );
		add_image_size( 'fashion-blogging-list-thumbnail', 380, 360, true );
		add_image_size( 'fashion-blogging-grid-thumbnail', 380, 320, true );
		add_image_size( 'fashion-blogging-thumbnail-medium', 770, 433.13, true );
		add_image_size( 'fashion-blogging-thumbnail-large', 1200, 675, true );
		add_image_size( 'fashion-blogging-thumbnail-featured', 930, 650, true );
		add_image_size( 'fashion-blogging-header-full', 1920, 1080, true );
		add_image_size( 'fashion-blogging-latest-post-widget-thumb', 120, 120, true );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'main-menu' => esc_html__( 'Primary', 'fashion-blogging' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'fashion-blogging' ),
			)
		);
		add_theme_support( 'woocommerce' );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		$html5_support_args = array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			);
		add_theme_support( 'html5', $html5_support_args );
		// Set up the WordPress core custom background feature.
		$custom_bg_args = apply_filters( 'fashion_blogging_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			);
		add_theme_support( 'custom-background', $custom_bg_args);
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		/**
		 * Remove Theme Support
		 */
        remove_theme_support( 'widgets-block-editor' );
		remove_theme_support( 'block-templates' );
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$custom_logo_args = array(
				'height'      => 100,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			);
		add_theme_support( 'custom-logo', $custom_logo_args );
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'fashion_blogging_content_width', 640 );
	}
endif;
add_action( 'after_setup_theme', 'fashion_blogging_setup' );

/**
 * Register widgets
 */
require get_template_directory() . '/inc/register-widgets.php';
/**
 * Register Block Style
 */
require get_template_directory() . '/inc/reg-block-style.php';
/**
 * Enqueue scripts
 */
require get_template_directory() . '/inc/enqueue-scripts.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * RS Personal Blog Comment Template.
 */
require get_template_directory() . '/inc/comment-template.php';
/**
 * RS Personal Blog sanitize functions.
 */
require get_template_directory() . '/inc/sanitize-functions.php';
/**
 * Checkout Fields
 */
require get_template_directory() . '/inc/checkout-fields.php';

/**
 * Kirki Plugin Activation
 */
require get_template_directory() . '/inc/plugins/kirki/kirki.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Related Posts.
 */
require get_template_directory() . '/inc/recomended-posts.php';

/**
 * Getting Started
 */
require get_template_directory() . '/inc/getting-started.php';

/**
 * Plugin Installer
 */
require get_template_directory() . '/inc/plugins-installer.php';

/**
 * WooCommerce Medifications
 */
if ( class_exists( 'woocommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce-modification.php';
}

add_filter( 'wp_lazy_loading_enabled', '__return_false' );