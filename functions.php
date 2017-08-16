<?php
/**
 * speziale_coming functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package speziale_coming
 */

if (! function_exists('speziale_coming_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function speziale_coming_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on speziale_coming, use a find and replace
     * to change 'speziale_coming' to the name of your theme in all the template files.
     */
    load_theme_textdomain('speziale_coming', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'primary' => esc_html__('Primary', 'speziale_coming'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('speziale_coming_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));
}
endif;
add_action('after_setup_theme', 'speziale_coming_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function speziale_coming_content_width()
{
    $GLOBALS['content_width'] = apply_filters('speziale_coming_content_width', 640);
}
add_action('after_setup_theme', 'speziale_coming_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function speziale_coming_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'speziale_coming'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'speziale_coming'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'speziale_coming_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function speziale_coming_scripts()
{
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/layouts/slick.css', array(), '', true);
    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/layouts/slick-theme.css', array(), '', true);
    wp_enqueue_style('speziale_coming-style', get_stylesheet_uri());

    wp_enqueue_script('slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), '', true);

    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);

    wp_enqueue_script('speziale_coming-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('speziale_coming-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    //Font Awesome
    wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/0856105e01.js');


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'speziale_coming_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

// Images Custom Post Type
function register_banner_images()
{

// Set UI labels for Custom Post Type
    $labels = array(
        'name' => __('Images'),
        'singular_name' => __('Images'),
        'all_items' => __('All Images'),
        'add_new' => __('Add New Images'),
        'add_new_item' => __('Add New Images'),
        'edit_item' => __('Edit Images'),
        'new_item' => __('New Images'),
        'view_item' => __('View Images'),
        'not_found' => __('No Images found'),
        'not_found_in_trash' => __('No Images found in Trash'),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __('Images'),
        'description'         => __(''),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'menu_icon'                  => 'dashicons-format-image',
    );

    // Registering your Custom Post Type
    register_post_type('images', $args);
}

add_action('init', 'register_banner_images', 0);