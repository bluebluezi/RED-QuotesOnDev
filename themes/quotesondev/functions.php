<?php
/**
 * Quotes on Dev Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package QOD_Starter_Theme
 */

if ( ! function_exists( 'qod_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function qod_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html( 'Primary Menu' ),
	) );

	// Switch search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form' ) );

}
endif; // qod_setup
add_action( 'after_setup_theme', 'qod_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function qod_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'qod_content_width', 640 );
}
add_action( 'after_setup_theme', 'qod_content_width', 0 );

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function qod_minified_css( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( file_exists( get_template_directory() . '/build/css/style.min.css' ) ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'qod_minified_css', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function qod_scripts() {
	wp_enqueue_style( 'qod-style', get_stylesheet_uri() );

	wp_enqueue_script( 'qod-starter-navigation', get_template_directory_uri() . '/build/js/navigation.min.js', array(), '20151215', true );
	wp_enqueue_script( 'qod-starter-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20151215', true );
}
add_action( 'wp_enqueue_scripts', 'qod_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
 require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom metaboxes generated using the CMB2 library.
 */
require get_template_directory() . '/inc/metaboxes.php';

 /**
 * Custom WP API modifications.
 */
require get_template_directory() . '/inc/api.php';

function red_scripts(){
	$script_url = get_template_directory_uri() . '/js/api.js';
	wp_enqueue_script('jquery');
	wp_enqueue_script('red_comments', $script_url, array ('jquery'), false, true);
	wp_localize_script('red_comments','red_vars',array(
		'rest_url' => esc_url_raw(rest_url()),
		'wpapi_nonce' => wp_create_nonce('wp_rest') //create nonce through REST_API
	));
}

add_action('wp_enqueue_scripts', 'red_scripts');


function qod_widgets(){
    register_sidebar(array(   //this is an associative array
        'name' => 'Archive',
        'id' => 'archive-sidebar-area',
        'description' => 'Add a text block with your business hours',
        'before_widget' => '<aside class="%1$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class = "archive-headings">',
        'after_title' => '</h3>'
    ));

    // register_sidebar(array(
    //     'name' => 'Footer',
    //     'id' => 'footer-area',
    //     'description' => 'Drag and drop appropriate widgets for the footer',
    //     'before_widget' => '<div class="%1$s">',
    //     'after_widget' => '</div>',
    //     'before_title' => '<h2 class = "footer-headings">',
    //     'after_title' => '</h2>'
    // ));

}

add_action('widgets_init', 'qod_widgets');



//favicon functionality
function tthq_add_custom_fa_css() {
wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css' );
}

add_action( 'wp_enqueue_scripts', 'tthq_add_custom_fa_css' );

//limit posts_per_page for different queries
function qod_search_posts_per_page($query) {
	//condition for frontpage/ blogindex page is handled
	// in home.php in the actual $arg for new WP_Query object
	
	if ( $query->is_search() ) {
        $query->set( 'posts_per_page', '10' );
	}
	else if ($query -> is_category() ||
		     $query -> is_tag()){
		$query -> set('posts_per_page','5');
	}
	else if ($query -> is_author()){
		$query -> set('posts_per_page','1');
		$query -> set('orderby','rand');
	}
	
    return $query;
}
add_filter( 'pre_get_posts','qod_search_posts_per_page' );



?>

