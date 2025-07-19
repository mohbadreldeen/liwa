<?php
/**
 * liwa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package liwa
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

// define('LIWA_THEME_URL', plugin_dir_url(__FILE__));
// define('LIWA_THEME_PATH', plugin_dir_path(__FILE__));
// define('LIWA_VERSION', '1.0.0');


define('LIWA_THEME_URL', get_template_directory_uri());
define('LIWA_THEME_PATH', plugin_dir_path(__FILE__));
define('LIWA_VERSION', '1.0.0');

 
function wp_log($message) {
	if (defined('WP_DEBUG') && WP_DEBUG) {
		error_log(print_r($message, true));
	}
}

include_once LIWA_THEME_PATH . '/wpbackery-addons/wpbakery-addons.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function liwa_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on liwa, use a find and replace
		* to change 'liwadates' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'liwadates', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array('menu-primary' => esc_html__( 'Primary', 'liwadates' ))
	);
	register_nav_menus(
		array('menu-secondary' => esc_html__( 'Secondary', 'liwadates' ))
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'liwa_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'liwa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function liwa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'liwa_content_width', 640 );
}
add_action( 'after_setup_theme', 'liwa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function liwa_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'liwadates' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'liwadates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Bottom', 'liwadates' ),
			'id'            => 'footer-bottom',
			'description'   => esc_html__( 'Widgets in this area will be shown in the footer bottom.', 'liwadates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1', 'liwadates' ),
			'id'            => 'footer-column-1',
			'description'   => esc_html__( 'Widgets in this area will be shown in Footer Column 1.', 'liwadates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'liwadates' ),
			'id'            => 'footer-column-2',
			'description'   => esc_html__( 'Widgets in this area will be shown in Footer Column 2.', 'liwadates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3', 'liwadates' ),
			'id'            => 'footer-column-3',
			'description'   => esc_html__( 'Widgets in this area will be shown in Footer Column 3.', 'liwadates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 4', 'liwadates' ),
			'id'            => 'footer-column-4',
			'description'   => esc_html__( 'Widgets in this area will be shown in Footer Column 4.', 'liwadates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 5', 'liwadates' ),
			'id'            => 'footer-column-5',
			'description'   => esc_html__( 'Widgets in this area will be shown in Footer Column 5.', 'liwadates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'liwa_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function liwa_scripts() {
	wp_enqueue_style( 'liwa-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'liwa-style', 'rtl', 'replace' );

	
	 wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap',
        array(),
        null
    );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	 // Enqueue frontend JavaScript
        wp_enqueue_script(
            'ld-frontend-js',
            LIWA_THEME_URL . '/dist/js/frontend.js',
            array('jquery'),
            LIWA_VERSION,
            true
        );
        
        // Enqueue frontend CSS (contains Swiper CSS)
        wp_enqueue_style(
            'ld-frontend-css',
            LIWA_THEME_URL . '/dist/css/frontend.css',
            array(),
            LIWA_VERSION
        );
        
        // Enqueue custom frontend styles

		if ( is_rtl() ) {
			wp_enqueue_style(
				'ld-frontend-styles-rtl-css',
				LIWA_THEME_URL . '/dist/css/frontend-styles-rtl.css',
				array('ld-frontend-css'),
				LIWA_VERSION
			);
		}else {
			wp_enqueue_style(
				'ld-frontend-styles-css',
				LIWA_THEME_URL . '/dist/css/frontend-styles.css',
				array('ld-frontend-css'), // Make it depend on the main frontend CSS
				LIWA_VERSION
			);
		}
        


        
        // Localize script for AJAX
        wp_localize_script('ld-frontend-js', 'ld_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ld_nonce')
        ));

}
add_action( 'wp_enqueue_scripts', 'liwa_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function liwa_admin_scripts() {
    // Enqueue admin CSS for WPBakery backend
    wp_enqueue_style(
        'liwa-admin-css',
        LIWA_THEME_URL . '/dist/css/admin.css',
        array(),
        LIWA_VERSION
    );
}
add_action( 'admin_enqueue_scripts', 'liwa_admin_scripts' );

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

