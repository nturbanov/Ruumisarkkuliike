<?php
/**
 * Honkasen Ruumisarkkuliike functions and definitions
 *
 * @package Honkasen Ruumisarkkuliike
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	// $content_width = 300; /* pixels */
}

if ( ! function_exists( 'ruumisarkkuliike_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ruumisarkkuliike_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Honkasen Ruumisarkkuliike, use a find and replace
	 * to change 'ruumisarkkuliike' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ruumisarkkuliike', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ruumisarkkuliike' ),
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
/*	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );*/

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ruumisarkkuliike_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // ruumisarkkuliike_setup
add_action( 'after_setup_theme', 'ruumisarkkuliike_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ruumisarkkuliike_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ruumisarkkuliike' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ruumisarkkuliike_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ruumisarkkuliike_scripts() {

    $GOOGLE_API_KEY = 'AIzaSyDnP5-UFawxjSCb5e4jlvjd4JO5FUrCQx4';

	wp_enqueue_style( 'ruumisarkkuliike-style', get_bloginfo('stylesheet_directory').'/style.css' );

	wp_enqueue_script( 'ruumisarkkuliike-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'ruumisarkkuliike-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_enqueue_script( 'ResponsiveSlides', get_template_directory_uri() . '/js/vendor/ResponsiveSlides/responsiveslides.min.js', array('jquery'), '1.54', true );

    wp_enqueue_style( 'ResponsiveSlides', get_template_directory_uri() . '/js/vendor/ResponsiveSlides/responsiveslides.css', array(), '1.54', 'all' );

    wp_enqueue_script( 'richmarker', get_template_directory_uri() . '/js/vendor/richmarker-compiled.js', array('google_maps'), '1.54', 'true' );



    // wp_enqueue_script( 'parallax', get_template_directory_uri() . '/js/vendor/parallax.js-1.3.1/parallax.min.js', array(), '1.3.1', true );

    // wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/js/vendor/skrollr.min.js', array(), '0.6.29', true );

    // wp_enqueue_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '3', true );
    wp_enqueue_script('google_jsapi', 'https://www.google.com/jsapi?key='.$GOOGLE_API_KEY, null, '', true);
    wp_enqueue_script('google_maps', 'https://maps.googleapis.com/maps/api/js?key='.$GOOGLE_API_KEY.'&sensor=true&libraries=geometry,drawing', null, '', true);

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', false, '1.11.2', true );
    // wp_register_script('jquery', get_template_directory_uri() . '/js/vendor/jquery.min.js', false, '1.11.2', true);
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('ResponsiveSlides', 'jquery'), filemtime(get_stylesheet_directory() . '/js/main.js'), true );


}
add_action( 'wp_enqueue_scripts', 'ruumisarkkuliike_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

/* CUSTOM KOODIA */


// EI TOIMI //

/*function show_only_products($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ( $query->is_tax() ) {
        // var_dump($query->get( 'tax_query' ));
        // var_dump( get_query_var( 'taxonomy' ) );
      // $query->set('post_type', array( 'verhoillut-arkut', 'puuarkut', 'uurnat' ) );
      $tax_query = array(
        'relation' => 'OR',
         array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => array( 366 )
         ),
         array(
            'taxonomy' => 'food',
            'field' => 'id',
            'terms' => array( 364 )
         )
      );

      // $query->set('tax_query', $tax_query);


    $tax_obj = $query->get_queried_object();

    var_dump($tax_obj);

    $tax_query = array(
                    'taxonomy' => $tax_obj->taxonomy,
                    'field' => 'slug',
                    'terms' => $tax_obj->slug
            );

   $query->tax_query->queries[] = $tax_query;
   $query->query_vars['tax_query'] = $query->tax_query->queries;
   $query->set('post_type', array( 'verhoillut-arkut', 'puuarkut', 'uurnat' ) );

    }
  }
  var_dump($query);
  return $query;
}*/

// add_action('pre_get_posts','show_only_products');


// add_action( 'pre_get_posts', 'exclude_cpt' );
/*function exclude_cpt( $query ) {
    if ( $query->is_tax('sarjat') ) {
        $query->set( 'post_type', array( 'verhoillut-arkut', 'puuarkut', 'uurnat' ) );

        // $query->set( 'posts_per_page', '1' );
    }
    return $query;
}*/


add_action( 'pre_get_posts', 'all_my_pregets' );
function all_my_pregets( $query ) {
    if ( !is_admin() && $query->is_main_query() ) {
        $query->set( 'posts_per_page', -1 );
        $query->set('order', 'ASC');
        $query->set('orderby', 'menu_order');

    }
    return $query;
}


if(false === get_option("medium_crop"))
    add_option("medium_crop", "1");
else
    update_option("medium_crop", "1");


if(false === get_option("large_crop"))
    add_option("large_crop", "1");
else
    update_option("large_crop", "1");


/** http://wordpress.stackexchange.com/a/33322
 * @param  $classes array
 * @param  $item object
 * @return array
 */
function normalize_wp_classes($classes, $item){

  // old class => new class
  if(get_post_type() == 'post'){
    $replacement = 'active-parent';
  }
  else{
    $replacement = '';
  }
  $replacements = array(
      'current-menu-item'     => 'active',
      'current-menu-parent'   => 'active-parent',
      'current-menu-ancestor' => 'active-parent',
      'current_page_item'     => 'active',
      'current_page_parent'   => $replacement,
      'current_page_ancestor' => 'active-parent',
      'current-page-ancestor' => 'active-parent',
      'current-page-parent'   => 'active-parent',
      'menu-item-has-children'=> 'has-children',
      'menu-item'             => 'menu-item',
      'fa'                    => 'fa'
  );

  // do the replacements above
  $classes = strtr(implode(',', $classes), $replacements);
  $classes = explode(',', $classes);

  // remove any classes that are not present in the replacements array,
  // and return the result

  return array_unique(array_intersect(array_values($replacements), $classes));
}

// for custom menus
add_filter('nav_menu_css_class', 'normalize_wp_classes', 10, 2);

// for the page menu fallback (wp_list_pages)
add_filter('page_css_class', 'normalize_wp_classes', 10, 2);


//Page Slug Body Class
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );