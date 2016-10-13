<?php
/**
 * ParaBlogger functions and definitions
 *
 * @package ParaBlogger
 */
 
define('parablogger_name', 'ParaBlogger' );
define('parablogger_url', get_template_directory_uri() );
define('parablogger_dir', get_template_directory() );




if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}
if ( ! function_exists( 'parablogger_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function parablogger_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ParaBlogger, use a find and replace
	 * to change 'parablogger' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'parablogger', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


	add_theme_support( 'custom-header' );




	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'parablogger' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'parablogger_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // parablogger_setup
add_action( 'after_setup_theme', 'parablogger_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function parablogger_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'parablogger_content_width', 640 );
}
add_action( 'after_setup_theme', 'parablogger_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function parablogger_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'parablogger' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'parablogger_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function parablogger_scripts() {
	wp_enqueue_style( 'parablogger-style', get_stylesheet_uri() );

	wp_enqueue_script( 'parablogger-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'parablogger-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'parablogger_scripts' );



/**
 * Custom template tags for this theme.
 */
require parablogger_dir . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require parablogger_dir . '/inc/extras.php';

/**
 * Customizer additions.
 */
require parablogger_dir . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require parablogger_dir . '/inc/jetpack.php';


/**
 * Load ParaAdmin file.
 */
require parablogger_dir . '/ParaAdmin/ParaAdminClass.php';

function parablogger_admin_scripts()
	{
		wp_enqueue_script('ParaAdmin', parablogger_url.'/ParaAdmin/js/ParaAdmin.js' , array( 'jquery' ));
		wp_enqueue_style('ParaAdmin', parablogger_url.'/ParaAdmin/css/ParaAdmin.css');
	}
add_action( 'admin_enqueue_scripts', 'parablogger_admin_scripts' );




add_action('admin_menu', 'parablogger_menu_init');
function parablogger_menu_settings(){
	include('admin/admin-settings.php');	
}



function parablogger_menu_init() {


	add_theme_page( __('ParaBlogger Admin','parablogger'), __('ParaBlogger Admin','parablogger'), 'manage_options', 'parablogger_menu_settings', 'parablogger_menu_settings');	
		

	
}


