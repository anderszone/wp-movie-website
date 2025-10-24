<?php
/**
 * Underscores Starter Template functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Underscores_Starter_Template
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function underscores_starter_template_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Underscores Starter Template, use a find and replace
		* to change 'underscores-starter-template' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'underscores-starter-template', get_template_directory() . '/languages' );

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
		array(
			'menu-1' => esc_html__( 'Primary', 'underscores-starter-template' ),
		)
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
			'underscores_starter_template_custom_background_args',
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
add_action( 'after_setup_theme', 'underscores_starter_template_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function underscores_starter_template_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'underscores_starter_template_content_width', 640 );
}
add_action( 'after_setup_theme', 'underscores_starter_template_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function underscores_starter_template_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'underscores-starter-template' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'underscores-starter-template' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'underscores_starter_template_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function underscores_starter_template_scripts() {
	wp_enqueue_style( 'underscores-starter-template-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'underscores-starter-template-style', 'rtl', 'replace' );

	wp_enqueue_script( 'underscores-starter-template-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscores_starter_template_scripts' );

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

// Anders Create functions
function wp_movie_register_post_type() {
	register_post_type( 'movie', array(
		'labels' => array(
			'name' => __( 'Movies' ),
			'singular_name' => __( 'Movie' ),
			'add_new'               => __( 'Add New Movie', 'wp-movie-website' ),
			'add_new_item'          => __( 'Add New Movie', 'wp-movie-website' ),
			'edit_item'             => __( 'Edit Movie', 'wp-movie-website' ),
			'new_item'              => __( 'New Movie', 'wp-movie-website' ),
			'view_item'             => __( 'View Movie', 'wp-movie-website' ),
			'search_items'          => __( 'Search Movies', 'wp-movie-website' ),
			'not_found'             => __( 'No movies found', 'wp-movie-website' ),
			'not_found_in_trash'    => __( 'No movies found in Trash', 'wp-movie-website' ),
			'all_items'             => __( 'All Movies', 'wp-movie-website' ),
			'menu_name'             => __( 'Movies', 'wp-movie-website' ),
			'name_admin_bar'        => __( 'Movie', 'wp-movie-website' ),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'movies-archive' ), // 🔹 Added for clean URLs
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'menu_icon' => 'dashicons-format-video',
	) );
}

function wp_movie_register_taxonomies() {
	register_taxonomy( 'genre', 'movie', array(
		'label'             => __( 'Genres', 'wp-movie-website' ),
		'labels'            => array(
			'name'                  => _x( 'Genres', 'taxonomy general name', 'wp-movie-website' ),
			'singular_name'         => _x( 'Genre', 'taxonomy singular name', 'wp-movie-website' ),
			'search_items'          => __( 'Search Genres', 'wp-movie-website' ),
			'all_items'             => __( 'All Genres', 'wp-movie-website' ),
			'parent_item'           => __( 'Parent Genre', 'wp-movie-website' ),
			'parent_item_colon'     => __( 'Parent Genre:', 'wp-movie-website' ),
			'edit_item'             => __( 'Edit Genre', 'wp-movie-website' ),
			'update_item'           => __( 'Update Genre', 'wp-movie-website' ),
			'add_new_item'          => __( 'Add New Genre', 'wp-movie-website' ),
			'new_item_name'         => __( 'New Genre Name', 'wp-movie-website' ),
			'menu_name'             => __( 'Genres', 'wp-movie-website' ),
		),
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	) );
}

add_action( 'init', 'wp_movie_register_post_type' );
add_action( 'init', 'wp_movie_register_taxonomies' );

/**
 * Hämtar filmer och/eller tv-serier ur wp_movies beroende på genre och typ.
 * - Stöd för exakt genre (kolumn: 'genre')
 * - Stöd för kommaseparerade genres (kolumn: 'genres')
 *
 * @param string $genre_slug           Genre-slug.
 * @param string|array $type           'movie', 'tv' eller array ['movie', 'tv']. Lämna tom för båda.
 * @param int $limit                   Antal resultat att hämta.
 * @param string $orderby              Vilken kolumn ska sorteras? (release_date, title, random/RAND())
 * @param string $genres_column        Ange kolumnnamn: 'genre' eller 'genres' (standard för kommaseparerad).
 *
 * @return array                       Array av objekt från databasen.
 */

function wp_movies_get_by_genre_smart($genre_slug, $type = '', $limit = 50, $orderby = 'release_date') {
    global $wpdb;

    // Skapa LIKE-mönster (lägg till % före och efter slugg)
    $genre_like = '%' . strtolower(trim($genre_slug)) . '%';

    $sql = "
        SELECT * FROM {$wpdb->prefix}movies
        WHERE LOWER(genre) LIKE %s
    ";
    $params = array($genre_like);

    // Lägg till typ om den skickats med (ex "movie" eller "tv")
    if (!empty($type)) {
        // Om $type är en array (både 'movie' och 'tv')
        if (is_array($type)) {
            $placeholders = implode(',', array_fill(0, count($type), '%s'));
            $sql .= " AND type IN ($placeholders)";
            $params = array_merge($params, $type);
        } else {
            $sql .= " AND type = %s";
            $params[] = $type;
        }
    }

    // Sorteringsval
    // Om random/RAND() efterfrågas
    if ($orderby === 'random' || strtoupper($orderby) === 'RAND()') {
        $sql .= " ORDER BY RAND()";
    } else {
        // Skydda mot SQL-injection i orderby med en whitelist!
        $allowed_orderbys = ['release_date', 'title'];
        $orderby_safe = in_array($orderby, $allowed_orderbys) ? $orderby : 'release_date';
        $sql .= " ORDER BY {$orderby_safe} DESC";
    }

    // Limit
    $sql .= " LIMIT %d";
    $params[] = $limit;

    $query = $wpdb->prepare($sql, $params);

    error_log("WP-Movies Query: " . $query);

    $results = $wpdb->get_results($query);
    error_log("WP-Movies Results: " . print_r($results, true));

    return $results;
}

// Stöd för Font Awesome ikoner
function wp_movies_enqueue_styles() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
}
add_action( 'wp_enqueue_scripts', 'wp_movies_enqueue_styles' );

// Lägg till data-attribute för varje meny-länk baserat på menynamn
function wp_movie_menu_data_attributes( $atts, $item, $args, $depth ) {
    if ( isset( $item->title ) ) {
        // Skapa ett data-genre baserat på menynamn, t.ex. "Home" -> "home"
        $atts['data-icon'] = strtolower( str_replace(' ', '-', $item->title) );
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wp_movie_menu_data_attributes', 10, 4 );
