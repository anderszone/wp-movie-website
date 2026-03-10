<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Add data-icon attribute to menu links based on menu item title
 *
 * @param array  $atts  HTML attributes for the menu item.
 * @param object $item  WP_Post object for the menu item.
 * @param object $args  An object of wp_nav_menu() arguments.
 * @param int    $depth Depth of menu item.
 * @return array Modified HTML attributes with data-icon.
 */
function wp_movie_menu_data_attributes( $atts, $item, $args, $depth ) {
    $target_menus = array( 'menu-1' ); // Add more menu locations here if needed

    if ( ! empty( $args->theme_location ) && in_array( $args->theme_location, $target_menus, true ) ) {
        if ( ! empty( $item->title ) && is_string( $item->title ) ) {
            $title = trim( $item->title );

            // Replace spaces with dash, remove unwanted characters
            $data_icon = strtolower( preg_replace( '/[^a-z0-9\-]/', '', str_replace( ' ', '-', $title ) ) );

            $atts['data-icon'] = esc_attr( $data_icon );
        }
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wp_movie_menu_data_attributes', 10, 4 );


/**
 * Enqueue contact form validation script
 *
 * @return void
 */
function wp_movie_enqueue_contact_validation() {
    $pages_to_enqueue = array( 'page-contact.php' ); // Add more page templates if needed

    foreach ( $pages_to_enqueue as $template ) {
        if ( is_page_template( $template ) ) {
            wp_enqueue_script(
                'contact-validation',
                get_template_directory_uri() . '/js/contact-validation.js',
                array(), // Add dependencies like 'jquery' if needed
                '1.0',
                true
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'wp_movie_enqueue_contact_validation' );
